<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTestMagangRequest;
use App\Http\Requests\StoreTestMagangRequest;
use App\Http\Requests\UpdateTestMagangRequest;
use App\Models\MahasiswaMagang;
use App\Models\TestMagang;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestMagangController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('test_magang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testMagangs = TestMagang::with(['mahasiswa', 'magang'])->get();

        return view('frontend.testMagangs.index', compact('testMagangs'));
    }

    public function create()
    {
        abort_if(Gate::denies('test_magang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $magangs = MahasiswaMagang::pluck('instansi', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.testMagangs.create', compact('magangs', 'mahasiswas'));
    }

    public function store(StoreTestMagangRequest $request)
    {
        $testMagang = TestMagang::create($request->all());

        return redirect()->route('frontend.test-magangs.index');
    }

    public function edit(TestMagang $testMagang)
    {
        abort_if(Gate::denies('test_magang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $magangs = MahasiswaMagang::pluck('instansi', 'id')->prepend(trans('global.pleaseSelect'), '');

        $testMagang->load('mahasiswa', 'magang');

        return view('frontend.testMagangs.edit', compact('magangs', 'mahasiswas', 'testMagang'));
    }

    public function update(UpdateTestMagangRequest $request, TestMagang $testMagang)
    {
        $testMagang->update($request->all());

        return redirect()->route('frontend.test-magangs.index');
    }

    public function show(TestMagang $testMagang)
    {
        abort_if(Gate::denies('test_magang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testMagang->load('mahasiswa', 'magang');

        return view('frontend.testMagangs.show', compact('testMagang'));
    }

    public function destroy(TestMagang $testMagang)
    {
        abort_if(Gate::denies('test_magang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testMagang->delete();

        return back();
    }

    public function massDestroy(MassDestroyTestMagangRequest $request)
    {
        $testMagangs = TestMagang::find(request('ids'));

        foreach ($testMagangs as $testMagang) {
            $testMagang->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function takeTest($magang_id, $type)
    {
        // Check if this is a valid magang application
        $magangApp = MahasiswaMagang::where('id', $magang_id)
            ->where('mahasiswa_id', auth()->id())
            ->first();
        
        abort_if(!$magangApp, Response::HTTP_FORBIDDEN, 'You do not have permission to take this test');
        
        // SECURITY FIX: Check if application is approved
        if ($magangApp->approve !== 'APPROVED') {
            return redirect()->route('frontend.mahasiswa-magangs.index')
                ->with('error', 'Your application must be approved before you can take tests');
        }
        
        // Check if user already took this test
        $existingTest = TestMagang::where('magang_id', $magang_id)
            ->where('mahasiswa_id', auth()->id())
            ->where('type', $type)
            ->first();
        
        if ($existingTest) {
            return redirect()->route('frontend.mahasiswa-magangs.index')
                ->with('error', 'You have already taken this test');
        }
        
        // Additional validation for POSTTEST
        if ($type == 'POSTTEST') {
            // Check if pretest was completed
            if (!$magangApp->pretest) {
                return redirect()->route('frontend.mahasiswa-magangs.index')
                    ->with('error', 'You must complete the pretest first before taking the posttest');
            }
            
            // Check if 1 month has passed since pretest
            $pretestDate = $magangApp->pretest_completed_at;
            
            if (!$pretestDate) {
                // Fallback to test record if timestamp not available
                $pretestRecord = TestMagang::where('magang_id', $magang_id)
                    ->where('mahasiswa_id', auth()->id())
                    ->where('type', 'PRETEST')
                    ->first();
                    
                if (!$pretestRecord) {
                    return redirect()->route('frontend.mahasiswa-magangs.index')
                        ->with('error', 'Pretest record not found. Please contact administrator.');
                }
                
                $pretestDate = $pretestRecord->created_at;
            }
            
            // Ensure $pretestDate is a Carbon instance
            if (is_string($pretestDate)) {
                $pretestDate = \Carbon\Carbon::parse($pretestDate);
            } elseif (!($pretestDate instanceof \Carbon\Carbon)) {
                return redirect()->route('frontend.mahasiswa-magangs.index')
                    ->with('error', 'Invalid pretest date. Please contact administrator.');
            }
            
            // $oneMonthLater = $pretestDate->copy()->addMonth();
            $oneMonthLater = $pretestDate->copy();
            $now = now();
            
            if ($now->lt($oneMonthLater)) {
                $daysRemaining = $now->diffInDays($oneMonthLater);
                return redirect()->route('frontend.mahasiswa-magangs.index')
                    ->with('error', "Posttest will be available in {$daysRemaining} days. You must wait 1 month after completing the pretest.");
            }
            
            // Check monitoring requirements (minimum 1 report)
            $monitoringCount = \App\Models\MonitoringMagang::where('magang_id', $magang_id)->count();
            if ($monitoringCount < 1) {
                return redirect()->route('frontend.mahasiswa-magangs.index')
                    ->with('error', "You need at least 1 monitoring report before taking the posttest. Current: {$monitoringCount}/1");
            }
        }
        
        // Load the appropriate test view
        if ($type == 'PRETEST') {
            return view('frontend.testMagangs.pretest', compact('magang_id'));
        } else {
            return view('frontend.testMagangs.posttest', compact('magang_id'));
        }
    }
    
    public function storeTest(Request $request)
    {
        abort_if(!auth()->check(), Response::HTTP_FORBIDDEN, 'You must be logged in to submit a test');
        
        // Validate the request
        $validatedData = $request->validate([
            'magang_id' => 'required|exists:mahasiswa_magangs,id',
            'type' => 'required|in:PRETEST,POSTTEST',
            'q_1' => 'required|integer|min:1|max:5',
            'q_2' => 'required|integer|min:1|max:5',
            'q_3' => 'required|integer|min:1|max:5',
            'q_4' => 'required|integer|min:1|max:5',
            'q_5' => 'required|integer|min:1|max:5',
            'q_6' => 'required|integer|min:1|max:5',
            'q_7' => 'required|integer|min:1|max:5',
            'q_8' => 'required|integer|min:1|max:5',
            'q_9' => 'required|integer|min:1|max:5',
            'q_10' => 'required|integer|min:1|max:5',
            'q_11' => 'required|integer|min:1|max:5',
            'q_12' => 'required|integer|min:1|max:5',
            'q_13' => 'required|integer|min:1|max:5',
            'q_14' => 'required|integer|min:1|max:5',
            'q_15' => 'required|integer|min:1|max:5',
            'q_16' => 'required|integer|min:1|max:5',
            'q_17' => 'required|integer|min:1|max:5',
            'q_18' => 'required|integer|min:1|max:5',
        ]);
        
        // Check if the user already took this test
        $existingTest = TestMagang::where('magang_id', $request->magang_id)
            ->where('mahasiswa_id', auth()->id())
            ->where('type', $request->type)
            ->first();
        
        if ($existingTest) {
            return redirect()->route('frontend.mahasiswa-magangs.index')
                ->with('error', 'You have already taken this test');
        }
        
        // Calculate the result (average of all questions)
        $sum = 0;
        for ($i = 1; $i <= 18; $i++) {
            $sum += $request->{"q_$i"};
        }
        $result = $sum / 18;
        
        // Save the test data
        $test = new TestMagang();
        $test->mahasiswa_id = auth()->id();
        $test->magang_id = $request->magang_id;
        $test->type = $request->type;
        $test->result = $result;
        
        // Save all question answers
        for ($i = 1; $i <= 18; $i++) {
            $test->{"q_$i"} = $request->{"q_$i"};
        }
        
        $test->save();
        
        // Update the magang application
        $magangApp = MahasiswaMagang::find($request->magang_id);
        if ($request->type == 'PRETEST') {
            $magangApp->pretest = true;
            $magangApp->pretest_completed_at = now();
        } else {
            $magangApp->posttest = true;
            $magangApp->posttest_completed_at = now();
        }
        $magangApp->save();
        
        return redirect()->route('frontend.mahasiswa-magangs.index')
            ->with('success', 'Thank you for completing the ' . strtolower($request->type));
    }
}

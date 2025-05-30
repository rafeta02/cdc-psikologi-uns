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
        // $magangApp = MahasiswaMagang::where('id', $magang_id)
        //     ->where('mahasiswa_id', auth()->id())
        //     ->first();
        
        // abort_if(!$magangApp, Response::HTTP_FORBIDDEN, 'You do not have permission to take this test');
        
        // Check if user already took this test
        $existingTest = TestMagang::where('magang_id', $magang_id)
            ->where('mahasiswa_id', auth()->id())
            ->where('type', $type)
            ->first();
        
        // if ($existingTest) {
        //     return redirect()->route('frontend.mahasiswa-magangs.index')
        //         ->with('error', 'You have already taken this test');
        // }
        
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
        } else {
            $magangApp->posttest = true;
        }
        $magangApp->save();
        
        return redirect()->route('frontend.mahasiswa-magangs.index')
            ->with('success', 'Thank you for completing the ' . strtolower($request->type));
    }
}

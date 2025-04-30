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
        // Verify the user is authorized to take this test
        $mahasiswaMagang = MahasiswaMagang::findOrFail($magang_id);
        
        if ($mahasiswaMagang->mahasiswa_id != auth()->id()) {
            abort(403, 'You are not authorized to take this test');
        }
        
        // Check if test has already been taken
        $existingTest = TestMagang::where('magang_id', $magang_id)
            ->where('mahasiswa_id', auth()->id())
            ->where('type', $type)
            ->first();
            
        if ($existingTest) {
            return redirect()->route('frontend.mahasiswa-magangs.index')
                ->with('error', 'You have already completed this ' . strtolower($type));
        }
        
        return view('frontend.testMagangs.test_form', compact('magang_id', 'type'));
    }
    
    public function storeTest(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'magang_id' => 'required|exists:mahasiswa_magangs,id',
            'type' => 'required|in:PRETEST,POSTTEST',
            'q_1' => 'required|integer|between:1,5',
            'q_2' => 'required|integer|between:1,5',
            'q_3' => 'required|integer|between:1,5',
            'q_4' => 'required|integer|between:1,5',
            'q_5' => 'required|integer|between:1,5',
            'q_6' => 'required|integer|between:1,5',
            'q_7' => 'required|integer|between:1,5',
            'q_8' => 'required|integer|between:1,5',
            'q_9' => 'required|integer|between:1,5',
            'q_10' => 'required|integer|between:1,5',
            'q_11' => 'required|integer|between:1,5',
            'q_12' => 'required|integer|between:1,5',
            'q_13' => 'required|integer|between:1,5',
            'q_14' => 'required|integer|between:1,5',
            'q_15' => 'required|integer|between:1,5',
            'q_16' => 'required|integer|between:1,5',
            'q_17' => 'required|integer|between:1,5',
            'q_18' => 'required|integer|between:1,5',
        ]);
        
        // Calculate result (sum of all answers)
        $result = 0;
        for ($i = 1; $i <= 18; $i++) {
            $result += $request->input('q_' . $i);
        }
        
        // Create the test record
        $testMagang = new TestMagang();
        $testMagang->mahasiswa_id = auth()->id();
        $testMagang->magang_id = $request->magang_id;
        $testMagang->type = $request->type;
        $testMagang->result = $result;
        
        // Store all question answers
        for ($i = 1; $i <= 18; $i++) {
            $fieldName = 'q_' . $i;
            $testMagang->$fieldName = $request->$fieldName;
        }
        
        $testMagang->save();
        
        // Update the pretest/posttest flag on the MahasiswaMagang record
        $mahasiswaMagang = MahasiswaMagang::find($request->magang_id);
        if ($request->type == 'PRETEST') {
            $mahasiswaMagang->pretest = true;
        } else {
            $mahasiswaMagang->posttest = true;
        }
        $mahasiswaMagang->save();
        
        return redirect()->route('frontend.mahasiswa-magangs.index')
            ->with('success', 'Your ' . strtolower($request->type) . ' has been submitted successfully');
    }
}

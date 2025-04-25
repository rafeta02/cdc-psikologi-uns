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
}

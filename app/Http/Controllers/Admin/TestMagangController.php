<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class TestMagangController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('test_magang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TestMagang::with(['mahasiswa', 'magang'])->select(sprintf('%s.*', (new TestMagang)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'test_magang_show';
                $editGate      = 'test_magang_edit';
                $deleteGate    = 'test_magang_delete';
                $crudRoutePart = 'test-magangs';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('mahasiswa_name', function ($row) {
                return $row->mahasiswa ? $row->mahasiswa->name : '';
            });

            $table->addColumn('magang_instansi', function ($row) {
                return $row->magang ? $row->magang->instansi : '';
            });

            $table->editColumn('type', function ($row) {
                return $row->type ? TestMagang::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('result', function ($row) {
                return $row->result ? $row->result : '';
            });
            $table->editColumn('q_1', function ($row) {
                return $row->q_1 ? $row->q_1 : '';
            });
            $table->editColumn('q_2', function ($row) {
                return $row->q_2 ? $row->q_2 : '';
            });
            $table->editColumn('q_3', function ($row) {
                return $row->q_3 ? $row->q_3 : '';
            });
            $table->editColumn('q_4', function ($row) {
                return $row->q_4 ? $row->q_4 : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'mahasiswa', 'magang']);

            return $table->make(true);
        }

        return view('admin.testMagangs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('test_magang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $magangs = MahasiswaMagang::pluck('instansi', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.testMagangs.create', compact('magangs', 'mahasiswas'));
    }

    public function store(StoreTestMagangRequest $request)
    {
        $testMagang = TestMagang::create($request->all());

        return redirect()->route('admin.test-magangs.index');
    }

    public function edit(TestMagang $testMagang)
    {
        abort_if(Gate::denies('test_magang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $magangs = MahasiswaMagang::pluck('instansi', 'id')->prepend(trans('global.pleaseSelect'), '');

        $testMagang->load('mahasiswa', 'magang');

        return view('admin.testMagangs.edit', compact('magangs', 'mahasiswas', 'testMagang'));
    }

    public function update(UpdateTestMagangRequest $request, TestMagang $testMagang)
    {
        $testMagang->update($request->all());

        return redirect()->route('admin.test-magangs.index');
    }

    public function show(TestMagang $testMagang)
    {
        abort_if(Gate::denies('test_magang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testMagang->load('mahasiswa', 'magang');

        return view('admin.testMagangs.show', compact('testMagang'));
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

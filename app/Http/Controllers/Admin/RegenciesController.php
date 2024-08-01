<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyRegencyRequest;
use App\Http\Requests\StoreRegencyRequest;
use App\Http\Requests\UpdateRegencyRequest;
use App\Models\Province;
use App\Models\Regency;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RegenciesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('regency_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Regency::with(['province'])->select(sprintf('%s.*', (new Regency)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'regency_show';
                $editGate      = 'regency_edit';
                $deleteGate    = 'regency_delete';
                $crudRoutePart = 'regencies';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('province_name', function ($row) {
                return $row->province ? $row->province->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'province']);

            return $table->make(true);
        }

        return view('admin.regencies.index');
    }

    public function create()
    {
        abort_if(Gate::denies('regency_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provinces = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.regencies.create', compact('provinces'));
    }

    public function store(StoreRegencyRequest $request)
    {
        $regency = Regency::create($request->all());

        return redirect()->route('admin.regencies.index');
    }

    public function edit(Regency $regency)
    {
        abort_if(Gate::denies('regency_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provinces = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $regency->load('province');

        return view('admin.regencies.edit', compact('provinces', 'regency'));
    }

    public function update(UpdateRegencyRequest $request, Regency $regency)
    {
        $regency->update($request->all());

        return redirect()->route('admin.regencies.index');
    }

    public function show(Regency $regency)
    {
        abort_if(Gate::denies('regency_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regency->load('province');

        return view('admin.regencies.show', compact('regency'));
    }

    public function destroy(Regency $regency)
    {
        abort_if(Gate::denies('regency_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regency->delete();

        return back();
    }

    public function massDestroy(MassDestroyRegencyRequest $request)
    {
        $regencies = Regency::find(request('ids'));

        foreach ($regencies as $regency) {
            $regency->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

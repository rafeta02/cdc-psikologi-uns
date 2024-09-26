<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTracerAlumnuRequest;
use App\Http\Requests\StoreTracerAlumnuRequest;
use App\Http\Requests\UpdateTracerAlumnuRequest;
use App\Exports\TracerAlumnuExport;
use App\Models\Regency;
use App\Models\TracerAlumnu;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Excel;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;


class TracerAlumniController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('tracer_alumnu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TracerAlumnu::with(['user', 'kota_asal', 'kota_domisili'])->select(sprintf('%s.*', (new TracerAlumnu)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'tracer_alumnu_show';
                $editGate      = 'tracer_alumnu_edit';
                $deleteGate    = 'tracer_alumnu_delete';
                $crudRoutePart = 'tracer-alumnus';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('nim', function ($row) {
                return $row->nim ? $row->nim : '';
            });
            $table->editColumn('nama', function ($row) {
                return $row->nama ? $row->nama : '';
            });
            $table->editColumn('telephone', function ($row) {
                return $row->telephone ? $row->telephone : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('angkatan', function ($row) {
                return $row->angkatan ? TracerAlumnu::ANGKATAN_SELECT[$row->angkatan] : '';
            });
            $table->addColumn('kota_asal_name', function ($row) {
                return $row->kota_asal ? $row->kota_asal->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'kota_asal']);

            return $table->make(true);
        }

        return view('admin.tracerAlumnus.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tracer_alumnu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kota_asals = Regency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kota_domisilis = Regency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tracerAlumnus.create', compact('kota_asals', 'kota_domisilis', 'users'));
    }

    public function store(StoreTracerAlumnuRequest $request)
    {
        $tracerAlumnu = TracerAlumnu::create($request->all());

        return redirect()->route('admin.tracer-alumnus.index');
    }

    public function edit(TracerAlumnu $tracerAlumnu)
    {
        abort_if(Gate::denies('tracer_alumnu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kota_asals = Regency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kota_domisilis = Regency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tracerAlumnu->load('user', 'kota_asal', 'kota_domisili');

        return view('admin.tracerAlumnus.edit', compact('kota_asals', 'kota_domisilis', 'tracerAlumnu', 'users'));
    }

    public function update(UpdateTracerAlumnuRequest $request, TracerAlumnu $tracerAlumnu)
    {
        $tracerAlumnu->update($request->all());

        return redirect()->route('admin.tracer-alumnus.index');
    }

    public function show(TracerAlumnu $tracerAlumnu)
    {
        abort_if(Gate::denies('tracer_alumnu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tracerAlumnu->load('user', 'kota_asal', 'kota_domisili');

        return view('admin.tracerAlumnus.show', compact('tracerAlumnu'));
    }

    public function destroy(TracerAlumnu $tracerAlumnu)
    {
        abort_if(Gate::denies('tracer_alumnu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tracerAlumnu->delete();

        return back();
    }

    public function massDestroy(MassDestroyTracerAlumnuRequest $request)
    {
        $tracerAlumnus = TracerAlumnu::find(request('ids'));

        foreach ($tracerAlumnus as $tracerAlumnu) {
            $tracerAlumnu->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function export(Request $request)
    {
        if ($request->has('date') && $request->date && $dates = explode(' - ', $request->date)) {
            $start = Date::parse($dates[0])->startOfDay();
            $end = !isset($dates[1]) ? $start->clone()->endOfMonth() : Date::parse($dates[1])->endOfDay();
        } else {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now();
        }

        return Excel::download(new TracerAlumnuExport($start , $end), 'Tracer Alumni dari ' . $start->format('d-F-Y') .' sd '. $end->format('d-F-Y') . '.xlsx');
    }
}

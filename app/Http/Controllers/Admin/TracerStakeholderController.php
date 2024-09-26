<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTracerStakeholderRequest;
use App\Http\Requests\StoreTracerStakeholderRequest;
use App\Http\Requests\UpdateTracerStakeholderRequest;
use App\Models\TracerStakeholder;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\TracerStakeholderExport;
use Excel;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;

class TracerStakeholderController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('tracer_stakeholder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TracerStakeholder::query()->select(sprintf('%s.*', (new TracerStakeholder)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'tracer_stakeholder_show';
                $editGate      = 'tracer_stakeholder_edit';
                $deleteGate    = 'tracer_stakeholder_delete';
                $crudRoutePart = 'tracer-stakeholders';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('nama', function ($row) {
                return $row->nama ? $row->nama : '';
            });
            $table->editColumn('nama_instansi', function ($row) {
                return $row->nama_instansi ? $row->nama_instansi : '';
            });
            $table->editColumn('nama_alumni', function ($row) {
                return $row->nama_alumni ? $row->nama_alumni : '';
            });
            $table->editColumn('tahun_lulus', function ($row) {
                return $row->tahun_lulus ? $row->tahun_lulus : '';
            });
            $table->editColumn('tingkat_instansi', function ($row) {
                return $row->tingkat_instansi ? TracerStakeholder::TINGKAT_INSTANSI_RADIO[$row->tingkat_instansi] : '';
            });
            $table->editColumn('kepuasan_alumni', function ($row) {
                return $row->kepuasan_alumni ?? '';
            });
            $table->editColumn('tanda_tangan', function ($row) {
                return $row->tanda_tangan ? '<a href="' . $row->tanda_tangan->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'tanda_tangan']);

            return $table->make(true);
        }

        return view('admin.tracerStakeholders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tracer_stakeholder_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tracerStakeholders.create');
    }

    public function store(StoreTracerStakeholderRequest $request)
    {
        $tracerStakeholder = TracerStakeholder::create($request->all());

        if ($request->input('tanda_tangan', false)) {
            $tracerStakeholder->addMedia(storage_path('tmp/uploads/' . basename($request->input('tanda_tangan'))))->toMediaCollection('tanda_tangan');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $tracerStakeholder->id]);
        }

        return redirect()->route('admin.tracer-stakeholders.index');
    }

    public function edit(TracerStakeholder $tracerStakeholder)
    {
        abort_if(Gate::denies('tracer_stakeholder_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tracerStakeholders.edit', compact('tracerStakeholder'));
    }

    public function update(UpdateTracerStakeholderRequest $request, TracerStakeholder $tracerStakeholder)
    {
        $tracerStakeholder->update($request->all());

        if ($request->input('tanda_tangan', false)) {
            if (! $tracerStakeholder->tanda_tangan || $request->input('tanda_tangan') !== $tracerStakeholder->tanda_tangan->file_name) {
                if ($tracerStakeholder->tanda_tangan) {
                    $tracerStakeholder->tanda_tangan->delete();
                }
                $tracerStakeholder->addMedia(storage_path('tmp/uploads/' . basename($request->input('tanda_tangan'))))->toMediaCollection('tanda_tangan');
            }
        } elseif ($tracerStakeholder->tanda_tangan) {
            $tracerStakeholder->tanda_tangan->delete();
        }

        return redirect()->route('admin.tracer-stakeholders.index');
    }

    public function show(TracerStakeholder $tracerStakeholder)
    {
        abort_if(Gate::denies('tracer_stakeholder_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tracerStakeholders.show', compact('tracerStakeholder'));
    }

    public function destroy(TracerStakeholder $tracerStakeholder)
    {
        abort_if(Gate::denies('tracer_stakeholder_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tracerStakeholder->delete();

        return back();
    }

    public function massDestroy(MassDestroyTracerStakeholderRequest $request)
    {
        $tracerStakeholders = TracerStakeholder::find(request('ids'));

        foreach ($tracerStakeholders as $tracerStakeholder) {
            $tracerStakeholder->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('tracer_stakeholder_create') && Gate::denies('tracer_stakeholder_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TracerStakeholder();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
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

        return Excel::download(new TracerStakeholderExport($start , $end), 'Tracer Stakeholders dari ' . $start->format('d-F-Y') .' sd '. $end->format('d-F-Y') . '.xlsx');
    }
}

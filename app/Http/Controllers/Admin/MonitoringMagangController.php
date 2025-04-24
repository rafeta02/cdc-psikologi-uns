<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMonitoringMagangRequest;
use App\Http\Requests\StoreMonitoringMagangRequest;
use App\Http\Requests\UpdateMonitoringMagangRequest;
use App\Models\MahasiswaMagang;
use App\Models\MonitoringMagang;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MonitoringMagangController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('monitoring_magang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MonitoringMagang::with(['mahasiswa', 'magang'])->select(sprintf('%s.*', (new MonitoringMagang)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'monitoring_magang_show';
                $editGate      = 'monitoring_magang_edit';
                $deleteGate    = 'monitoring_magang_delete';
                $crudRoutePart = 'monitoring-magangs';

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

            $table->editColumn('pembimbing', function ($row) {
                return $row->pembimbing ? $row->pembimbing : '';
            });

            $table->editColumn('tempat', function ($row) {
                return $row->tempat ? $row->tempat : '';
            });
            $table->editColumn('bukti', function ($row) {
                if (! $row->bukti) {
                    return '';
                }
                $links = [];
                foreach ($row->bukti as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'mahasiswa', 'bukti']);

            return $table->make(true);
        }

        return view('admin.monitoringMagangs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('monitoring_magang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $magangs = MahasiswaMagang::pluck('instansi', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.monitoringMagangs.create', compact('magangs', 'mahasiswas'));
    }

    public function store(StoreMonitoringMagangRequest $request)
    {
        $monitoringMagang = MonitoringMagang::create($request->all());

        foreach ($request->input('bukti', []) as $file) {
            $monitoringMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('bukti');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $monitoringMagang->id]);
        }

        return redirect()->route('admin.monitoring-magangs.index');
    }

    public function edit(MonitoringMagang $monitoringMagang)
    {
        abort_if(Gate::denies('monitoring_magang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $magangs = MahasiswaMagang::pluck('instansi', 'id')->prepend(trans('global.pleaseSelect'), '');

        $monitoringMagang->load('mahasiswa', 'magang');

        return view('admin.monitoringMagangs.edit', compact('magangs', 'mahasiswas', 'monitoringMagang'));
    }

    public function update(UpdateMonitoringMagangRequest $request, MonitoringMagang $monitoringMagang)
    {
        $monitoringMagang->update($request->all());

        if (count($monitoringMagang->bukti) > 0) {
            foreach ($monitoringMagang->bukti as $media) {
                if (! in_array($media->file_name, $request->input('bukti', []))) {
                    $media->delete();
                }
            }
        }
        $media = $monitoringMagang->bukti->pluck('file_name')->toArray();
        foreach ($request->input('bukti', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $monitoringMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('bukti');
            }
        }

        return redirect()->route('admin.monitoring-magangs.index');
    }

    public function show(MonitoringMagang $monitoringMagang)
    {
        abort_if(Gate::denies('monitoring_magang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $monitoringMagang->load('mahasiswa', 'magang');

        return view('admin.monitoringMagangs.show', compact('monitoringMagang'));
    }

    public function destroy(MonitoringMagang $monitoringMagang)
    {
        abort_if(Gate::denies('monitoring_magang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $monitoringMagang->delete();

        return back();
    }

    public function massDestroy(MassDestroyMonitoringMagangRequest $request)
    {
        $monitoringMagangs = MonitoringMagang::find(request('ids'));

        foreach ($monitoringMagangs as $monitoringMagang) {
            $monitoringMagang->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('monitoring_magang_create') && Gate::denies('monitoring_magang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MonitoringMagang();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

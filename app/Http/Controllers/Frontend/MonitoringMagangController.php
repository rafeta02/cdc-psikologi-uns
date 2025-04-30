<?php

namespace App\Http\Controllers\Frontend;

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

class MonitoringMagangController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('monitoring_magang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $monitoringMagangs = MonitoringMagang::with(['mahasiswa', 'magang', 'media'])->get();

        return view('frontend.monitoringMagangs.index', compact('monitoringMagangs'));
    }

    public function create()
    {
        abort_if(Gate::denies('monitoring_magang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $magangs = MahasiswaMagang::pluck('instansi', 'id')->prepend(trans('global.pleaseSelect'), '');

        // Get magang_id from request if available
        $selectedMagang = request('magang_id');
        $mahasiswaMagang = null;
        
        // If magang_id is provided, set the current user as mahasiswa
        if ($selectedMagang) {
            $mahasiswaMagang = MahasiswaMagang::find($selectedMagang);
            
            // Ensure the user owns this magang record
            if ($mahasiswaMagang && $mahasiswaMagang->mahasiswa_id == auth()->id()) {
                $selectedMahasiswa = auth()->id();
            } else {
                abort(403, 'You are not authorized to add monitoring for this internship');
            }
        }

        return view('frontend.monitoringMagangs.create', compact('magangs', 'mahasiswas', 'selectedMagang', 'selectedMahasiswa'));
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

        // Redirect back to the mahasiswa magang details
        if ($monitoringMagang->magang_id) {
            return redirect()->route('frontend.mahasiswa-magangs.show', $monitoringMagang->magang_id);
        }

        return redirect()->route('frontend.monitoring-magangs.index');
    }

    public function edit(MonitoringMagang $monitoringMagang)
    {
        abort_if(Gate::denies('monitoring_magang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $magangs = MahasiswaMagang::pluck('instansi', 'id')->prepend(trans('global.pleaseSelect'), '');

        $monitoringMagang->load('mahasiswa', 'magang');

        return view('frontend.monitoringMagangs.edit', compact('magangs', 'mahasiswas', 'monitoringMagang'));
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

        return redirect()->route('frontend.monitoring-magangs.index');
    }

    public function show(MonitoringMagang $monitoringMagang)
    {
        abort_if(Gate::denies('monitoring_magang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $monitoringMagang->load('mahasiswa', 'magang');

        return view('frontend.monitoringMagangs.show', compact('monitoringMagang'));
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

<?php

namespace App\Http\Controllers\Frontend;

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

class TracerStakeholderController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('tracer_stakeholder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tracerStakeholders = TracerStakeholder::with(['media'])->get();

        return view('frontend.tracerStakeholders.index', compact('tracerStakeholders'));
    }

    public function create()
    {
        abort_if(Gate::denies('tracer_stakeholder_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.tracerStakeholders.create');
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

        return redirect()->route('frontend.tracer-stakeholders.index');
    }

    public function edit(TracerStakeholder $tracerStakeholder)
    {
        abort_if(Gate::denies('tracer_stakeholder_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.tracerStakeholders.edit', compact('tracerStakeholder'));
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

        return redirect()->route('frontend.tracer-stakeholders.index');
    }

    public function show(TracerStakeholder $tracerStakeholder)
    {
        abort_if(Gate::denies('tracer_stakeholder_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.tracerStakeholders.show', compact('tracerStakeholder'));
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
}

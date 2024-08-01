<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCompetenceRequest;
use App\Http\Requests\StoreCompetenceRequest;
use App\Http\Requests\UpdateCompetenceRequest;
use App\Models\Competence;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CompetenceController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('competence_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competences = Competence::with(['media'])->get();

        return view('frontend.competences.index', compact('competences'));
    }

    public function create()
    {
        abort_if(Gate::denies('competence_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.competences.create');
    }

    public function store(StoreCompetenceRequest $request)
    {
        $competence = Competence::create($request->all());

        if ($request->input('image', false)) {
            $competence->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $competence->id]);
        }

        return redirect()->route('frontend.competences.index');
    }

    public function edit(Competence $competence)
    {
        abort_if(Gate::denies('competence_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.competences.edit', compact('competence'));
    }

    public function update(UpdateCompetenceRequest $request, Competence $competence)
    {
        $competence->update($request->all());

        if ($request->input('image', false)) {
            if (! $competence->image || $request->input('image') !== $competence->image->file_name) {
                if ($competence->image) {
                    $competence->image->delete();
                }
                $competence->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($competence->image) {
            $competence->image->delete();
        }

        return redirect()->route('frontend.competences.index');
    }

    public function show(Competence $competence)
    {
        abort_if(Gate::denies('competence_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competence->load('competenceCompetenceItems');

        return view('frontend.competences.show', compact('competence'));
    }

    public function destroy(Competence $competence)
    {
        abort_if(Gate::denies('competence_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competence->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompetenceRequest $request)
    {
        $competences = Competence::find(request('ids'));

        foreach ($competences as $competence) {
            $competence->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('competence_create') && Gate::denies('competence_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Competence();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

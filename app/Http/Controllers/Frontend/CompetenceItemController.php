<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCompetenceItemRequest;
use App\Http\Requests\StoreCompetenceItemRequest;
use App\Http\Requests\UpdateCompetenceItemRequest;
use App\Models\Competence;
use App\Models\CompetenceItem;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CompetenceItemController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('competence_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competenceItems = CompetenceItem::with(['competence', 'media'])->get();

        return view('frontend.competenceItems.index', compact('competenceItems'));
    }

    public function create()
    {
        abort_if(Gate::denies('competence_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competences = Competence::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.competenceItems.create', compact('competences'));
    }

    public function store(StoreCompetenceItemRequest $request)
    {
        $competenceItem = CompetenceItem::create($request->all());

        if ($request->input('image', false)) {
            $competenceItem->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $competenceItem->id]);
        }

        return redirect()->route('frontend.competence-items.index');
    }

    public function edit(CompetenceItem $competenceItem)
    {
        abort_if(Gate::denies('competence_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competences = Competence::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $competenceItem->load('competence');

        return view('frontend.competenceItems.edit', compact('competenceItem', 'competences'));
    }

    public function update(UpdateCompetenceItemRequest $request, CompetenceItem $competenceItem)
    {
        $competenceItem->update($request->all());

        if ($request->input('image', false)) {
            if (! $competenceItem->image || $request->input('image') !== $competenceItem->image->file_name) {
                if ($competenceItem->image) {
                    $competenceItem->image->delete();
                }
                $competenceItem->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($competenceItem->image) {
            $competenceItem->image->delete();
        }

        return redirect()->route('frontend.competence-items.index');
    }

    public function show(CompetenceItem $competenceItem)
    {
        abort_if(Gate::denies('competence_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competenceItem->load('competence');

        return view('frontend.competenceItems.show', compact('competenceItem'));
    }

    public function destroy(CompetenceItem $competenceItem)
    {
        abort_if(Gate::denies('competence_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competenceItem->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompetenceItemRequest $request)
    {
        $competenceItems = CompetenceItem::find(request('ids'));

        foreach ($competenceItems as $competenceItem) {
            $competenceItem->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('competence_item_create') && Gate::denies('competence_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CompetenceItem();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

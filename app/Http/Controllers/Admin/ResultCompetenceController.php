<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyResultCompetenceRequest;
use App\Http\Requests\StoreResultCompetenceRequest;
use App\Http\Requests\UpdateResultCompetenceRequest;
use App\Models\Competence;
use App\Models\ResultCompetence;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ResultCompetenceController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('result_competence_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ResultCompetence::with(['users', 'competences'])->select(sprintf('%s.*', (new ResultCompetence)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'result_competence_show';
                $editGate      = 'result_competence_edit';
                $deleteGate    = 'result_competence_delete';
                $crudRoutePart = 'result-competences';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('user', function ($row) {
                $labels = [];
                foreach ($row->users as $user) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $user->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('competence', function ($row) {
                $labels = [];
                foreach ($row->competences as $competence) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $competence->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'competence']);

            return $table->make(true);
        }

        return view('admin.resultCompetences.index');
    }

    public function create()
    {
        abort_if(Gate::denies('result_competence_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id');

        $competences = Competence::pluck('name', 'id');

        return view('admin.resultCompetences.create', compact('competences', 'users'));
    }

    public function store(StoreResultCompetenceRequest $request)
    {
        $resultCompetence = ResultCompetence::create($request->all());
        $resultCompetence->users()->sync($request->input('users', []));
        $resultCompetence->competences()->sync($request->input('competences', []));
        if ($request->input('certificate', false)) {
            $resultCompetence->addMedia(storage_path('tmp/uploads/' . basename($request->input('certificate'))))->toMediaCollection('certificate');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $resultCompetence->id]);
        }

        return redirect()->route('admin.result-competences.index');
    }

    public function edit(ResultCompetence $resultCompetence)
    {
        abort_if(Gate::denies('result_competence_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id');

        $competences = Competence::pluck('name', 'id');

        $resultCompetence->load('users', 'competences');

        return view('admin.resultCompetences.edit', compact('competences', 'resultCompetence', 'users'));
    }

    public function update(UpdateResultCompetenceRequest $request, ResultCompetence $resultCompetence)
    {
        $resultCompetence->update($request->all());
        $resultCompetence->users()->sync($request->input('users', []));
        $resultCompetence->competences()->sync($request->input('competences', []));
        if ($request->input('certificate', false)) {
            if (! $resultCompetence->certificate || $request->input('certificate') !== $resultCompetence->certificate->file_name) {
                if ($resultCompetence->certificate) {
                    $resultCompetence->certificate->delete();
                }
                $resultCompetence->addMedia(storage_path('tmp/uploads/' . basename($request->input('certificate'))))->toMediaCollection('certificate');
            }
        } elseif ($resultCompetence->certificate) {
            $resultCompetence->certificate->delete();
        }

        return redirect()->route('admin.result-competences.index');
    }

    public function show(ResultCompetence $resultCompetence)
    {
        abort_if(Gate::denies('result_competence_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resultCompetence->load('users', 'competences');

        return view('admin.resultCompetences.show', compact('resultCompetence'));
    }

    public function destroy(ResultCompetence $resultCompetence)
    {
        abort_if(Gate::denies('result_competence_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resultCompetence->delete();

        return back();
    }

    public function massDestroy(MassDestroyResultCompetenceRequest $request)
    {
        $resultCompetences = ResultCompetence::find(request('ids'));

        foreach ($resultCompetences as $resultCompetence) {
            $resultCompetence->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('result_competence_create') && Gate::denies('result_competence_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ResultCompetence();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

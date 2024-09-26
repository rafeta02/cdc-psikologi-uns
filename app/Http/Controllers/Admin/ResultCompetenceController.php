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
use Carbon\Carbon;

class ResultCompetenceController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('result_competence_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ResultCompetence::with(['user', 'competence'])->select(sprintf('%s.*', (new ResultCompetence)->table))->latest();
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

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('competence_name', function ($row) {
                return $row->competence ? $row->competence->name : '';
            });

            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at->diffForHumans() : '';
            });

            $table->editColumn('certificate', function ($row) {
                return $row->certificate ? '<a href="' . $row->certificate->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'competence', 'certificate']);

            return $table->make(true);
        }

        return view('admin.resultCompetences.index');
    }

    public function create()
    {
        abort_if(Gate::denies('result_competence_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $competences = Competence::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.resultCompetences.create', compact('competences', 'users'));
    }

    public function store(StoreResultCompetenceRequest $request)
    {
        $resultCompetence = ResultCompetence::create($request->all());

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

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $competences = Competence::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $resultCompetence->load('user', 'competence');

        return view('admin.resultCompetences.edit', compact('competences', 'resultCompetence', 'users'));
    }

    public function update(UpdateResultCompetenceRequest $request, ResultCompetence $resultCompetence)
    {
        $resultCompetence->update($request->all());

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

        $resultCompetence->load('user', 'competence');

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

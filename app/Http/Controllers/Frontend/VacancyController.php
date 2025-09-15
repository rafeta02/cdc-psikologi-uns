<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVacancyRequest;
use App\Http\Requests\StoreVacancyRequest;
use App\Http\Requests\UpdateVacancyRequest;
use App\Models\Company;
use App\Models\Department;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Industry;
use App\Models\Position;
use App\Models\Regency;
use App\Models\Vacancy;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class VacancyController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('vacancy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vacancies = Vacancy::public()->with(['company', 'experience', 'education', 'departments', 'position', 'industry', 'location', 'created_by'])->get();

        return view('frontend.vacancies.index', compact('vacancies'));
    }

    public function create()
    {
        abort_if(Gate::denies('vacancy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $experiences = Experience::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $education = Education::pluck('name', 'id');

        $departments = Department::pluck('name', 'id');

        $positions = Position::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $industries = Industry::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = Regency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.vacancies.create', compact('companies', 'departments', 'education', 'experiences', 'industries', 'locations', 'positions'));
    }

    public function store(StoreVacancyRequest $request)
    {
        $vacancy = Vacancy::create($request->all());
        $vacancy->education()->sync($request->input('education', []));
        $vacancy->departments()->sync($request->input('departments', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $vacancy->id]);
        }

        return redirect()->route('frontend.vacancies.index');
    }

    public function edit(Vacancy $vacancy)
    {
        abort_if(Gate::denies('vacancy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $experiences = Experience::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $education = Education::pluck('name', 'id');

        $departments = Department::pluck('name', 'id');

        $positions = Position::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $industries = Industry::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = Regency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vacancy->load('company', 'experience', 'education', 'departments', 'position', 'industry', 'location', 'created_by');

        return view('frontend.vacancies.edit', compact('companies', 'departments', 'education', 'experiences', 'industries', 'locations', 'positions', 'vacancy'));
    }

    public function update(UpdateVacancyRequest $request, Vacancy $vacancy)
    {
        $vacancy->update($request->all());
        $vacancy->education()->sync($request->input('education', []));
        $vacancy->departments()->sync($request->input('departments', []));

        return redirect()->route('frontend.vacancies.index');
    }

    public function show(Vacancy $vacancy)
    {
        abort_if(Gate::denies('vacancy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vacancy->load('company', 'experience', 'education', 'departments', 'position', 'industry', 'location', 'created_by');

        return view('frontend.vacancies.show', compact('vacancy'));
    }

    public function destroy(Vacancy $vacancy)
    {
        abort_if(Gate::denies('vacancy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vacancy->delete();

        return back();
    }

    public function massDestroy(MassDestroyVacancyRequest $request)
    {
        $vacancies = Vacancy::find(request('ids'));

        foreach ($vacancies as $vacancy) {
            $vacancy->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('vacancy_create') && Gate::denies('vacancy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Vacancy();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

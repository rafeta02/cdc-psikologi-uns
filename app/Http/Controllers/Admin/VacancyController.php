<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVacancyRequest;
use App\Http\Requests\StoreVacancyRequest;
use App\Http\Requests\UpdateVacancyRequest;
use App\Models\Company;
use App\Models\Department;
use App\Models\Education;
use App\Models\Industry;
use App\Models\Position;
use App\Models\Regency;
use App\Models\Vacancy;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Alert;
use Carbon\Carbon;

class VacancyController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('vacancy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Vacancy::with(['company', 'education', 'departments', 'position', 'industry', 'location', 'created_by'])->select(sprintf('%s.*', (new Vacancy)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'vacancy_show';
                $editGate      = 'vacancy_edit';
                $deleteGate    = 'vacancy_delete';
                $crudRoutePart = 'vacancies';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('company_name', function ($row) {
                return $row->company ? $row->company->name : '';
            });

            $table->editColumn('type', function ($row) {
                if ($row->type == 'fulltime') {
                    return '<span class="badge badge-success">Fulltime</span>';
                } elseif ($row->type == 'parttime') {
                    return '<span class="badge badge-warning">Parttime</span>';
                } else {
                    return '<span class="badge badge-danger">Intern</span>';
                }
            });

            $table->editColumn('close_date', function ($row) {
                return $row->close_date ? Carbon::parse($row->close_date)->format('j F Y') : '';
            });

            $table->addColumn('industry_name', function ($row) {
                return $row->industry ? $row->industry->name : '';
            });

            $table->addColumn('location_name', function ($row) {
                return $row->location ? $row->location->name.' - '. $row->location->province->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'company', 'industry', 'location', 'type']);

            return $table->make(true);
        }

        return view('admin.vacancies.index');
    }

    public function create()
    {
        abort_if(Gate::denies('vacancy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $education = Education::pluck('name', 'id');

        $departments = Department::pluck('name', 'id');

        $positions = Position::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $industries = Industry::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.vacancies.create', compact('companies', 'departments', 'education', 'industries', 'positions'));
    }

    public function store(StoreVacancyRequest $request)
    {
        $company = Company::find($request->company_id);

        $request->request->add(['industry_id' => $company->industry_id]);
        $request->request->add(['created_by_id' => auth()->user()->id]);

        $vacancy = Vacancy::create($request->all());
        $vacancy->education()->sync($request->input('education', []));
        $vacancy->departments()->sync($request->input('departments', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $vacancy->id]);
        }

        Alert::success('Success', 'Vacancy created successfully.');

        return redirect()->route('admin.vacancies.index');
    }

    public function edit(Vacancy $vacancy)
    {
        abort_if(Gate::denies('vacancy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $education = Education::pluck('name', 'id');

        $departments = Department::pluck('name', 'id');

        $positions = Position::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vacancy->load('company', 'education', 'departments', 'position', 'industry', 'location', 'created_by');

        return view('admin.vacancies.edit', compact('companies', 'departments', 'education', 'positions', 'vacancy'));
    }

    public function update(UpdateVacancyRequest $request, Vacancy $vacancy)
    {
        $company = Company::find($request->company_id);
        $request->request->add(['industry_id' => $company->industry_id]);

        $vacancy->update($request->all());
        $vacancy->education()->sync($request->input('education', []));
        $vacancy->departments()->sync($request->input('departments', []));

        Alert::success('Success', 'Vacancy updated successfully.');

        return redirect()->route('admin.vacancies.index');
    }

    public function show(Vacancy $vacancy)
    {
        abort_if(Gate::denies('vacancy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vacancy->load('company', 'education', 'departments', 'position', 'industry', 'location', 'created_by');

        return view('admin.vacancies.show', compact('vacancy'));
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

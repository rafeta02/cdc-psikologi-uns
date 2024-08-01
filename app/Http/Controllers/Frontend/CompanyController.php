<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCompanyRequest;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Industry;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::with(['industry', 'media'])->get();

        return view('frontend.companies.index', compact('companies'));
    }

    public function create()
    {
        abort_if(Gate::denies('company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $industries = Industry::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.companies.create', compact('industries'));
    }

    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->all());

        if ($request->input('image', false)) {
            $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $company->id]);
        }

        return redirect()->route('frontend.companies.index');
    }

    public function edit(Company $company)
    {
        abort_if(Gate::denies('company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $industries = Industry::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $company->load('industry');

        return view('frontend.companies.edit', compact('company', 'industries'));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->all());

        if ($request->input('image', false)) {
            if (! $company->image || $request->input('image') !== $company->image->file_name) {
                if ($company->image) {
                    $company->image->delete();
                }
                $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($company->image) {
            $company->image->delete();
        }

        return redirect()->route('frontend.companies.index');
    }

    public function show(Company $company)
    {
        abort_if(Gate::denies('company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company->load('industry');

        return view('frontend.companies.show', compact('company'));
    }

    public function destroy(Company $company)
    {
        abort_if(Gate::denies('company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompanyRequest $request)
    {
        $companies = Company::find(request('ids'));

        foreach ($companies as $company) {
            $company->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('company_create') && Gate::denies('company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Company();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

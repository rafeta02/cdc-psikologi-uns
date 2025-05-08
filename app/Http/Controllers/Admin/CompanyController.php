<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCompanyRequest;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Industry;
use App\Models\Regency;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Alert;

class CompanyController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Company::with(['regency', 'industry'])->select(sprintf('%s.*', (new Company)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'company_show';
                $editGate      = 'company_edit';
                $deleteGate    = 'company_delete';
                $crudRoutePart = 'companies';

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
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('telephone', function ($row) {
                return $row->telephone ? $row->telephone : '';
            });
            $table->editColumn('scale', function ($row) {
                return $row->scale ? Company::SCALE_SELECT[$row->scale] : '';
            });
            $table->addColumn('industry_name', function ($row) {
                return $row->industry ? $row->industry->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'industry']);

            return $table->make(true);
        }

        return view('admin.companies.index');
    }

    public function create()
    {
        abort_if(Gate::denies('company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regencies = Regency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $industries = Industry::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.companies.create', compact('industries', 'regencies'));
    }

    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->all());

        if ($request->input('image', false)) {
            $filePath = storage_path('tmp/uploads/' . basename($request->input('image')));
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);

            $imageNewName = $company->name .'_' . uniqid(). '.' . $extension;

            $newFilePath = storage_path('tmp/uploads/' . $imageNewName);
            rename($filePath, $newFilePath);

            if (file_exists($newFilePath)) {
                $company->addMedia($newFilePath)->toMediaCollection('image');
            } else {
                throw new \Exception('File does not exist at path: ' . $newFilePath);
            }
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $company->id]);
        }

        Alert::success('Success', 'Company created successfully.');

        return redirect()->route('admin.companies.index');
    }

    public function edit(Company $company)
    {
        abort_if(Gate::denies('company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regencies = Regency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $industries = Industry::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $company->load('regency', 'industry');

        return view('admin.companies.edit', compact('company', 'industries', 'regencies'));
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

        Alert::success('Success', 'Company updated successfully.');

        return redirect()->route('admin.companies.index');
    }

    public function show(Company $company)
    {
        abort_if(Gate::denies('company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company->load('regency', 'industry');

        return view('admin.companies.show', compact('company'));
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
    
    /**
     * Get companies for select2 ajax
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCompanies(Request $request)
    {
        // If ID is provided, return specific company
        if ($request->has('id')) {
            $company = Company::find($request->id);
            if ($company) {
                return response()->json([
                    [
                        'id' => $company->id,
                        'text' => $company->name
                    ]
                ]);
            }
            return response()->json([]);
        }
        
        // Otherwise search by query
        $search = $request->q;
        $query = Company::select('id', 'name');
        
        if ($search) {
            $query->where('name', 'LIKE', "%$search%");
        }
        
        $companies = $query->limit(10)->get();
        
        return response()->json($companies->map(function($company) {
            return [
                'id' => $company->id,
                'text' => $company->name
            ];
        }));
    }
}

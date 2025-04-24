<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMagangRequest;
use App\Http\Requests\StoreMagangRequest;
use App\Http\Requests\UpdateMagangRequest;
use App\Models\Company;
use App\Models\Magang;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MagangController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('magang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Magang::with(['company', 'created_by'])->select(sprintf('%s.*', (new Magang)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'magang_show';
                $editGate      = 'magang_edit';
                $deleteGate    = 'magang_delete';
                $crudRoutePart = 'magangs';

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
                return $row->type ? Magang::TYPE_SELECT[$row->type] : '';
            });

            $table->editColumn('needs', function ($row) {
                return $row->needs ? $row->needs : '';
            });
            $table->editColumn('filled', function ($row) {
                return $row->filled ? $row->filled : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'company']);

            return $table->make(true);
        }

        return view('admin.magangs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('magang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.magangs.create', compact('companies'));
    }

    public function store(StoreMagangRequest $request)
    {
        $magang = Magang::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $magang->id]);
        }

        return redirect()->route('admin.magangs.index');
    }

    public function edit(Magang $magang)
    {
        abort_if(Gate::denies('magang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $magang->load('company', 'created_by');

        return view('admin.magangs.edit', compact('companies', 'magang'));
    }

    public function update(UpdateMagangRequest $request, Magang $magang)
    {
        $magang->update($request->all());

        return redirect()->route('admin.magangs.index');
    }

    public function show(Magang $magang)
    {
        abort_if(Gate::denies('magang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $magang->load('company', 'created_by');

        return view('admin.magangs.show', compact('magang'));
    }

    public function destroy(Magang $magang)
    {
        abort_if(Gate::denies('magang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $magang->delete();

        return back();
    }

    public function massDestroy(MassDestroyMagangRequest $request)
    {
        $magangs = Magang::find(request('ids'));

        foreach ($magangs as $magang) {
            $magang->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('magang_create') && Gate::denies('magang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Magang();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

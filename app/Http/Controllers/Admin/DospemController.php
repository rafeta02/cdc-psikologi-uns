<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDospemRequest;
use App\Http\Requests\StoreDospemRequest;
use App\Http\Requests\UpdateDospemRequest;
use App\Models\Dospem;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DospemController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('dospem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Dospem::query()->select(sprintf('%s.*', (new Dospem)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'dospem_show';
                $editGate      = 'dospem_edit';
                $deleteGate    = 'dospem_delete';
                $crudRoutePart = 'dospems';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('nip', function ($row) {
                return $row->nip ? $row->nip : '';
            });
            $table->editColumn('nama', function ($row) {
                return $row->nama ? $row->nama : '';
            });
            $table->editColumn('whatshapp', function ($row) {
                return $row->whatshapp ? $row->whatshapp : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.dospems.index');
    }

    public function create()
    {
        abort_if(Gate::denies('dospem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dospems.create');
    }

    public function store(StoreDospemRequest $request)
    {
        $dospem = Dospem::create($request->all());

        if ($request->input('photo', false)) {
            $dospem->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $dospem->id]);
        }

        return redirect()->route('admin.dospems.index');
    }

    public function edit(Dospem $dospem)
    {
        abort_if(Gate::denies('dospem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dospems.edit', compact('dospem'));
    }

    public function update(UpdateDospemRequest $request, Dospem $dospem)
    {
        $dospem->update($request->all());

        if ($request->input('photo', false)) {
            if (! $dospem->photo || $request->input('photo') !== $dospem->photo->file_name) {
                if ($dospem->photo) {
                    $dospem->photo->delete();
                }
                $dospem->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($dospem->photo) {
            $dospem->photo->delete();
        }

        return redirect()->route('admin.dospems.index');
    }

    public function show(Dospem $dospem)
    {
        abort_if(Gate::denies('dospem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dospems.show', compact('dospem'));
    }

    public function destroy(Dospem $dospem)
    {
        abort_if(Gate::denies('dospem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dospem->delete();

        return back();
    }

    public function massDestroy(MassDestroyDospemRequest $request)
    {
        $dospems = Dospem::find(request('ids'));

        foreach ($dospems as $dospem) {
            $dospem->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('dospem_create') && Gate::denies('dospem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Dospem();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

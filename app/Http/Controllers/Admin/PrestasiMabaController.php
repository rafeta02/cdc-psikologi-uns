<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPrestasiMabaRequest;
use App\Http\Requests\StorePrestasiMabaRequest;
use App\Http\Requests\UpdatePrestasiMabaRequest;
use App\Models\KategoriPrestasi;
use App\Models\PrestasiMaba;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PrestasiMabaController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('prestasi_maba_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PrestasiMaba::with(['kategori'])->select(sprintf('%s.*', (new PrestasiMaba)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'prestasi_maba_show';
                $editGate      = 'prestasi_maba_edit';
                $deleteGate    = 'prestasi_maba_delete';
                $crudRoutePart = 'prestasi-mabas';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('tingkat', function ($row) {
                return $row->tingkat ? PrestasiMaba::TINGKAT_RADIO[$row->tingkat] : '';
            });
            $table->editColumn('nama_kegiatan', function ($row) {
                return $row->nama_kegiatan ? $row->nama_kegiatan : '';
            });
            $table->addColumn('kategori_name', function ($row) {
                return $row->kategori ? $row->kategori->name : '';
            });

            $table->editColumn('jumlah_peserta', function ($row) {
                return $row->jumlah_peserta ? PrestasiMaba::JUMLAH_PESERTA_RADIO[$row->jumlah_peserta] : '';
            });
            $table->editColumn('perolehan_juara', function ($row) {
                return $row->perolehan_juara ? PrestasiMaba::PEROLEHAN_JUARA_SELECT[$row->perolehan_juara] : '';
            });
            $table->editColumn('nama_penyelenggara', function ($row) {
                return $row->nama_penyelenggara ? $row->nama_penyelenggara : '';
            });
            $table->editColumn('tempat_penyelenggara', function ($row) {
                return $row->tempat_penyelenggara ? $row->tempat_penyelenggara : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'kategori']);

            return $table->make(true);
        }

        return view('admin.prestasiMabas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('prestasi_maba_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategoris = KategoriPrestasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.prestasiMabas.create', compact('kategoris'));
    }

    public function store(StorePrestasiMabaRequest $request)
    {
        $prestasiMaba = PrestasiMaba::create($request->all());

        foreach ($request->input('bukti_kegiatan', []) as $file) {
            $prestasiMaba->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('bukti_kegiatan');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $prestasiMaba->id]);
        }

        return redirect()->route('admin.prestasi-mabas.index');
    }

    public function edit(PrestasiMaba $prestasiMaba)
    {
        abort_if(Gate::denies('prestasi_maba_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategoris = KategoriPrestasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prestasiMaba->load('kategori');

        return view('admin.prestasiMabas.edit', compact('kategoris', 'prestasiMaba'));
    }

    public function update(UpdatePrestasiMabaRequest $request, PrestasiMaba $prestasiMaba)
    {
        $prestasiMaba->update($request->all());

        if (count($prestasiMaba->bukti_kegiatan) > 0) {
            foreach ($prestasiMaba->bukti_kegiatan as $media) {
                if (! in_array($media->file_name, $request->input('bukti_kegiatan', []))) {
                    $media->delete();
                }
            }
        }
        $media = $prestasiMaba->bukti_kegiatan->pluck('file_name')->toArray();
        foreach ($request->input('bukti_kegiatan', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $prestasiMaba->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('bukti_kegiatan');
            }
        }

        return redirect()->route('admin.prestasi-mabas.index');
    }

    public function show(PrestasiMaba $prestasiMaba)
    {
        abort_if(Gate::denies('prestasi_maba_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prestasiMaba->load('kategori');

        return view('admin.prestasiMabas.show', compact('prestasiMaba'));
    }

    public function destroy(PrestasiMaba $prestasiMaba)
    {
        abort_if(Gate::denies('prestasi_maba_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prestasiMaba->delete();

        return back();
    }

    public function massDestroy(MassDestroyPrestasiMabaRequest $request)
    {
        $prestasiMabas = PrestasiMaba::find(request('ids'));

        foreach ($prestasiMabas as $prestasiMaba) {
            $prestasiMaba->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('prestasi_maba_create') && Gate::denies('prestasi_maba_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PrestasiMaba();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

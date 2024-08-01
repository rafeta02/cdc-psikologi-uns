<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPrestasiMahasiswaRequest;
use App\Http\Requests\StorePrestasiMahasiswaRequest;
use App\Http\Requests\UpdatePrestasiMahasiswaRequest;
use App\Models\KategoriPrestasi;
use App\Models\PrestasiMahasiswa;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PrestasiMahasiswaController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('prestasi_mahasiswa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prestasiMahasiswas = PrestasiMahasiswa::with(['kategori', 'media'])->get();

        return view('frontend.prestasiMahasiswas.index', compact('prestasiMahasiswas'));
    }

    public function create()
    {
        abort_if(Gate::denies('prestasi_mahasiswa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategoris = KategoriPrestasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.prestasiMahasiswas.create', compact('kategoris'));
    }

    public function store(StorePrestasiMahasiswaRequest $request)
    {
        $prestasiMahasiswa = PrestasiMahasiswa::create($request->all());

        foreach ($request->input('surat_tugas', []) as $file) {
            $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('surat_tugas');
        }

        foreach ($request->input('sertifikat', []) as $file) {
            $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('sertifikat');
        }

        foreach ($request->input('foto_dokumentasi', []) as $file) {
            $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('foto_dokumentasi');
        }

        if ($request->input('surat_tugas_pembimbing', false)) {
            $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($request->input('surat_tugas_pembimbing'))))->toMediaCollection('surat_tugas_pembimbing');
        }

        foreach ($request->input('bukti_sipsmart', []) as $file) {
            $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('bukti_sipsmart');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $prestasiMahasiswa->id]);
        }

        return redirect()->route('frontend.prestasi-mahasiswas.index');
    }

    public function edit(PrestasiMahasiswa $prestasiMahasiswa)
    {
        abort_if(Gate::denies('prestasi_mahasiswa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategoris = KategoriPrestasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prestasiMahasiswa->load('kategori');

        return view('frontend.prestasiMahasiswas.edit', compact('kategoris', 'prestasiMahasiswa'));
    }

    public function update(UpdatePrestasiMahasiswaRequest $request, PrestasiMahasiswa $prestasiMahasiswa)
    {
        $prestasiMahasiswa->update($request->all());

        if (count($prestasiMahasiswa->surat_tugas) > 0) {
            foreach ($prestasiMahasiswa->surat_tugas as $media) {
                if (! in_array($media->file_name, $request->input('surat_tugas', []))) {
                    $media->delete();
                }
            }
        }
        $media = $prestasiMahasiswa->surat_tugas->pluck('file_name')->toArray();
        foreach ($request->input('surat_tugas', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('surat_tugas');
            }
        }

        if (count($prestasiMahasiswa->sertifikat) > 0) {
            foreach ($prestasiMahasiswa->sertifikat as $media) {
                if (! in_array($media->file_name, $request->input('sertifikat', []))) {
                    $media->delete();
                }
            }
        }
        $media = $prestasiMahasiswa->sertifikat->pluck('file_name')->toArray();
        foreach ($request->input('sertifikat', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('sertifikat');
            }
        }

        if (count($prestasiMahasiswa->foto_dokumentasi) > 0) {
            foreach ($prestasiMahasiswa->foto_dokumentasi as $media) {
                if (! in_array($media->file_name, $request->input('foto_dokumentasi', []))) {
                    $media->delete();
                }
            }
        }
        $media = $prestasiMahasiswa->foto_dokumentasi->pluck('file_name')->toArray();
        foreach ($request->input('foto_dokumentasi', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('foto_dokumentasi');
            }
        }

        if ($request->input('surat_tugas_pembimbing', false)) {
            if (! $prestasiMahasiswa->surat_tugas_pembimbing || $request->input('surat_tugas_pembimbing') !== $prestasiMahasiswa->surat_tugas_pembimbing->file_name) {
                if ($prestasiMahasiswa->surat_tugas_pembimbing) {
                    $prestasiMahasiswa->surat_tugas_pembimbing->delete();
                }
                $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($request->input('surat_tugas_pembimbing'))))->toMediaCollection('surat_tugas_pembimbing');
            }
        } elseif ($prestasiMahasiswa->surat_tugas_pembimbing) {
            $prestasiMahasiswa->surat_tugas_pembimbing->delete();
        }

        if (count($prestasiMahasiswa->bukti_sipsmart) > 0) {
            foreach ($prestasiMahasiswa->bukti_sipsmart as $media) {
                if (! in_array($media->file_name, $request->input('bukti_sipsmart', []))) {
                    $media->delete();
                }
            }
        }
        $media = $prestasiMahasiswa->bukti_sipsmart->pluck('file_name')->toArray();
        foreach ($request->input('bukti_sipsmart', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('bukti_sipsmart');
            }
        }

        return redirect()->route('frontend.prestasi-mahasiswas.index');
    }

    public function show(PrestasiMahasiswa $prestasiMahasiswa)
    {
        abort_if(Gate::denies('prestasi_mahasiswa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prestasiMahasiswa->load('kategori', 'prestasiMahasiswaPrestasiMahasiswaDetails');

        return view('frontend.prestasiMahasiswas.show', compact('prestasiMahasiswa'));
    }

    public function destroy(PrestasiMahasiswa $prestasiMahasiswa)
    {
        abort_if(Gate::denies('prestasi_mahasiswa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prestasiMahasiswa->delete();

        return back();
    }

    public function massDestroy(MassDestroyPrestasiMahasiswaRequest $request)
    {
        $prestasiMahasiswas = PrestasiMahasiswa::find(request('ids'));

        foreach ($prestasiMahasiswas as $prestasiMahasiswa) {
            $prestasiMahasiswa->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('prestasi_mahasiswa_create') && Gate::denies('prestasi_mahasiswa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PrestasiMahasiswa();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

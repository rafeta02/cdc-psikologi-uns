<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPrestasiMabaRequest;
use App\Http\Requests\StorePrestasiMabaRequest;
use App\Http\Requests\UpdatePrestasiMabaRequest;
use App\Models\KategoriPrestasi;
use App\Models\PrestasiMaba;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use PDF;

class PrestasiMabaController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('prestasi_maba_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prestasiMabas = PrestasiMaba::with(['user', 'kategori', 'media'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.prestasiMabas.index', compact('prestasiMabas'));
    }

    public function create()
    {
        abort_if(Gate::denies('prestasi_maba_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kategoris = KategoriPrestasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.prestasiMabas.create', compact('kategoris', 'users'));
    }

    public function store(StorePrestasiMabaRequest $request)
    {
        $prestasiMaba = PrestasiMaba::create(array_merge($request->all(), ['user_id' => auth()->id()]));

        foreach ($request->input('bukti_kegiatan', []) as $file) {
            $filePath = storage_path('tmp/uploads/' . basename($file));
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);

            $imageNewName = $prestasiMaba->nama_kegiatan .'_' . uniqid(). '.' . $extension;

            $newFilePath = storage_path('tmp/uploads/' . $imageNewName);
            rename($filePath, $newFilePath);

            if (file_exists($newFilePath)) {
                $prestasiMaba->addMedia($newFilePath)->toMediaCollection('bukti_kegiatan');
            } else {
                throw new \Exception('File does not exist at path: ' . $newFilePath);
            }
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $prestasiMaba->id]);
        }

        return redirect()->route('frontend.prestasi-mabas.index');
    }

    public function edit(PrestasiMaba $prestasiMaba)
    {
        abort_if(Gate::denies('prestasi_maba_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($prestasiMaba->user_id != auth()->id()) {
            abort(404);
        }

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kategoris = KategoriPrestasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prestasiMaba->load('user', 'kategori');

        return view('frontend.prestasiMabas.edit', compact('kategoris', 'prestasiMaba', 'users'));
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

        return redirect()->route('frontend.prestasi-mabas.index');
    }

    public function show(PrestasiMaba $prestasiMaba)
    {
        abort_if(Gate::denies('prestasi_maba_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prestasiMaba->load('user', 'kategori');

        return view('frontend.prestasiMabas.show', compact('prestasiMaba'));
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

    public function printBukti(Request $request)
    {
        $prestasi = PrestasiMaba::find($request->id);
        $pdf = PDF::loadView('pdf.bukti_maba', compact('prestasi'));
        return $pdf->download('bukti-prestasi.pdf');
    }
}

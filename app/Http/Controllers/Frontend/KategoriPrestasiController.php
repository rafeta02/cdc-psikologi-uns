<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyKategoriPrestasiRequest;
use App\Http\Requests\StoreKategoriPrestasiRequest;
use App\Http\Requests\UpdateKategoriPrestasiRequest;
use App\Models\KategoriPrestasi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KategoriPrestasiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kategori_prestasi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategoriPrestasis = KategoriPrestasi::all();

        return view('frontend.kategoriPrestasis.index', compact('kategoriPrestasis'));
    }

    public function create()
    {
        abort_if(Gate::denies('kategori_prestasi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.kategoriPrestasis.create');
    }

    public function store(StoreKategoriPrestasiRequest $request)
    {
        $kategoriPrestasi = KategoriPrestasi::create($request->all());

        return redirect()->route('frontend.kategori-prestasis.index');
    }

    public function edit(KategoriPrestasi $kategoriPrestasi)
    {
        abort_if(Gate::denies('kategori_prestasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.kategoriPrestasis.edit', compact('kategoriPrestasi'));
    }

    public function update(UpdateKategoriPrestasiRequest $request, KategoriPrestasi $kategoriPrestasi)
    {
        $kategoriPrestasi->update($request->all());

        return redirect()->route('frontend.kategori-prestasis.index');
    }

    public function show(KategoriPrestasi $kategoriPrestasi)
    {
        abort_if(Gate::denies('kategori_prestasi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.kategoriPrestasis.show', compact('kategoriPrestasi'));
    }

    public function destroy(KategoriPrestasi $kategoriPrestasi)
    {
        abort_if(Gate::denies('kategori_prestasi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategoriPrestasi->delete();

        return back();
    }

    public function massDestroy(MassDestroyKategoriPrestasiRequest $request)
    {
        $kategoriPrestasis = KategoriPrestasi::find(request('ids'));

        foreach ($kategoriPrestasis as $kategoriPrestasi) {
            $kategoriPrestasi->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

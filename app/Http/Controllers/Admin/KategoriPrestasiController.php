<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyKategoriPrestasiRequest;
use App\Http\Requests\StoreKategoriPrestasiRequest;
use App\Http\Requests\UpdateKategoriPrestasiRequest;
use App\Models\KategoriPrestasi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class KategoriPrestasiController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('kategori_prestasi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = KategoriPrestasi::query()->select(sprintf('%s.*', (new KategoriPrestasi)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'kategori_prestasi_show';
                $editGate      = 'kategori_prestasi_edit';
                $deleteGate    = 'kategori_prestasi_delete';
                $crudRoutePart = 'kategori-prestasis';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.kategoriPrestasis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('kategori_prestasi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategoriPrestasis.create');
    }

    public function store(StoreKategoriPrestasiRequest $request)
    {
        $kategoriPrestasi = KategoriPrestasi::create($request->all());

        return redirect()->route('admin.kategori-prestasis.index');
    }

    public function edit(KategoriPrestasi $kategoriPrestasi)
    {
        abort_if(Gate::denies('kategori_prestasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategoriPrestasis.edit', compact('kategoriPrestasi'));
    }

    public function update(UpdateKategoriPrestasiRequest $request, KategoriPrestasi $kategoriPrestasi)
    {
        $kategoriPrestasi->update($request->all());

        return redirect()->route('admin.kategori-prestasis.index');
    }

    public function show(KategoriPrestasi $kategoriPrestasi)
    {
        abort_if(Gate::denies('kategori_prestasi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategoriPrestasis.show', compact('kategoriPrestasi'));
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

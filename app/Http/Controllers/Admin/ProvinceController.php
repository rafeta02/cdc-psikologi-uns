<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProvinceRequest;
use App\Http\Requests\StoreProvinceRequest;
use App\Http\Requests\UpdateProvinceRequest;
use App\Models\Province;
use App\Models\Regency;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProvinceController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('province_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Province::query()->select(sprintf('%s.*', (new Province)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'province_show';
                $editGate      = 'province_edit';
                $deleteGate    = 'province_delete';
                $crudRoutePart = 'provinces';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.provinces.index');
    }

    public function create()
    {
        abort_if(Gate::denies('province_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.provinces.create');
    }

    public function store(StoreProvinceRequest $request)
    {
        $province = Province::create($request->all());

        return redirect()->route('admin.provinces.index');
    }

    public function edit(Province $province)
    {
        abort_if(Gate::denies('province_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.provinces.edit', compact('province'));
    }

    public function update(UpdateProvinceRequest $request, Province $province)
    {
        $province->update($request->all());

        return redirect()->route('admin.provinces.index');
    }

    public function show(Province $province)
    {
        abort_if(Gate::denies('province_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.provinces.show', compact('province'));
    }

    public function destroy(Province $province)
    {
        abort_if(Gate::denies('province_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $province->delete();

        return back();
    }

    public function massDestroy(MassDestroyProvinceRequest $request)
    {
        $provinces = Province::find(request('ids'));

        foreach ($provinces as $province) {
            $province->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getProvincesWithRegencies(Request $request)
    {
        $query = $request->input('q');

        // Fetch regencies with their provinces
        $regencies = Regency::where('name', 'like', '%' . $query . '%')
            ->with('province')
            ->get();

        // Group regencies by province
        $results = [];
        foreach ($regencies as $regency) {
            $provinceName = $regency->province->name;
            if (!isset($results[$provinceName])) {
                $results[$provinceName] = [];
            }
            $results[$provinceName][] = [
                'id' => $regency->id,
                'text' => $regency->name
            ];
        }

        // Format the result as Select2 expects
        $formattedResults = [];
        foreach ($results as $province => $regencies) {
            $formattedResults[] = [
                'text' => $province,
                'children' => $regencies
            ];
        }

        return response()->json($formattedResults);
    }

    public function getProvinces(Request $request)
    {
        $query = $request->input('q');

        $provinces = Province::where('name', 'like', '%' . $query . '%')
            ->orWhereHas('regencies', function($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->with('regencies')
            ->get();

        return response()->json($regencies);
    }

    public function getRegencies(Request $request)
    {
        $query = $request->input('q');

        $regencies = Regency::where('name', 'like', '%' . $query . '%')
            ->orWhereHas('province', function($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->with('province')
            ->get()
            ->map(function($regency) {
                return [
                    'id' => $regency->id,
                    'text' => $regency->name . ', ' . $regency->province->name
                ];
            });

        return response()->json($regencies);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyIndustryRequest;
use App\Http\Requests\StoreIndustryRequest;
use App\Http\Requests\UpdateIndustryRequest;
use App\Models\Industry;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IndustryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('industry_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Industry::query()->select(sprintf('%s.*', (new Industry)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'industry_show';
                $editGate      = 'industry_edit';
                $deleteGate    = 'industry_delete';
                $crudRoutePart = 'industries';

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
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.industries.index');
    }

    public function create()
    {
        abort_if(Gate::denies('industry_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.industries.create');
    }

    public function store(StoreIndustryRequest $request)
    {
        $industry = Industry::create($request->all());

        return redirect()->route('admin.industries.index');
    }

    public function edit(Industry $industry)
    {
        abort_if(Gate::denies('industry_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.industries.edit', compact('industry'));
    }

    public function update(UpdateIndustryRequest $request, Industry $industry)
    {
        $industry->update($request->all());

        return redirect()->route('admin.industries.index');
    }

    public function show(Industry $industry)
    {
        abort_if(Gate::denies('industry_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.industries.show', compact('industry'));
    }

    public function destroy(Industry $industry)
    {
        abort_if(Gate::denies('industry_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $industry->delete();

        return back();
    }

    public function massDestroy(MassDestroyIndustryRequest $request)
    {
        $industries = Industry::find(request('ids'));

        foreach ($industries as $industry) {
            $industry->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

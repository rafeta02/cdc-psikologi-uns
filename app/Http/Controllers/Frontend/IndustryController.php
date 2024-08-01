<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyIndustryRequest;
use App\Http\Requests\StoreIndustryRequest;
use App\Http\Requests\UpdateIndustryRequest;
use App\Models\Industry;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IndustryController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('industry_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $industries = Industry::all();

        return view('frontend.industries.index', compact('industries'));
    }

    public function create()
    {
        abort_if(Gate::denies('industry_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.industries.create');
    }

    public function store(StoreIndustryRequest $request)
    {
        $industry = Industry::create($request->all());

        return redirect()->route('frontend.industries.index');
    }

    public function edit(Industry $industry)
    {
        abort_if(Gate::denies('industry_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.industries.edit', compact('industry'));
    }

    public function update(UpdateIndustryRequest $request, Industry $industry)
    {
        $industry->update($request->all());

        return redirect()->route('frontend.industries.index');
    }

    public function show(Industry $industry)
    {
        abort_if(Gate::denies('industry_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.industries.show', compact('industry'));
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

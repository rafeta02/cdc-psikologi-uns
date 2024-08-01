<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyRegencyRequest;
use App\Http\Requests\StoreRegencyRequest;
use App\Http\Requests\UpdateRegencyRequest;
use App\Models\Province;
use App\Models\Regency;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegenciesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('regency_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regencies = Regency::with(['province'])->get();

        return view('frontend.regencies.index', compact('regencies'));
    }

    public function create()
    {
        abort_if(Gate::denies('regency_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provinces = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.regencies.create', compact('provinces'));
    }

    public function store(StoreRegencyRequest $request)
    {
        $regency = Regency::create($request->all());

        return redirect()->route('frontend.regencies.index');
    }

    public function edit(Regency $regency)
    {
        abort_if(Gate::denies('regency_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provinces = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $regency->load('province');

        return view('frontend.regencies.edit', compact('provinces', 'regency'));
    }

    public function update(UpdateRegencyRequest $request, Regency $regency)
    {
        $regency->update($request->all());

        return redirect()->route('frontend.regencies.index');
    }

    public function show(Regency $regency)
    {
        abort_if(Gate::denies('regency_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regency->load('province');

        return view('frontend.regencies.show', compact('regency'));
    }

    public function destroy(Regency $regency)
    {
        abort_if(Gate::denies('regency_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regency->delete();

        return back();
    }

    public function massDestroy(MassDestroyRegencyRequest $request)
    {
        $regencies = Regency::find(request('ids'));

        foreach ($regencies as $regency) {
            $regency->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTracerAlumnuRequest;
use App\Http\Requests\StoreTracerAlumnuRequest;
use App\Http\Requests\UpdateTracerAlumnuRequest;
use App\Models\Regency;
use App\Models\TracerAlumnu;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Alert;

class TracerAlumniController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tracer_alumnu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tracerAlumnus = TracerAlumnu::with(['user', 'kota_asal', 'kota_domisili'])->get();

        return view('frontend.tracerAlumnus.index', compact('tracerAlumnus'));
    }

    public function create()
    {
        abort_if(Gate::denies('tracer_alumnu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kota_asals = Regency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kota_domisilis = Regency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.tracerAlumnus.create', compact('kota_asals', 'kota_domisilis', 'users'));
    }

    public function store(StoreTracerAlumnuRequest $request)
    {

        $tracerAlumnu = TracerAlumnu::create(array_merge($request->all(), ['user_id' => auth()->id()]));

        Alert::success('Success', 'Data Berhasil Disimpan, Terima kasih.');

        return redirect()->route('frontend.tracer-alumnus.index');
    }

    public function edit(TracerAlumnu $tracerAlumnu)
    {
        abort_if(Gate::denies('tracer_alumnu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kota_asals = Regency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kota_domisilis = Regency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tracerAlumnu->load('user', 'kota_asal', 'kota_domisili');

        return view('frontend.tracerAlumnus.edit', compact('kota_asals', 'kota_domisilis', 'tracerAlumnu', 'users'));
    }

    public function update(UpdateTracerAlumnuRequest $request, TracerAlumnu $tracerAlumnu)
    {
        $tracerAlumnu->update($request->all());

        return redirect()->route('frontend.tracer-alumnus.index');
    }

    public function show(TracerAlumnu $tracerAlumnu)
    {
        abort_if(Gate::denies('tracer_alumnu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tracerAlumnu->load('user', 'kota_asal', 'kota_domisili');

        return view('frontend.tracerAlumnus.show', compact('tracerAlumnu'));
    }

    public function destroy(TracerAlumnu $tracerAlumnu)
    {
        abort_if(Gate::denies('tracer_alumnu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tracerAlumnu->delete();

        return back();
    }

    public function massDestroy(MassDestroyTracerAlumnuRequest $request)
    {
        $tracerAlumnus = TracerAlumnu::find(request('ids'));

        foreach ($tracerAlumnus as $tracerAlumnu) {
            $tracerAlumnu->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

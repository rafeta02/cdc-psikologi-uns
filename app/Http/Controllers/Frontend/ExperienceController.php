<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyExperienceRequest;
use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Models\Experience;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExperienceController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('experience_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $experiences = Experience::all();

        return view('frontend.experiences.index', compact('experiences'));
    }

    public function create()
    {
        abort_if(Gate::denies('experience_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.experiences.create');
    }

    public function store(StoreExperienceRequest $request)
    {
        $experience = Experience::create($request->all());

        return redirect()->route('frontend.experiences.index');
    }

    public function edit(Experience $experience)
    {
        abort_if(Gate::denies('experience_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.experiences.edit', compact('experience'));
    }

    public function update(UpdateExperienceRequest $request, Experience $experience)
    {
        $experience->update($request->all());

        return redirect()->route('frontend.experiences.index');
    }

    public function show(Experience $experience)
    {
        abort_if(Gate::denies('experience_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.experiences.show', compact('experience'));
    }

    public function destroy(Experience $experience)
    {
        abort_if(Gate::denies('experience_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $experience->delete();

        return back();
    }

    public function massDestroy(MassDestroyExperienceRequest $request)
    {
        $experiences = Experience::find(request('ids'));

        foreach ($experiences as $experience) {
            $experience->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

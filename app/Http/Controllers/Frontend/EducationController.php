<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEducationRequest;
use App\Http\Requests\StoreEducationRequest;
use App\Http\Requests\UpdateEducationRequest;
use App\Models\Education;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EducationController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('education_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educations = Education::all();

        return view('frontend.educations.index', compact('educations'));
    }

    public function create()
    {
        abort_if(Gate::denies('education_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.educations.create');
    }

    public function store(StoreEducationRequest $request)
    {
        $education = Education::create($request->all());

        return redirect()->route('frontend.educations.index');
    }

    public function edit(Education $education)
    {
        abort_if(Gate::denies('education_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.educations.edit', compact('education'));
    }

    public function update(UpdateEducationRequest $request, Education $education)
    {
        $education->update($request->all());

        return redirect()->route('frontend.educations.index');
    }

    public function show(Education $education)
    {
        abort_if(Gate::denies('education_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.educations.show', compact('education'));
    }

    public function destroy(Education $education)
    {
        abort_if(Gate::denies('education_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $education->delete();

        return back();
    }

    public function massDestroy(MassDestroyEducationRequest $request)
    {
        $educations = Education::find(request('ids'));

        foreach ($educations as $education) {
            $education->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

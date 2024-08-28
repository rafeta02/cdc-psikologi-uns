<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyResultAssessmentRequest;
use App\Http\Requests\StoreResultAssessmentRequest;
use App\Http\Requests\UpdateResultAssessmentRequest;
use App\Models\ResultAssessment;
use App\Models\User;
use App\Models\Question;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResultAssessmentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('result_assessment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resultAssessments = ResultAssessment::with(['users'])->get();

        return view('frontend.resultAssessments.index', compact('resultAssessments'));
    }

    public function create()
    {
        abort_if(Gate::denies('result_assessment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $question1 = Question::where('type', 'HCI')->get();
        $question2 = Question::where('type', 'WR')->get();
        $question3 = Question::where('type', 'CCI')->get();

        return view('frontend.resultAssessments.create', compact('question1', 'question2', 'question3'));
    }

    public function store(StoreResultAssessmentRequest $request)
    {
        $resultAssessment = ResultAssessment::create($request->all());
        $resultAssessment->users()->sync($request->input('users', []));

        return redirect()->route('frontend.result-assessments.index');
    }

    public function edit(ResultAssessment $resultAssessment)
    {
        abort_if(Gate::denies('result_assessment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id');

        $resultAssessment->load('users');

        return view('frontend.resultAssessments.edit', compact('resultAssessment', 'users'));
    }

    public function update(UpdateResultAssessmentRequest $request, ResultAssessment $resultAssessment)
    {
        $resultAssessment->update($request->all());
        $resultAssessment->users()->sync($request->input('users', []));

        return redirect()->route('frontend.result-assessments.index');
    }

    public function show(ResultAssessment $resultAssessment)
    {
        abort_if(Gate::denies('result_assessment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resultAssessment->load('users');

        return view('frontend.resultAssessments.show', compact('resultAssessment'));
    }

    public function destroy(ResultAssessment $resultAssessment)
    {
        abort_if(Gate::denies('result_assessment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resultAssessment->delete();

        return back();
    }

    public function massDestroy(MassDestroyResultAssessmentRequest $request)
    {
        $resultAssessments = ResultAssessment::find(request('ids'));

        foreach ($resultAssessments as $resultAssessment) {
            $resultAssessment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

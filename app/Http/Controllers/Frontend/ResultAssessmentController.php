<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyResultAssessmentRequest;
use App\Http\Requests\StoreResultAssessmentRequest;
use App\Http\Requests\UpdateResultAssessmentRequest;
use App\Models\ResultAssessment;
use App\Models\HollandTest;
use App\Models\CareerConfidenceTest;
use App\Models\WorkReadinessTest;
use App\Models\User;
use App\Models\Question;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Alert;
use DB;

class ResultAssessmentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('result_assessment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resultAssessments = ResultAssessment::with(['user'])->get();

        return view('frontend.resultAssessments.index', compact('resultAssessments'));
    }

    public function takeTest($test)
    {
        $questions = Question::where('type', $test)->orderBy('number', 'ASC')->get();

        if ($questions->count() <= 0) {
            Alert::error('Oops!', 'Test tidak tersedia.');
            return redirect()->back();
        }

        return view("frontend.resultAssessments.{$test}", compact('questions'));
    }

    public function create()
    {
        abort_if(Gate::denies('result_assessment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $question1 = Question::where('type', 'HCI')->orderBy('number', 'ASC')->get();
        $question2 = Question::where('type', 'WR')->orderBy('number', 'ASC')->get();
        $question3 = Question::where('type', 'CCI')->orderBy('number', 'ASC')->get();

        return view('frontend.resultAssessments.create', compact('question1', 'question2', 'question3'));
    }

    public function store(StoreResultAssessmentRequest $request)
    {
        DB::beginTransaction();
        try {
            $resultAssessmentData = $request->only(['initial', 'age', 'gender', 'field', 'test_name']);
            $resultAssessmentData['user_id'] = auth()->id();

            $resultAssessment = ResultAssessment::create($resultAssessmentData);

            $questions = Question::where('type', $request->test_name)->get();

            if ($questions->count() <= 0) {
                Alert::error('Oops!', 'Test tidak tersedia.');
                throw new \Exception('Test tidak tersedia');
            }

            $testData = [
                'user_id' => auth()->id(),
                'result_id' => $resultAssessment->id,
            ];

            foreach ($questions as $question) {
                $testData[$question->code] = $request->input($question->code);
            }

            if ($request->test_name == 'hci') {
                HollandTest::create($testData);
            } else if ($request->test_name == 'cci') {
                CareerConfidenceTest::create($testData);
            } else if ($request->test_name == 'wr') {
                WorkReadinessTest::create($testData);
            }

            DB::commit();

            Alert::success('Assessment Career Berhasil Disimpan. Terima kasih');

            return redirect()->route('frontend.assessments.index');
        } catch (\Exception $e) {
            DB::rollback();

            Alert::error('Oops!', $e);

            return redirect()->back()->with('error-message', $e->getMessage())->withInput();
        }
    }

    public function bukanstore(StoreResultAssessmentRequest $request)
    {
        $resultAssessmentData = $request->only(['initial', 'age', 'gender', 'field']);
        $resultAssessmentData['user_id'] = auth()->id();
        $resultAssessmentData['test_name'] = 'karir';

        // Step 2: Save the ResultAssessment data
        $resultAssessment = ResultAssessment::create($resultAssessmentData);

        // Step 3: Save the HollandTest data
        $hollandTestData = [
            'user_id' => auth()->id(),
            'result_id' => $resultAssessment->id,
            'r_1' => $request->input('HCI_R1'),
            'r_2' => $request->input('HCI_R2'),
            'r_3' => $request->input('HCI_R3'),
            'r_4' => $request->input('HCI_R4'),
            'r_5' => $request->input('HCI_R5'),
            'r_6' => $request->input('HCI_R6'),
            'r_7' => $request->input('HCI_R7'),
            'r_8' => $request->input('HCI_R8'),
            'i_1' => $request->input('HCI_I1'),
            'i_2' => $request->input('HCI_I2'),
            'i_3' => $request->input('HCI_I3'),
            'i_4' => $request->input('HCI_I4'),
            'i_5' => $request->input('HCI_I5'),
            'i_6' => $request->input('HCI_I6'),
            'i_7' => $request->input('HCI_I7'),
            'i_8' => $request->input('HCI_I8'),
            'a_1' => $request->input('HCI_A1'),
            'a_2' => $request->input('HCI_A2'),
            'a_3' => $request->input('HCI_A3'),
            'a_4' => $request->input('HCI_A4'),
            'a_5' => $request->input('HCI_A5'),
            'a_6' => $request->input('HCI_A6'),
            'a_7' => $request->input('HCI_A7'),
            'a_8' => $request->input('HCI_A8'),
            's_1' => $request->input('HCI_S1'),
            's_2' => $request->input('HCI_S2'),
            's_3' => $request->input('HCI_S3'),
            's_4' => $request->input('HCI_S4'),
            's_5' => $request->input('HCI_S5'),
            's_6' => $request->input('HCI_S6'),
            's_7' => $request->input('HCI_S7'),
            's_8' => $request->input('HCI_S8'),
            'e_1' => $request->input('HCI_E1'),
            'e_2' => $request->input('HCI_E2'),
            'e_3' => $request->input('HCI_E3'),
            'e_4' => $request->input('HCI_E4'),
            'e_5' => $request->input('HCI_E5'),
            'e_6' => $request->input('HCI_E6'),
            'e_7' => $request->input('HCI_E7'),
            'e_8' => $request->input('HCI_E8'),
            'c_1' => $request->input('HCI_C1'),
            'c_2' => $request->input('HCI_C2'),
            'c_3' => $request->input('HCI_C3'),
            'c_4' => $request->input('HCI_C4'),
            'c_5' => $request->input('HCI_C5'),
            'c_6' => $request->input('HCI_C6'),
            'c_7' => $request->input('HCI_C7'),
            'c_8' => $request->input('HCI_C8'),
        ];
        HollandTest::create($hollandTestData);

        // Step 4: Save the CareerConfidenceTest data
        $careerConfidenceTestData = [
            'user_id' => auth()->id(),
            'result_id' => $resultAssessment->id,
            'r_1' => $request->input('CCI_R1'),
            'r_2' => $request->input('CCI_R2'),
            'r_3' => $request->input('CCI_R3'),
            'r_4' => $request->input('CCI_R4'),
            'i_1' => $request->input('CCI_I1'),
            'i_2' => $request->input('CCI_I2'),
            'i_3' => $request->input('CCI_I3'),
            'i_4' => $request->input('CCI_I4'),
            'a_1' => $request->input('CCI_A1'),
            'a_2' => $request->input('CCI_A2'),
            'a_3' => $request->input('CCI_A3'),
            'a_4' => $request->input('CCI_A4'),
            's_1' => $request->input('CCI_S1'),
            's_2' => $request->input('CCI_S2'),
            's_3' => $request->input('CCI_S3'),
            's_4' => $request->input('CCI_S4'),
            'e_1' => $request->input('CCI_E1'),
            'e_2' => $request->input('CCI_E2'),
            'e_3' => $request->input('CCI_E3'),
            'e_4' => $request->input('CCI_E4'),
            'c_1' => $request->input('CCI_C1'),
            'c_2' => $request->input('CCI_C2'),
            'c_3' => $request->input('CCI_C3'),
            'c_4' => $request->input('CCI_C4'),
        ];
        CareerConfidenceTest::create($careerConfidenceTestData);

        // Step 5: Save the WorkReadinessTest data
        // Step 3: Map the WorkReadinessTest data
        $workReadinessTestData = [
            'user_id' => auth()->id(),
            'result_id' => $resultAssessment->id,
            'cbs_1' => $request->input('WR_CBS1'),
            'cbs_2' => $request->input('WR_CBS2'),
            'cbs_3' => $request->input('WR_CBS3'),
            'cbs_4' => $request->input('WR_CBS4'),
            'cbs_5' => $request->input('WR_CBS5'),
            'cbs_6' => $request->input('WR_CBS6'),
            'cbs_7' => $request->input('WR_CBS7'),
            'cbs_8' => $request->input('WR_CBS8'),
            'cbs_9' => $request->input('WR_CBS9'),
            'cbs_10' => $request->input('WR_CBS10'),
            'cms_1' => $request->input('WR_CMS1'),
            'cms_2' => $request->input('WR_CMS2'),
            'cms_3' => $request->input('WR_CMS3'),
            'cms_4' => $request->input('WR_CMS4'),
            'its_1' => $request->input('WR_ITS1'),
            'its_2' => $request->input('WR_ITS2'),
            'its_3' => $request->input('WR_ITS3'),
            'sts_1' => $request->input('WR_STS1'),
            'sts_2' => $request->input('WR_STS2'),
            'sts_3' => $request->input('WR_STS3'),
            'sts_4' => $request->input('WR_STS4'),
            'tps_2' => $request->input('WR_TPS2'),
            'tps_4' => $request->input('WR_TPS4'),
            'tps_5' => $request->input('WR_TPS5'),
            'tps_6' => $request->input('WR_TPS6'),
            'cs_1' => $request->input('WR_CS1'),
            'cs_2' => $request->input('WR_CS2'),
            'cs_3' => $request->input('WR_CS3'),
            'cs_4' => $request->input('WR_CS4'),
            'cs_5' => $request->input('WR_CS5'),
            'cs_6' => $request->input('WR_CS6'),
            'cs_7' => $request->input('WR_CS7'),
            'cs_8' => $request->input('WR_CS8'),
            'cs_9' => $request->input('WR_CS9'),
            'fs_1' => $request->input('WR_FS1'),
            'fs_2' => $request->input('WR_FS2'),
            'fs_3' => $request->input('WR_FS3'),
            'ics_1' => $request->input('WR_ICS1'),
            'ics_2' => $request->input('WR_ICS2'),
            'ics_3' => $request->input('WR_ICS3'),
            'ics_4' => $request->input('WR_ICS4'),
            'ics_5' => $request->input('WR_ICS5'),
            'ls_1' => $request->input('WR_LS1'),
            'ls_2' => $request->input('WR_LS2'),
            'ls_3' => $request->input('WR_LS3'),
            'ls_4' => $request->input('WR_LS4'),
            'ls_5' => $request->input('WR_LS5'),
            'sms_1' => $request->input('WR_SMS1'),
            'sms_3' => $request->input('WR_SMS3'),
            'sms_4' => $request->input('WR_SMS4'),
            'sms_5' => $request->input('WR_SMS5'),
            'sms_7' => $request->input('WR_SMS7'),
            'sms_9' => $request->input('WR_SMS9'),
        ];
        WorkReadinessTest::create($workReadinessTestData);

        Alert::success('Assessment Career Berhasil Disimpan. Terima kasih');

        return redirect()->route('frontend.assessments.index');
    }

    public function edit(ResultAssessment $resultAssessment)
    {
        abort_if(Gate::denies('result_assessment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $resultAssessment->load('user');

        return view('frontend.resultAssessments.edit', compact('resultAssessment', 'users'));
    }

    public function update(UpdateResultAssessmentRequest $request, ResultAssessment $resultAssessment)
    {
        $resultAssessment->update($request->all());

        return redirect()->route('frontend.result-assessments.index');
    }

    public function show(ResultAssessment $resultAssessment)
    {
        abort_if(Gate::denies('result_assessment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resultAssessment->load('user');

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

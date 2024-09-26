<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyResultAssessmentRequest;
use App\Http\Requests\StoreResultAssessmentRequest;
use App\Http\Requests\UpdateResultAssessmentRequest;
use App\Models\ResultAssessment;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\AssessmentTypeExport;
use Excel;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;

class ResultAssessmentController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('result_assessment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ResultAssessment::with(['user'])->select(sprintf('%s.*', (new ResultAssessment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'result_assessment_show';
                $editGate      = 'result_assessment_edit';
                $deleteGate    = 'result_assessment_delete';
                $crudRoutePart = 'result-assessments';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('initial', function ($row) {
                return $row->initial ? $row->initial : '';
            });
            $table->editColumn('age', function ($row) {
                return $row->age ? $row->age : '';
            });
            $table->editColumn('gender', function ($row) {
                return $row->gender ? ResultAssessment::GENDER_RADIO[$row->gender] : '';
            });
            $table->editColumn('field', function ($row) {
                return $row->field ? $row->field : '';
            });
            $table->editColumn('test_name', function ($row) {
                $type = 'badge-info';
                switch ($row->test_name) {
                    case 'hci':
                        $type = 'badge-primary';
                        break;
                    case 'wr':
                        $type = 'badge-success';
                        break;
                    case 'cci':
                        $type =  'badge-warning';
                        break;
                }
                return $row->test_name ? '<span class="badge ' . $type . '">' . ResultAssessment::TEST_NAME_SELECT[$row->test_name] .'</span>' : '';
            });
            $table->editColumn('result_text', function ($row) {
                return $row->result_text ? $row->result_text : '';
            });
            $table->editColumn('result_description', function ($row) {
                return $row->result_description ? $row->result_description : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'test_name']);

            return $table->make(true);
        }

        return view('admin.resultAssessments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('result_assessment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.resultAssessments.create', compact('users'));
    }

    public function store(StoreResultAssessmentRequest $request)
    {
        $resultAssessment = ResultAssessment::create($request->all());

        return redirect()->route('admin.result-assessments.index');
    }

    public function edit(ResultAssessment $resultAssessment)
    {
        abort_if(Gate::denies('result_assessment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $resultAssessment->load('user');

        return view('admin.resultAssessments.edit', compact('resultAssessment', 'users'));
    }

    public function update(UpdateResultAssessmentRequest $request, ResultAssessment $resultAssessment)
    {
        $resultAssessment->update($request->all());

        return redirect()->route('admin.result-assessments.index');
    }

    public function show(ResultAssessment $resultAssessment)
    {
        abort_if(Gate::denies('result_assessment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resultAssessment->load('user');

        return view('admin.resultAssessments.show', compact('resultAssessment'));
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

    public function export(Request $request)
    {
        if ($request->has('date') && $request->date && $dates = explode(' - ', $request->date)) {
            $start = Date::parse($dates[0])->startOfDay();
            $end = !isset($dates[1]) ? $start->clone()->endOfMonth() : Date::parse($dates[1])->endOfDay();
        } else {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now();
        }

        $type = $request->has('type') ? $request->type : 'hci';

        return Excel::download(new AssessmentTypeExport($start , $end, $type), 'Assessment Mahasiswa dari ' . $start->format('d-F-Y') .' sd '. $end->format('d-F-Y') . '.xlsx');
    }
}

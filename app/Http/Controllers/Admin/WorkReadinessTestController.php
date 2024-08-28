<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkReadinessTest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WorkReadinessTestController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('work_readiness_test_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WorkReadinessTest::with(['user', 'result'])->select(sprintf('%s.*', (new WorkReadinessTest)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'work_readiness_test_show';
                $editGate      = 'work_readiness_test_edit';
                $deleteGate    = 'work_readiness_test_delete';
                $crudRoutePart = 'work-readiness-tests';

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

            $table->addColumn('result_initial', function ($row) {
                return $row->result ? $row->result->initial : '';
            });

            $table->editColumn('cbs_1', function ($row) {
                return $row->cbs_1 ? $row->cbs_1 : '';
            });
            $table->editColumn('cbs_2', function ($row) {
                return $row->cbs_2 ? $row->cbs_2 : '';
            });
            $table->editColumn('cbs_3', function ($row) {
                return $row->cbs_3 ? $row->cbs_3 : '';
            });
            $table->editColumn('cbs_4', function ($row) {
                return $row->cbs_4 ? $row->cbs_4 : '';
            });
            $table->editColumn('cbs_5', function ($row) {
                return $row->cbs_5 ? $row->cbs_5 : '';
            });
            $table->editColumn('cbs_6', function ($row) {
                return $row->cbs_6 ? $row->cbs_6 : '';
            });
            $table->editColumn('cbs_7', function ($row) {
                return $row->cbs_7 ? $row->cbs_7 : '';
            });
            $table->editColumn('cbs_8', function ($row) {
                return $row->cbs_8 ? $row->cbs_8 : '';
            });
            $table->editColumn('cbs_9', function ($row) {
                return $row->cbs_9 ? $row->cbs_9 : '';
            });
            $table->editColumn('cbs_10', function ($row) {
                return $row->cbs_10 ? $row->cbs_10 : '';
            });
            $table->editColumn('cms_1', function ($row) {
                return $row->cms_1 ? $row->cms_1 : '';
            });
            $table->editColumn('cms_2', function ($row) {
                return $row->cms_2 ? $row->cms_2 : '';
            });
            $table->editColumn('cms_3', function ($row) {
                return $row->cms_3 ? $row->cms_3 : '';
            });
            $table->editColumn('cms_4', function ($row) {
                return $row->cms_4 ? $row->cms_4 : '';
            });
            $table->editColumn('cs_1', function ($row) {
                return $row->cs_1 ? $row->cs_1 : '';
            });
            $table->editColumn('cs_2', function ($row) {
                return $row->cs_2 ? $row->cs_2 : '';
            });
            $table->editColumn('cs_3', function ($row) {
                return $row->cs_3 ? $row->cs_3 : '';
            });
            $table->editColumn('cs_4', function ($row) {
                return $row->cs_4 ? $row->cs_4 : '';
            });
            $table->editColumn('cs_5', function ($row) {
                return $row->cs_5 ? $row->cs_5 : '';
            });
            $table->editColumn('cs_6', function ($row) {
                return $row->cs_6 ? $row->cs_6 : '';
            });
            $table->editColumn('cs_7', function ($row) {
                return $row->cs_7 ? $row->cs_7 : '';
            });
            $table->editColumn('cs_8', function ($row) {
                return $row->cs_8 ? $row->cs_8 : '';
            });
            $table->editColumn('cs_9', function ($row) {
                return $row->cs_9 ? $row->cs_9 : '';
            });
            $table->editColumn('fs_1', function ($row) {
                return $row->fs_1 ? $row->fs_1 : '';
            });
            $table->editColumn('fs_2', function ($row) {
                return $row->fs_2 ? $row->fs_2 : '';
            });
            $table->editColumn('fs_3', function ($row) {
                return $row->fs_3 ? $row->fs_3 : '';
            });
            $table->editColumn('ics_1', function ($row) {
                return $row->ics_1 ? $row->ics_1 : '';
            });
            $table->editColumn('ics_2', function ($row) {
                return $row->ics_2 ? $row->ics_2 : '';
            });
            $table->editColumn('ics_3', function ($row) {
                return $row->ics_3 ? $row->ics_3 : '';
            });
            $table->editColumn('ics_4', function ($row) {
                return $row->ics_4 ? $row->ics_4 : '';
            });
            $table->editColumn('ics_5', function ($row) {
                return $row->ics_5 ? $row->ics_5 : '';
            });
            $table->editColumn('its_1', function ($row) {
                return $row->its_1 ? $row->its_1 : '';
            });
            $table->editColumn('its_2', function ($row) {
                return $row->its_2 ? $row->its_2 : '';
            });
            $table->editColumn('its_3', function ($row) {
                return $row->its_3 ? $row->its_3 : '';
            });
            $table->editColumn('ls_1', function ($row) {
                return $row->ls_1 ? $row->ls_1 : '';
            });
            $table->editColumn('ls_2', function ($row) {
                return $row->ls_2 ? $row->ls_2 : '';
            });
            $table->editColumn('ls_3', function ($row) {
                return $row->ls_3 ? $row->ls_3 : '';
            });
            $table->editColumn('ls_4', function ($row) {
                return $row->ls_4 ? $row->ls_4 : '';
            });
            $table->editColumn('ls_5', function ($row) {
                return $row->ls_5 ? $row->ls_5 : '';
            });
            $table->editColumn('sms_1', function ($row) {
                return $row->sms_1 ? $row->sms_1 : '';
            });
            $table->editColumn('sms_3', function ($row) {
                return $row->sms_3 ? $row->sms_3 : '';
            });
            $table->editColumn('sms_4', function ($row) {
                return $row->sms_4 ? $row->sms_4 : '';
            });
            $table->editColumn('sms_5', function ($row) {
                return $row->sms_5 ? $row->sms_5 : '';
            });
            $table->editColumn('sms_7', function ($row) {
                return $row->sms_7 ? $row->sms_7 : '';
            });
            $table->editColumn('sms_9', function ($row) {
                return $row->sms_9 ? $row->sms_9 : '';
            });
            $table->editColumn('sts_1', function ($row) {
                return $row->sts_1 ? $row->sts_1 : '';
            });
            $table->editColumn('sts_2', function ($row) {
                return $row->sts_2 ? $row->sts_2 : '';
            });
            $table->editColumn('sts_3', function ($row) {
                return $row->sts_3 ? $row->sts_3 : '';
            });
            $table->editColumn('sts_4', function ($row) {
                return $row->sts_4 ? $row->sts_4 : '';
            });
            $table->editColumn('tps_2', function ($row) {
                return $row->tps_2 ? $row->tps_2 : '';
            });
            $table->editColumn('tps_4', function ($row) {
                return $row->tps_4 ? $row->tps_4 : '';
            });
            $table->editColumn('tps_5', function ($row) {
                return $row->tps_5 ? $row->tps_5 : '';
            });
            $table->editColumn('tps_6', function ($row) {
                return $row->tps_6 ? $row->tps_6 : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'result']);

            return $table->make(true);
        }

        return view('admin.workReadinessTests.index');
    }
}

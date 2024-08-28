<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HollandTest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HollandTestController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('holland_test_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HollandTest::with(['user', 'result'])->select(sprintf('%s.*', (new HollandTest)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'holland_test_show';
                $editGate      = 'holland_test_edit';
                $deleteGate    = 'holland_test_delete';
                $crudRoutePart = 'holland-tests';

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

            $table->editColumn('r_1', function ($row) {
                return $row->r_1 ? $row->r_1 : '';
            });
            $table->editColumn('r_2', function ($row) {
                return $row->r_2 ? $row->r_2 : '';
            });
            $table->editColumn('r_3', function ($row) {
                return $row->r_3 ? $row->r_3 : '';
            });
            $table->editColumn('r_4', function ($row) {
                return $row->r_4 ? $row->r_4 : '';
            });
            $table->editColumn('r_5', function ($row) {
                return $row->r_5 ? $row->r_5 : '';
            });
            $table->editColumn('r_6', function ($row) {
                return $row->r_6 ? $row->r_6 : '';
            });
            $table->editColumn('r_7', function ($row) {
                return $row->r_7 ? $row->r_7 : '';
            });
            $table->editColumn('r_8', function ($row) {
                return $row->r_8 ? $row->r_8 : '';
            });
            $table->editColumn('i_1', function ($row) {
                return $row->i_1 ? $row->i_1 : '';
            });
            $table->editColumn('i_2', function ($row) {
                return $row->i_2 ? $row->i_2 : '';
            });
            $table->editColumn('i_3', function ($row) {
                return $row->i_3 ? $row->i_3 : '';
            });
            $table->editColumn('i_4', function ($row) {
                return $row->i_4 ? $row->i_4 : '';
            });
            $table->editColumn('i_5', function ($row) {
                return $row->i_5 ? $row->i_5 : '';
            });
            $table->editColumn('i_6', function ($row) {
                return $row->i_6 ? $row->i_6 : '';
            });
            $table->editColumn('i_7', function ($row) {
                return $row->i_7 ? $row->i_7 : '';
            });
            $table->editColumn('i_8', function ($row) {
                return $row->i_8 ? $row->i_8 : '';
            });
            $table->editColumn('a_1', function ($row) {
                return $row->a_1 ? $row->a_1 : '';
            });
            $table->editColumn('a_2', function ($row) {
                return $row->a_2 ? $row->a_2 : '';
            });
            $table->editColumn('a_3', function ($row) {
                return $row->a_3 ? $row->a_3 : '';
            });
            $table->editColumn('a_4', function ($row) {
                return $row->a_4 ? $row->a_4 : '';
            });
            $table->editColumn('a_5', function ($row) {
                return $row->a_5 ? $row->a_5 : '';
            });
            $table->editColumn('a_6', function ($row) {
                return $row->a_6 ? $row->a_6 : '';
            });
            $table->editColumn('a_7', function ($row) {
                return $row->a_7 ? $row->a_7 : '';
            });
            $table->editColumn('a_8', function ($row) {
                return $row->a_8 ? $row->a_8 : '';
            });
            $table->editColumn('s_1', function ($row) {
                return $row->s_1 ? $row->s_1 : '';
            });
            $table->editColumn('s_2', function ($row) {
                return $row->s_2 ? $row->s_2 : '';
            });
            $table->editColumn('s_3', function ($row) {
                return $row->s_3 ? $row->s_3 : '';
            });
            $table->editColumn('s_4', function ($row) {
                return $row->s_4 ? $row->s_4 : '';
            });
            $table->editColumn('s_5', function ($row) {
                return $row->s_5 ? $row->s_5 : '';
            });
            $table->editColumn('s_6', function ($row) {
                return $row->s_6 ? $row->s_6 : '';
            });
            $table->editColumn('s_7', function ($row) {
                return $row->s_7 ? $row->s_7 : '';
            });
            $table->editColumn('s_8', function ($row) {
                return $row->s_8 ? $row->s_8 : '';
            });
            $table->editColumn('e_1', function ($row) {
                return $row->e_1 ? $row->e_1 : '';
            });
            $table->editColumn('e_2', function ($row) {
                return $row->e_2 ? $row->e_2 : '';
            });
            $table->editColumn('e_3', function ($row) {
                return $row->e_3 ? $row->e_3 : '';
            });
            $table->editColumn('e_4', function ($row) {
                return $row->e_4 ? $row->e_4 : '';
            });
            $table->editColumn('e_5', function ($row) {
                return $row->e_5 ? $row->e_5 : '';
            });
            $table->editColumn('e_6', function ($row) {
                return $row->e_6 ? $row->e_6 : '';
            });
            $table->editColumn('e_7', function ($row) {
                return $row->e_7 ? $row->e_7 : '';
            });
            $table->editColumn('e_8', function ($row) {
                return $row->e_8 ? $row->e_8 : '';
            });
            $table->editColumn('c_1', function ($row) {
                return $row->c_1 ? $row->c_1 : '';
            });
            $table->editColumn('c_2', function ($row) {
                return $row->c_2 ? $row->c_2 : '';
            });
            $table->editColumn('c_3', function ($row) {
                return $row->c_3 ? $row->c_3 : '';
            });
            $table->editColumn('c_4', function ($row) {
                return $row->c_4 ? $row->c_4 : '';
            });
            $table->editColumn('c_5', function ($row) {
                return $row->c_5 ? $row->c_5 : '';
            });
            $table->editColumn('c_6', function ($row) {
                return $row->c_6 ? $row->c_6 : '';
            });
            $table->editColumn('c_7', function ($row) {
                return $row->c_7 ? $row->c_7 : '';
            });
            $table->editColumn('c_8', function ($row) {
                return $row->c_8 ? $row->c_8 : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'result']);

            return $table->make(true);
        }

        return view('admin.hollandTests.index');
    }

    public function show(HollandTest $hollandTest)
    {
        abort_if(Gate::denies('holland_test_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hollandTest->load('user', 'result');

        return view('admin.hollandTests.show', compact('hollandTest'));
    }
}

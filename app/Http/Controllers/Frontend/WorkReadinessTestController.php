<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\WorkReadinessTest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkReadinessTestController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('work_readiness_test_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workReadinessTests = WorkReadinessTest::with(['user', 'result'])->get();

        return view('frontend.workReadinessTests.index', compact('workReadinessTests'));
    }
}

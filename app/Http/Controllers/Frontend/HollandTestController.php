<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HollandTest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HollandTestController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('holland_test_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hollandTests = HollandTest::with(['user', 'result'])->get();

        return view('frontend.hollandTests.index', compact('hollandTests'));
    }

    public function show(HollandTest $hollandTest)
    {
        abort_if(Gate::denies('holland_test_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hollandTest->load('user', 'result');

        return view('frontend.hollandTests.show', compact('hollandTest'));
    }
}

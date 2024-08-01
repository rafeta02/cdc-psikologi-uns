<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CareerConfidenceTest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CareerConfidenceTestController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('career_confidence_test_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $careerConfidenceTests = CareerConfidenceTest::with(['user', 'result'])->get();

        return view('frontend.careerConfidenceTests.index', compact('careerConfidenceTests'));
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PrestasiMahasiswaDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrestasiMahasiswaDetailController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('prestasi_mahasiswa_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prestasiMahasiswaDetails = PrestasiMahasiswaDetail::with(['prestasi_mahasiswa'])->get();

        return view('frontend.prestasiMahasiswaDetails.index', compact('prestasiMahasiswaDetails'));
    }
}

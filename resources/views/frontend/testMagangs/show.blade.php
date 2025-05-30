@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.testMagang.title_singular') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.test-magangs.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">Informasi Test</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Tipe Test</th>
                                                <td>
                                                    <span class="badge {{ $testMagang->type == 'PRETEST' ? 'bg-info' : 'bg-success' }}">
                                                        {{ $testMagang->type }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Mahasiswa</th>
                                                <td>{{ $testMagang->mahasiswa->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tempat Magang</th>
                                                <td>{{ $testMagang->magang->instansi }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Test</th>
                                                <td>{{ $testMagang->created_at->format('d F Y, H:i') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">Hasil Test</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <div style="width: 150px; height: 150px; margin: 0 auto;" 
                                                class="rounded-circle d-flex align-items-center justify-content-center 
                                                {{ $testMagang->result >= 4 ? 'bg-success' : ($testMagang->result >= 3 ? 'bg-primary' : 'bg-warning') }} text-white">
                                                <span style="font-size: 48px;">{{ number_format($testMagang->result, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <h5>Interpretasi</h5>
                                            <p>
                                                @if($testMagang->result >= 4)
                                                    <strong>Sangat Baik (4.00 - 5.00)</strong>: Anda menunjukkan kemampuan adaptasi dan pemecahan masalah yang sangat baik.
                                                @elseif($testMagang->result >= 3)
                                                    <strong>Baik (3.00 - 3.99)</strong>: Anda memiliki kemampuan adaptasi dan pemecahan masalah yang baik.
                                                @elseif($testMagang->result >= 2)
                                                    <strong>Cukup (2.00 - 2.99)</strong>: Anda memiliki kemampuan adaptasi dan pemecahan masalah yang cukup.
                                                @else
                                                    <strong>Perlu Peningkatan (< 2.00)</strong>: Anda perlu meningkatkan kemampuan adaptasi dan pemecahan masalah.
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Detail Jawaban</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Pernyataan</th>
                                                <th>Skor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $questions = [
                                                "Saya senang ketika bekerja dengan orang lain untuk menyelesaikan masalah.",
                                                "Saya tetap merasa nyaman dalam kondisi pekerjaan yang berubah.",
                                                "Saya mengingat informasi baru dengan mudah.",
                                                "Saya memberikan hasil yang baik dalam situasi yang berubah.",
                                                "Saya optimis dapat mempelajari informasi baru.",
                                                "Saya berpikir sangat logis ketika menyelesaikan berbagai masalah.",
                                                "Saya menikmati perubahan suasana ketika melakukan berbagai pekerjaan.",
                                                "Saya memahami pendekatan yang terbaik untuk mempelajari sesuatu yang baru.",
                                                "Saya berusaha mencari feedback tentang keterampilan dan kemampuan yang dimiliki.",
                                                "Saya tidak langsung menerima informasi dari orang lain begitu saja.",
                                                "Saya merasa puas saat menggali lebih dalam tentang cara-cara untuk menyelesaikan masalah.",
                                                "Jika satu pendekatan pemecahan masalah itu gagal, saya mencoba cara yang lain.",
                                                "Saya mencari orang baru, untuk belajar tentang topik di luar bidang pekerjaan saya.",
                                                "Saya dapat menemukan cara untuk menyelesaikan pekerjaan bahkan saat tidak diberikan arahan yang jelas.",
                                                "Saya berkenalan dengan banyak orang untuk mencari tahu cara menjadi seseorang yang lebih efektif dan efisien.",
                                                "Saya senang belajar dari orang lain.",
                                                "Saya mencari cara untuk menggunakan pengetahuan baru.",
                                                "Saya seringkali didatangi orang lain ketika mereka membutuhkan bantuan menyelesaikan masalah."
                                            ];
                                            @endphp
                                            
                                            @for ($i = 1; $i <= 18; $i++)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $questions[$i-1] }}</td>
                                                    <td>
                                                        <span class="badge {{ $testMagang->{"q_$i"} >= 4 ? 'bg-success' : ($testMagang->{"q_$i"} >= 3 ? 'bg-primary' : ($testMagang->{"q_$i"} >= 2 ? 'bg-warning' : 'bg-danger')) }}">
                                                            {{ $testMagang->{"q_$i"} }}
                                                            - 
                                                            @if($testMagang->{"q_$i"} == 1)
                                                                Tidak Pernah
                                                            @elseif($testMagang->{"q_$i"} == 2)
                                                                Pernah
                                                            @elseif($testMagang->{"q_$i"} == 3)
                                                                Jarang
                                                            @elseif($testMagang->{"q_$i"} == 4)
                                                                Sering
                                                            @elseif($testMagang->{"q_$i"} == 5)
                                                                Selalu
                                                            @endif
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
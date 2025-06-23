@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.testMagang.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover datatable datatable-TestMagang">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.testMagang.fields.mahasiswa') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.testMagang.fields.magang') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.testMagang.fields.type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.testMagang.fields.result') }}
                                    </th>
                                    <th>
                                        Test Taken
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($testMagangs as $key => $testMagang)
                                    <tr data-entry-id="{{ $testMagang->id }}">
                                        <td class="text-center">
                                            {{ $testMagang->mahasiswa->name ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $testMagang->magang->instansi ?? '' }}
                                        </td>
                                        <td  class="text-center">
                                            {{ $testMagang->type ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge {{ $testMagang->result >= 4 ? 'bg-success' : ($testMagang->result >= 3 ? 'bg-primary' : 'bg-warning') }}">
                                                {{ number_format($testMagang->result, 2) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            {{ $testMagang->created_at->format('d M Y H:i') ?? '' }}
                                        </td>
                                        <td  class="text-center">
                                            @can('test_magang_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.test-magangs.show', $testMagang->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    Hasil Test Summary
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h5>Skor Pre-Test Rata-Rata</h5>
                                </div>
                                <div class="card-body">
                                    @php
                                        $pretests = $testMagangs->where('type', 'PRETEST');
                                        $pretest_avg = $pretests->count() > 0 ? $pretests->avg('result') : 0;
                                    @endphp
                                    
                                    <div class="d-flex align-items-center">
                                        <div style="width: 100px; height: 100px;" class="rounded-circle d-flex align-items-center justify-content-center 
                                            {{ $pretest_avg >= 4 ? 'bg-success' : ($pretest_avg >= 3 ? 'bg-primary' : 'bg-warning') }} text-white">
                                            <span style="font-size: 28px;">{{ number_format($pretest_avg, 2) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <p class="mb-0">
                                                @if($pretest_avg >= 4)
                                                    <strong>Sangat Baik</strong>: Anda memiliki kemampuan adaptasi tinggi sebelum magang.
                                                @elseif($pretest_avg >= 3)
                                                    <strong>Baik</strong>: Anda memiliki kemampuan adaptasi yang cukup sebelum magang.
                                                @elseif($pretest_avg > 0)
                                                    <strong>Perlu Ditingkatkan</strong>: Tingkatkan kemampuan adaptasi anda selama magang.
                                                @else
                                                    <strong>Belum Ada Data</strong>: Anda belum mengambil pre-test.
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h5>Skor Post-Test Rata-Rata</h5>
                                </div>
                                <div class="card-body">
                                    @php
                                        $posttests = $testMagangs->where('type', 'POSTTEST');
                                        $posttest_avg = $posttests->count() > 0 ? $posttests->avg('result') : 0;
                                    @endphp
                                    
                                    <div class="d-flex align-items-center">
                                        <div style="width: 100px; height: 100px;" class="rounded-circle d-flex align-items-center justify-content-center 
                                            {{ $posttest_avg >= 4 ? 'bg-success' : ($posttest_avg >= 3 ? 'bg-primary' : 'bg-warning') }} text-white">
                                            <span style="font-size: 28px;">{{ number_format($posttest_avg, 2) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <p class="mb-0">
                                                @if($posttest_avg >= 4)
                                                    <strong>Sangat Baik</strong>: Anda menunjukkan peningkatan kemampuan adaptasi yang signifikan.
                                                @elseif($posttest_avg >= 3)
                                                    <strong>Baik</strong>: Anda menunjukkan peningkatan kemampuan adaptasi yang baik.
                                                @elseif($posttest_avg > 0)
                                                    <strong>Perlu Ditingkatkan</strong>: Anda masih perlu meningkatkan kemampuan adaptasi.
                                                @else
                                                    <strong>Belum Ada Data</strong>: Anda belum mengambil post-test.
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($pretests->count() > 0 && $posttests->count() > 0)
                        <div class="alert alert-info mt-4">
                            <h5><i class="fas fa-info-circle mr-2"></i> Insight Perkembangan</h5>
                            @php
                                $improvement = $posttest_avg - $pretest_avg;
                                $improvement_percent = $pretest_avg > 0 ? ($improvement / $pretest_avg) * 100 : 0;
                            @endphp
                            
                            @if($improvement > 0)
                                <p class="mb-0">Selamat! Anda menunjukkan peningkatan skor sebesar <strong>{{ number_format($improvement, 2) }} poin ({{ number_format($improvement_percent, 1) }}%)</strong> selama masa magang. Ini menunjukkan bahwa pengalaman magang Anda telah berkontribusi positif terhadap kemampuan adaptasi dan pemecahan masalah Anda.</p>
                            @elseif($improvement == 0)
                                <p class="mb-0">Skor Anda tetap stabil dari pre-test ke post-test. Ini menunjukkan bahwa Anda mempertahankan tingkat kemampuan yang sama selama magang.</p>
                            @else
                                <p class="mb-0">Skor Anda menurun sebesar <strong>{{ number_format(abs($improvement), 2) }} poin ({{ number_format(abs($improvement_percent), 1) }}%)</strong>. Ini mungkin menunjukkan bahwa Anda mengalami tantangan selama magang atau penilaian diri Anda menjadi lebih kritis setelah pengalaman magang.</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        
        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 5, 'desc' ]],
            pageLength: 10,
        });
        
        let table = $('.datatable-TestMagang:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    });
</script>
@endsection
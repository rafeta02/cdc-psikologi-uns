@extends('layouts.frontend')

@section('title', 'Prestasi Mahasiswa - CDC Fakultas Psikologi UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Prestasi Mahasiswa</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Prestasi Mahasiswa</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <h4><i class="fas fa-trophy"></i> Achievement Registered!</h4>
                    <p>{{ session('success') }}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            
            @can('prestasi_mahasiswa_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.prestasi-mahasiswas.create') }}">
                            Tambah Prestasi
                        </a>
                    </div>
                </div>
            @endcan
            <!-- Draft legend -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        <span class="badge badge-warning"><i class="fas fa-exclamation-triangle"></i> Draft</span> menandakan form yang belum selesai diisi. Klik "Edit" untuk melanjutkan mengisi form.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.prestasiMahasiswa.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PrestasiMahasiswa">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMahasiswa.fields.nama_kegiatan') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMahasiswa.fields.tingkat') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMahasiswa.fields.kategori') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMahasiswa.fields.perolehan_juara') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMahasiswa.fields.nama_penyelenggara') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMahasiswa.fields.keikutsertaan') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.prestasiMahasiswa.fields.dosen_pembimbing') }}
                                    </th>
                                    <th class="text-center">
                                        Status
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prestasiMahasiswas as $key => $prestasiMahasiswa)
                                    <tr data-entry-id="{{ $prestasiMahasiswa->id }}" @if($prestasiMahasiswa->is_draft ?? false) class="table-warning" @endif>
                                        <td class="text-center">
                                            {{ $prestasiMahasiswa->nama_kegiatan ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ App\Models\PrestasiMahasiswa::TINGKAT_RADIO[$prestasiMahasiswa->tingkat] ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $prestasiMahasiswa->kategori->name ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ App\Models\PrestasiMahasiswa::PEROLEHAN_JUARA_SELECT[$prestasiMahasiswa->perolehan_juara] ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $prestasiMahasiswa->nama_penyelenggara ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $prestasiMahasiswa->keikutsertaan ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $prestasiMahasiswa->dosen_pembimbing ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            @if($prestasiMahasiswa->is_draft ?? false)
                                                <span class="badge badge-warning">Draft</span>
                                                <br>
                                                @php
                                                    $steps = [
                                                        1 => 'Informasi Umum',
                                                        2 => 'Informasi Peserta',
                                                        3 => 'Dokumen Pendukung',
                                                        4 => 'Survey'
                                                    ];
                                                    $currentStep = $prestasiMahasiswa->current_step ?? 1;
                                                    $progress = (($currentStep - 1) / 3) * 100;
                                                @endphp
                                                <div class="progress mt-2" style="height: 20px;">
                                                    <div class="progress-bar" role="progressbar" 
                                                         style="width: {{ $progress }}%;" 
                                                         aria-valuenow="{{ $progress }}" 
                                                         aria-valuemin="0" 
                                                         aria-valuemax="100">
                                                        {{ round($progress) }}%
                                                    </div>
                                                </div>
                                                <small class="d-block mt-2">
                                                    <strong>Langkah {{ $currentStep }} dari 4:</strong><br>
                                                    {{ $steps[$currentStep] }}
                                                </small>
                                                <a href="{{ route('frontend.prestasi-mahasiswas.create', ['draft_id' => $prestasiMahasiswa->id]) }}" 
                                                   class="btn btn-sm btn-info mt-2">
                                                    <i class="fas fa-edit"></i> Lanjutkan Pengisian
                                                </a>
                                            @else
                                                <span class="badge badge-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-xs btn-primary" href="{{ route('frontend.prestasi-mahasiswas.show', $prestasiMahasiswa->id) }}">
                                                {{ trans('global.view') }}
                                            </a>
                                            <a class="btn btn-xs btn-info" href="{{ route('frontend.prestasi-mahasiswas.edit', $prestasiMahasiswa->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>

                                            @if(!($prestasiMahasiswa->is_draft ?? false))
                                            <form action="{{ route('frontend.prestasi-mahasiswas.printBukti') }}" method="POST" style="display: inline-block;">
                                                <input type="hidden" name="id" value="{{ $prestasiMahasiswa->id }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger" value="Print Bukti">
                                            </form>
                                            @else
                                            <a class="btn btn-xs btn-warning" href="{{ route('frontend.prestasi-mahasiswas.create') }}?draft_id={{ $prestasiMahasiswa->id }}">
                                                <i class="fas fa-edit"></i> Continue
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
    order: [[ 1, 'desc' ]],
    pageLength:10,
  });
  let table = $('.datatable-PrestasiMahasiswa:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

  // Check if there's a success message and show confetti
  if ($('.alert-success').length > 0) {
    showCongratulationsEffect();
  }

  // Simple confetti effect
  function showCongratulationsEffect() {
    const colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff'];
    const numConfetti = 150;
    
    for (let i = 0; i < numConfetti; i++) {
      const confetti = document.createElement('div');
      confetti.classList.add('confetti');
      confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
      confetti.style.left = Math.random() * 100 + 'vw';
      confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
      confetti.style.opacity = Math.random();
      confetti.style.width = (Math.random() * 10 + 5) + 'px';
      confetti.style.height = (Math.random() * 10 + 5) + 'px';
      document.body.appendChild(confetti);
      
      // Remove confetti after animation
      setTimeout(() => {
        confetti.remove();
      }, 5000);
    }
  }
})
</script>

<style>
.confetti {
  position: fixed;
  top: -10px;
  z-index: 9999;
  animation: fall linear forwards;
  pointer-events: none;
}

@keyframes fall {
  to {
    transform: translateY(100vh) rotate(720deg);
  }
}

.alert-success {
  animation: highlight 1s ease-in-out;
}

@keyframes highlight {
  0% { transform: scale(1); }
  50% { transform: scale(1.03); }
  100% { transform: scale(1); }
}
</style>
@endsection

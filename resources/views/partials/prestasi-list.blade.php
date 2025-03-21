@if ($prestasis->isEmpty())
    <div class="row" style="margin-top: 150px; margin-bottom: 150px">
        <div class="col-12 text-center">
            <p class="text-muted">No Prestasi Mahasiswa found.</p>
        </div>
    </div>
@else
    @foreach($prestasis as $prestasi)
        <div class="candidate-list-box card mt-4">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="candidate-list-images">
                            <a href="javascript:void(0)"><img src="{{asset('jobcy\images\user.png')}}" alt="" class="avatar-md img-thumbnail rounded-circle"></a>
                        </div>
                    </div><!--end col-->
                    
                    <div class="col-lg-6">
                        <div class="candidate-list-content mt-3 mt-lg-0">
                            <h5 class="fs-19 mb-0"><a href="#" class="primary-link">{{ $prestasi->nama }}</a> <span class="badge bg-success ms-1"><i class="mdi mdi-star align-middle"></i> {{ App\Models\PrestasiMahasiswa::PEROLEHAN_JUARA_SELECT[$prestasi->prestasi_mahasiswa->perolehan_juara] ?? '' }} </span></h5>
                            <p class="text-muted mb-2"> (NIM : {{$prestasi->nim}})</p>
                            <ul class="list-inline mb-0 text-muted">
                                <li class="list-inline-item">
                                    <i class="mdi mdi-eye"></i> {{ $prestasi->prestasi_mahasiswa->nama_kegiatan }} 
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-domain"></i> {{ $prestasi->prestasi_mahasiswa->nama_penyelenggara}}
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-map-marker"></i> {{ $prestasi->prestasi_mahasiswa->tempat_penyelenggara }}
                                </li>
                            </ul>
                        </div>
                    </div><!--end col-->

                    <div class="col-lg-5">
                        <div class="mt-2 mt-lg-0">
                            <span class="badge bg-primary-subtle text-primary fs-14 mt-1">{{ App\Models\PrestasiMahasiswa::KEIKUTSERTAAN_RADIO[$prestasi->prestasi_mahasiswa->keikutsertaan] ?? '' }}</span>
                            <span class="badge bg-warning-subtle text-warning fs-14 mt-1">{{ App\Models\PrestasiMahasiswa::TINGKAT_RADIO[$prestasi->prestasi_mahasiswa->tingkat] ?? '' }}</span>
                            <span class="badge bg-success-subtle text-success fs-14 mt-1">{{ $prestasi->prestasi_mahasiswa->kategori->name }}</span> 
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div>
        </div> <!--end card-->
    @endforeach

    <!-- Pagination controls -->
    <div class="row">
        <div class="col-lg-12 mt-5">
            <nav aria-label="Page navigation example">
                @include('partials.custom-pagination', ['paginator' => $prestasis])
            </nav>
        </div><!--end col-->
    </div><!-- end row -->
@endif

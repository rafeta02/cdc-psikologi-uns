@extends('layouts.frontend')

@section('title', 'Dashboard - CDC Fakultas Psikologi UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Dashboard </h1>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Prestasi Mahasiswa</span>
                                    <span class="info-box-number">{{ $prestasi ?? 0 }} Prestasi</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="far fa-bell"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Kompetensi Mahasiswa</span>
                                    <span class="info-box-number">{{ $competency ?? 0 }} Checklist</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="far fa-flag"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Assessment Taken</span>
                                    <span class="info-box-number">{{ $assessment ?? 0 }} Times</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Alumni Caring</div>

                <div class="card-body">
                    <div class="row">
                        @forelse ($posts as $item)
                            <div class="col-md-6">
                                <a href="#">
                                    <div class="card card-widget">
                                        <div class="card-header">
                                            <div class="user-block">
                                                <img class="img-circle"
                                                    src="{{ asset('jobcy/images/blog/user.png') }}"
                                                    alt="User Image">
                                                <span class="username">{{ $item->title }}</span>
                                                <span class="description">Alumni Sharing - {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}y</span>
                                            </div>
                                            <!-- /.user-block -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <img class="img-fluid pad mb-3"
                                                src="{{ $item->image ? $item->image->getUrl() : asset('jobcy/images/blog/img-' . str_pad(rand(1, 10), 2, '0', STR_PAD_LEFT) . '.jpg') }}""
                                                alt="Photo">
                                                <p class="text-muted">
                                                    {!! $item->excerpt !!}
                                                </p>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                        </div>
                                        <!-- /.card-footer -->
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-6">
                                <a href="#">
                                    <div class="card card-widget">
                                        <div class="card-header">
                                            <div class="user-block">
                                                <img class="img-circle"
                                                    src="{{ asset('jobcy/images/blog/img-' . str_pad(rand(1, 10), 2, '0', STR_PAD_LEFT) . '.jpg') }}"
                                                    alt="User Image">
                                                <span class="username">Jonathan Burke Jr.</span>
                                                <span class="description">Shared publicly - 7:30 PM Today</span>
                                            </div>
                                            <!-- /.user-block -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <img class="img-fluid pad mb-3"
                                                src="{{ asset('jobcy/images/blog/img-' . str_pad(rand(1, 10), 2, '0', STR_PAD_LEFT) . '.jpg') }}"
                                                alt="Photo">
                                                <p class="text-muted">
                                                    {{-- {!! $item->excerpt !!} --}}
                                                </p>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                        </div>
                                        <!-- /.card-footer -->
                                    </div>
                                </a>
                            </div>
                        @empty
                            Alumni Caring is empty
                        @endforelse
                    </div>
                    @if ($posts->count() > 0)
                        <div class="row mt-3">
                            <div class="offset-md-5 col-md-2">
                                <button type="button" class="btn btn-block bg-gradient-success text-center">Show More</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

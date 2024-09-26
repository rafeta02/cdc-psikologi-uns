@extends('layouts.frontend')

@section('title', 'Kompetensi Mahasiswa - CDC Fakultas Psikologi UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Kompetensi Mahasiswa </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.competences.index') }}">Kompetensi Mahasiswa</a></li>
                <li class="breadcrumb-item active">List Kompetensi Mahasiswa</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    List Lesson For {{ $competence->name }} Competence
                </div>
                <div class="card-body">
                    @foreach ($competence_list as $item)
                        <div class="card card-primary card-outline mb-3">
                            <div class="card-header text-center">
                                <strong>{{ $item->name }}</strong>
                            </div>
                            <div class="card-body">
                                <img src="{{ $item->image ? $item->image->getUrl() : 'https://via.placeholder.com/900x450' }}" class="img-fluid mb-3" alt="Image" style="width: 100%; height: 450px; object-fit: cover;">
                                <p>{!! $item->description !!}</p>
                                <div class="embed-responsive embed-responsive-16by9 mt-3 mb-3">
                                    <!-- Replace with an image or video link -->
                                    <iframe class="embed-responsive-item" src="{{ $item->source }}" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

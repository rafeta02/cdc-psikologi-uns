@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.contest.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contests.update", [$contest->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="judul">{{ trans('cruds.contest.fields.judul') }}</label>
                <input class="form-control {{ $errors->has('judul') ? 'is-invalid' : '' }}" type="text" name="judul" id="judul" value="{{ old('judul', $contest->judul) }}">
                @if($errors->has('judul'))
                    <span class="text-danger">{{ $errors->first('judul') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contest.fields.judul_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="deskripsi">{{ trans('cruds.contest.fields.deskripsi') }}</label>
                <textarea class="form-control {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}" name="deskripsi" id="deskripsi">{{ old('deskripsi', $contest->deskripsi) }}</textarea>
                @if($errors->has('deskripsi'))
                    <span class="text-danger">{{ $errors->first('deskripsi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contest.fields.deskripsi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="penyelenggara">{{ trans('cruds.contest.fields.penyelenggara') }}</label>
                <input class="form-control {{ $errors->has('penyelenggara') ? 'is-invalid' : '' }}" type="text" name="penyelenggara" id="penyelenggara" value="{{ old('penyelenggara', $contest->penyelenggara) }}">
                @if($errors->has('penyelenggara'))
                    <span class="text-danger">{{ $errors->first('penyelenggara') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contest.fields.penyelenggara_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tanggal">{{ trans('cruds.contest.fields.tanggal') }}</label>
                <input class="form-control date {{ $errors->has('tanggal') ? 'is-invalid' : '' }}" type="text" name="tanggal" id="tanggal" value="{{ old('tanggal', $contest->tanggal) }}">
                @if($errors->has('tanggal'))
                    <span class="text-danger">{{ $errors->first('tanggal') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contest.fields.tanggal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="deadline">{{ trans('cruds.contest.fields.deadline') }}</label>
                <input class="form-control date {{ $errors->has('deadline') ? 'is-invalid' : '' }}" type="text" name="deadline" id="deadline" value="{{ old('deadline', $contest->deadline) }}">
                @if($errors->has('deadline'))
                    <span class="text-danger">{{ $errors->first('deadline') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contest.fields.deadline_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.contest.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', $contest->link) }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contest.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.contest.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Contest::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $contest->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contest.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
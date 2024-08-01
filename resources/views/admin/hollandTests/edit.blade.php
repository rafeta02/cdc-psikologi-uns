@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.hollandTest.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.holland-tests.update", [$hollandTest->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="result_id">{{ trans('cruds.hollandTest.fields.result') }}</label>
                <select class="form-control select2 {{ $errors->has('result') ? 'is-invalid' : '' }}" name="result_id" id="result_id">
                    @foreach($results as $id => $entry)
                        <option value="{{ $id }}" {{ (old('result_id') ? old('result_id') : $hollandTest->result->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('result'))
                    <span class="text-danger">{{ $errors->first('result') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.result_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="r_1">{{ trans('cruds.hollandTest.fields.r_1') }}</label>
                <input class="form-control {{ $errors->has('r_1') ? 'is-invalid' : '' }}" type="number" name="r_1" id="r_1" value="{{ old('r_1', $hollandTest->r_1) }}" step="1">
                @if($errors->has('r_1'))
                    <span class="text-danger">{{ $errors->first('r_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.r_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="r_2">{{ trans('cruds.hollandTest.fields.r_2') }}</label>
                <input class="form-control {{ $errors->has('r_2') ? 'is-invalid' : '' }}" type="number" name="r_2" id="r_2" value="{{ old('r_2', $hollandTest->r_2) }}" step="1">
                @if($errors->has('r_2'))
                    <span class="text-danger">{{ $errors->first('r_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.r_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="r_3">{{ trans('cruds.hollandTest.fields.r_3') }}</label>
                <input class="form-control {{ $errors->has('r_3') ? 'is-invalid' : '' }}" type="number" name="r_3" id="r_3" value="{{ old('r_3', $hollandTest->r_3) }}" step="1">
                @if($errors->has('r_3'))
                    <span class="text-danger">{{ $errors->first('r_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.r_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="r_4">{{ trans('cruds.hollandTest.fields.r_4') }}</label>
                <input class="form-control {{ $errors->has('r_4') ? 'is-invalid' : '' }}" type="number" name="r_4" id="r_4" value="{{ old('r_4', $hollandTest->r_4) }}" step="1">
                @if($errors->has('r_4'))
                    <span class="text-danger">{{ $errors->first('r_4') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.r_4_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="r_5">{{ trans('cruds.hollandTest.fields.r_5') }}</label>
                <input class="form-control {{ $errors->has('r_5') ? 'is-invalid' : '' }}" type="number" name="r_5" id="r_5" value="{{ old('r_5', $hollandTest->r_5) }}" step="1">
                @if($errors->has('r_5'))
                    <span class="text-danger">{{ $errors->first('r_5') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.r_5_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="r_6">{{ trans('cruds.hollandTest.fields.r_6') }}</label>
                <input class="form-control {{ $errors->has('r_6') ? 'is-invalid' : '' }}" type="number" name="r_6" id="r_6" value="{{ old('r_6', $hollandTest->r_6) }}" step="1">
                @if($errors->has('r_6'))
                    <span class="text-danger">{{ $errors->first('r_6') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.r_6_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="r_7">{{ trans('cruds.hollandTest.fields.r_7') }}</label>
                <input class="form-control {{ $errors->has('r_7') ? 'is-invalid' : '' }}" type="number" name="r_7" id="r_7" value="{{ old('r_7', $hollandTest->r_7) }}" step="1">
                @if($errors->has('r_7'))
                    <span class="text-danger">{{ $errors->first('r_7') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.r_7_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="r_8">{{ trans('cruds.hollandTest.fields.r_8') }}</label>
                <input class="form-control {{ $errors->has('r_8') ? 'is-invalid' : '' }}" type="number" name="r_8" id="r_8" value="{{ old('r_8', $hollandTest->r_8) }}" step="1">
                @if($errors->has('r_8'))
                    <span class="text-danger">{{ $errors->first('r_8') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.r_8_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="i_1">{{ trans('cruds.hollandTest.fields.i_1') }}</label>
                <input class="form-control {{ $errors->has('i_1') ? 'is-invalid' : '' }}" type="number" name="i_1" id="i_1" value="{{ old('i_1', $hollandTest->i_1) }}" step="1">
                @if($errors->has('i_1'))
                    <span class="text-danger">{{ $errors->first('i_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.i_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="i_2">{{ trans('cruds.hollandTest.fields.i_2') }}</label>
                <input class="form-control {{ $errors->has('i_2') ? 'is-invalid' : '' }}" type="number" name="i_2" id="i_2" value="{{ old('i_2', $hollandTest->i_2) }}" step="1">
                @if($errors->has('i_2'))
                    <span class="text-danger">{{ $errors->first('i_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.i_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="i_3">{{ trans('cruds.hollandTest.fields.i_3') }}</label>
                <input class="form-control {{ $errors->has('i_3') ? 'is-invalid' : '' }}" type="number" name="i_3" id="i_3" value="{{ old('i_3', $hollandTest->i_3) }}" step="1">
                @if($errors->has('i_3'))
                    <span class="text-danger">{{ $errors->first('i_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.i_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="i_4">{{ trans('cruds.hollandTest.fields.i_4') }}</label>
                <input class="form-control {{ $errors->has('i_4') ? 'is-invalid' : '' }}" type="number" name="i_4" id="i_4" value="{{ old('i_4', $hollandTest->i_4) }}" step="1">
                @if($errors->has('i_4'))
                    <span class="text-danger">{{ $errors->first('i_4') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.i_4_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="i_5">{{ trans('cruds.hollandTest.fields.i_5') }}</label>
                <input class="form-control {{ $errors->has('i_5') ? 'is-invalid' : '' }}" type="number" name="i_5" id="i_5" value="{{ old('i_5', $hollandTest->i_5) }}" step="1">
                @if($errors->has('i_5'))
                    <span class="text-danger">{{ $errors->first('i_5') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.i_5_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="i_6">{{ trans('cruds.hollandTest.fields.i_6') }}</label>
                <input class="form-control {{ $errors->has('i_6') ? 'is-invalid' : '' }}" type="number" name="i_6" id="i_6" value="{{ old('i_6', $hollandTest->i_6) }}" step="1">
                @if($errors->has('i_6'))
                    <span class="text-danger">{{ $errors->first('i_6') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.i_6_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="i_7">{{ trans('cruds.hollandTest.fields.i_7') }}</label>
                <input class="form-control {{ $errors->has('i_7') ? 'is-invalid' : '' }}" type="number" name="i_7" id="i_7" value="{{ old('i_7', $hollandTest->i_7) }}" step="1">
                @if($errors->has('i_7'))
                    <span class="text-danger">{{ $errors->first('i_7') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.i_7_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="i_8">{{ trans('cruds.hollandTest.fields.i_8') }}</label>
                <input class="form-control {{ $errors->has('i_8') ? 'is-invalid' : '' }}" type="number" name="i_8" id="i_8" value="{{ old('i_8', $hollandTest->i_8) }}" step="1">
                @if($errors->has('i_8'))
                    <span class="text-danger">{{ $errors->first('i_8') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.i_8_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="a_1">{{ trans('cruds.hollandTest.fields.a_1') }}</label>
                <input class="form-control {{ $errors->has('a_1') ? 'is-invalid' : '' }}" type="number" name="a_1" id="a_1" value="{{ old('a_1', $hollandTest->a_1) }}" step="1">
                @if($errors->has('a_1'))
                    <span class="text-danger">{{ $errors->first('a_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.a_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="a_2">{{ trans('cruds.hollandTest.fields.a_2') }}</label>
                <input class="form-control {{ $errors->has('a_2') ? 'is-invalid' : '' }}" type="number" name="a_2" id="a_2" value="{{ old('a_2', $hollandTest->a_2) }}" step="1">
                @if($errors->has('a_2'))
                    <span class="text-danger">{{ $errors->first('a_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.a_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="a_3">{{ trans('cruds.hollandTest.fields.a_3') }}</label>
                <input class="form-control {{ $errors->has('a_3') ? 'is-invalid' : '' }}" type="number" name="a_3" id="a_3" value="{{ old('a_3', $hollandTest->a_3) }}" step="1">
                @if($errors->has('a_3'))
                    <span class="text-danger">{{ $errors->first('a_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.a_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="a_4">{{ trans('cruds.hollandTest.fields.a_4') }}</label>
                <input class="form-control {{ $errors->has('a_4') ? 'is-invalid' : '' }}" type="number" name="a_4" id="a_4" value="{{ old('a_4', $hollandTest->a_4) }}" step="1">
                @if($errors->has('a_4'))
                    <span class="text-danger">{{ $errors->first('a_4') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.a_4_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="a_5">{{ trans('cruds.hollandTest.fields.a_5') }}</label>
                <input class="form-control {{ $errors->has('a_5') ? 'is-invalid' : '' }}" type="number" name="a_5" id="a_5" value="{{ old('a_5', $hollandTest->a_5) }}" step="1">
                @if($errors->has('a_5'))
                    <span class="text-danger">{{ $errors->first('a_5') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.a_5_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="a_6">{{ trans('cruds.hollandTest.fields.a_6') }}</label>
                <input class="form-control {{ $errors->has('a_6') ? 'is-invalid' : '' }}" type="number" name="a_6" id="a_6" value="{{ old('a_6', $hollandTest->a_6) }}" step="1">
                @if($errors->has('a_6'))
                    <span class="text-danger">{{ $errors->first('a_6') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.a_6_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="a_7">{{ trans('cruds.hollandTest.fields.a_7') }}</label>
                <input class="form-control {{ $errors->has('a_7') ? 'is-invalid' : '' }}" type="number" name="a_7" id="a_7" value="{{ old('a_7', $hollandTest->a_7) }}" step="1">
                @if($errors->has('a_7'))
                    <span class="text-danger">{{ $errors->first('a_7') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.a_7_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="a_8">{{ trans('cruds.hollandTest.fields.a_8') }}</label>
                <input class="form-control {{ $errors->has('a_8') ? 'is-invalid' : '' }}" type="number" name="a_8" id="a_8" value="{{ old('a_8', $hollandTest->a_8) }}" step="1">
                @if($errors->has('a_8'))
                    <span class="text-danger">{{ $errors->first('a_8') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.a_8_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="s_1">{{ trans('cruds.hollandTest.fields.s_1') }}</label>
                <input class="form-control {{ $errors->has('s_1') ? 'is-invalid' : '' }}" type="number" name="s_1" id="s_1" value="{{ old('s_1', $hollandTest->s_1) }}" step="1">
                @if($errors->has('s_1'))
                    <span class="text-danger">{{ $errors->first('s_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.s_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="s_2">{{ trans('cruds.hollandTest.fields.s_2') }}</label>
                <input class="form-control {{ $errors->has('s_2') ? 'is-invalid' : '' }}" type="number" name="s_2" id="s_2" value="{{ old('s_2', $hollandTest->s_2) }}" step="1">
                @if($errors->has('s_2'))
                    <span class="text-danger">{{ $errors->first('s_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.s_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="s_3">{{ trans('cruds.hollandTest.fields.s_3') }}</label>
                <input class="form-control {{ $errors->has('s_3') ? 'is-invalid' : '' }}" type="number" name="s_3" id="s_3" value="{{ old('s_3', $hollandTest->s_3) }}" step="1">
                @if($errors->has('s_3'))
                    <span class="text-danger">{{ $errors->first('s_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.s_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="s_4">{{ trans('cruds.hollandTest.fields.s_4') }}</label>
                <input class="form-control {{ $errors->has('s_4') ? 'is-invalid' : '' }}" type="number" name="s_4" id="s_4" value="{{ old('s_4', $hollandTest->s_4) }}" step="1">
                @if($errors->has('s_4'))
                    <span class="text-danger">{{ $errors->first('s_4') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.s_4_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="s_5">{{ trans('cruds.hollandTest.fields.s_5') }}</label>
                <input class="form-control {{ $errors->has('s_5') ? 'is-invalid' : '' }}" type="number" name="s_5" id="s_5" value="{{ old('s_5', $hollandTest->s_5) }}" step="1">
                @if($errors->has('s_5'))
                    <span class="text-danger">{{ $errors->first('s_5') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.s_5_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="s_6">{{ trans('cruds.hollandTest.fields.s_6') }}</label>
                <input class="form-control {{ $errors->has('s_6') ? 'is-invalid' : '' }}" type="number" name="s_6" id="s_6" value="{{ old('s_6', $hollandTest->s_6) }}" step="1">
                @if($errors->has('s_6'))
                    <span class="text-danger">{{ $errors->first('s_6') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.s_6_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="s_7">{{ trans('cruds.hollandTest.fields.s_7') }}</label>
                <input class="form-control {{ $errors->has('s_7') ? 'is-invalid' : '' }}" type="number" name="s_7" id="s_7" value="{{ old('s_7', $hollandTest->s_7) }}" step="1">
                @if($errors->has('s_7'))
                    <span class="text-danger">{{ $errors->first('s_7') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.s_7_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="s_8">{{ trans('cruds.hollandTest.fields.s_8') }}</label>
                <input class="form-control {{ $errors->has('s_8') ? 'is-invalid' : '' }}" type="number" name="s_8" id="s_8" value="{{ old('s_8', $hollandTest->s_8) }}" step="1">
                @if($errors->has('s_8'))
                    <span class="text-danger">{{ $errors->first('s_8') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.s_8_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="e_1">{{ trans('cruds.hollandTest.fields.e_1') }}</label>
                <input class="form-control {{ $errors->has('e_1') ? 'is-invalid' : '' }}" type="number" name="e_1" id="e_1" value="{{ old('e_1', $hollandTest->e_1) }}" step="1">
                @if($errors->has('e_1'))
                    <span class="text-danger">{{ $errors->first('e_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.e_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="e_2">{{ trans('cruds.hollandTest.fields.e_2') }}</label>
                <input class="form-control {{ $errors->has('e_2') ? 'is-invalid' : '' }}" type="number" name="e_2" id="e_2" value="{{ old('e_2', $hollandTest->e_2) }}" step="1">
                @if($errors->has('e_2'))
                    <span class="text-danger">{{ $errors->first('e_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.e_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="e_3">{{ trans('cruds.hollandTest.fields.e_3') }}</label>
                <input class="form-control {{ $errors->has('e_3') ? 'is-invalid' : '' }}" type="number" name="e_3" id="e_3" value="{{ old('e_3', $hollandTest->e_3) }}" step="1">
                @if($errors->has('e_3'))
                    <span class="text-danger">{{ $errors->first('e_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.e_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="e_4">{{ trans('cruds.hollandTest.fields.e_4') }}</label>
                <input class="form-control {{ $errors->has('e_4') ? 'is-invalid' : '' }}" type="number" name="e_4" id="e_4" value="{{ old('e_4', $hollandTest->e_4) }}" step="1">
                @if($errors->has('e_4'))
                    <span class="text-danger">{{ $errors->first('e_4') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.e_4_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="e_5">{{ trans('cruds.hollandTest.fields.e_5') }}</label>
                <input class="form-control {{ $errors->has('e_5') ? 'is-invalid' : '' }}" type="number" name="e_5" id="e_5" value="{{ old('e_5', $hollandTest->e_5) }}" step="1">
                @if($errors->has('e_5'))
                    <span class="text-danger">{{ $errors->first('e_5') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.e_5_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="e_6">{{ trans('cruds.hollandTest.fields.e_6') }}</label>
                <input class="form-control {{ $errors->has('e_6') ? 'is-invalid' : '' }}" type="number" name="e_6" id="e_6" value="{{ old('e_6', $hollandTest->e_6) }}" step="1">
                @if($errors->has('e_6'))
                    <span class="text-danger">{{ $errors->first('e_6') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.e_6_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="e_7">{{ trans('cruds.hollandTest.fields.e_7') }}</label>
                <input class="form-control {{ $errors->has('e_7') ? 'is-invalid' : '' }}" type="number" name="e_7" id="e_7" value="{{ old('e_7', $hollandTest->e_7) }}" step="1">
                @if($errors->has('e_7'))
                    <span class="text-danger">{{ $errors->first('e_7') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.e_7_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="e_8">{{ trans('cruds.hollandTest.fields.e_8') }}</label>
                <input class="form-control {{ $errors->has('e_8') ? 'is-invalid' : '' }}" type="number" name="e_8" id="e_8" value="{{ old('e_8', $hollandTest->e_8) }}" step="1">
                @if($errors->has('e_8'))
                    <span class="text-danger">{{ $errors->first('e_8') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.e_8_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="c_1">{{ trans('cruds.hollandTest.fields.c_1') }}</label>
                <input class="form-control {{ $errors->has('c_1') ? 'is-invalid' : '' }}" type="number" name="c_1" id="c_1" value="{{ old('c_1', $hollandTest->c_1) }}" step="1">
                @if($errors->has('c_1'))
                    <span class="text-danger">{{ $errors->first('c_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.c_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="c_2">{{ trans('cruds.hollandTest.fields.c_2') }}</label>
                <input class="form-control {{ $errors->has('c_2') ? 'is-invalid' : '' }}" type="number" name="c_2" id="c_2" value="{{ old('c_2', $hollandTest->c_2) }}" step="1">
                @if($errors->has('c_2'))
                    <span class="text-danger">{{ $errors->first('c_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.c_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="c_3">{{ trans('cruds.hollandTest.fields.c_3') }}</label>
                <input class="form-control {{ $errors->has('c_3') ? 'is-invalid' : '' }}" type="number" name="c_3" id="c_3" value="{{ old('c_3', $hollandTest->c_3) }}" step="1">
                @if($errors->has('c_3'))
                    <span class="text-danger">{{ $errors->first('c_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.c_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="c_4">{{ trans('cruds.hollandTest.fields.c_4') }}</label>
                <input class="form-control {{ $errors->has('c_4') ? 'is-invalid' : '' }}" type="number" name="c_4" id="c_4" value="{{ old('c_4', $hollandTest->c_4) }}" step="1">
                @if($errors->has('c_4'))
                    <span class="text-danger">{{ $errors->first('c_4') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.c_4_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="c_5">{{ trans('cruds.hollandTest.fields.c_5') }}</label>
                <input class="form-control {{ $errors->has('c_5') ? 'is-invalid' : '' }}" type="number" name="c_5" id="c_5" value="{{ old('c_5', $hollandTest->c_5) }}" step="1">
                @if($errors->has('c_5'))
                    <span class="text-danger">{{ $errors->first('c_5') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.c_5_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="c_6">{{ trans('cruds.hollandTest.fields.c_6') }}</label>
                <input class="form-control {{ $errors->has('c_6') ? 'is-invalid' : '' }}" type="number" name="c_6" id="c_6" value="{{ old('c_6', $hollandTest->c_6) }}" step="1">
                @if($errors->has('c_6'))
                    <span class="text-danger">{{ $errors->first('c_6') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.c_6_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="c_7">{{ trans('cruds.hollandTest.fields.c_7') }}</label>
                <input class="form-control {{ $errors->has('c_7') ? 'is-invalid' : '' }}" type="number" name="c_7" id="c_7" value="{{ old('c_7', $hollandTest->c_7) }}" step="1">
                @if($errors->has('c_7'))
                    <span class="text-danger">{{ $errors->first('c_7') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.c_7_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="c_8">{{ trans('cruds.hollandTest.fields.c_8') }}</label>
                <input class="form-control {{ $errors->has('c_8') ? 'is-invalid' : '' }}" type="number" name="c_8" id="c_8" value="{{ old('c_8', $hollandTest->c_8) }}" step="1">
                @if($errors->has('c_8'))
                    <span class="text-danger">{{ $errors->first('c_8') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hollandTest.fields.c_8_helper') }}</span>
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
@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.hollandTest.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.holland-tests.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.hollandTest.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="result_id">{{ trans('cruds.hollandTest.fields.result') }}</label>
                            <select class="form-control select2" name="result_id" id="result_id">
                                @foreach($results as $id => $entry)
                                    <option value="{{ $id }}" {{ old('result_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('result'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('result') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.result_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="r_1">{{ trans('cruds.hollandTest.fields.r_1') }}</label>
                            <input class="form-control" type="number" name="r_1" id="r_1" value="{{ old('r_1', '0') }}" step="1">
                            @if($errors->has('r_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('r_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.r_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="r_2">{{ trans('cruds.hollandTest.fields.r_2') }}</label>
                            <input class="form-control" type="number" name="r_2" id="r_2" value="{{ old('r_2', '0') }}" step="1">
                            @if($errors->has('r_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('r_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.r_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="r_3">{{ trans('cruds.hollandTest.fields.r_3') }}</label>
                            <input class="form-control" type="number" name="r_3" id="r_3" value="{{ old('r_3', '0') }}" step="1">
                            @if($errors->has('r_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('r_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.r_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="r_4">{{ trans('cruds.hollandTest.fields.r_4') }}</label>
                            <input class="form-control" type="number" name="r_4" id="r_4" value="{{ old('r_4', '0') }}" step="1">
                            @if($errors->has('r_4'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('r_4') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.r_4_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="r_5">{{ trans('cruds.hollandTest.fields.r_5') }}</label>
                            <input class="form-control" type="number" name="r_5" id="r_5" value="{{ old('r_5', '0') }}" step="1">
                            @if($errors->has('r_5'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('r_5') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.r_5_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="r_6">{{ trans('cruds.hollandTest.fields.r_6') }}</label>
                            <input class="form-control" type="number" name="r_6" id="r_6" value="{{ old('r_6', '0') }}" step="1">
                            @if($errors->has('r_6'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('r_6') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.r_6_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="r_7">{{ trans('cruds.hollandTest.fields.r_7') }}</label>
                            <input class="form-control" type="number" name="r_7" id="r_7" value="{{ old('r_7', '0') }}" step="1">
                            @if($errors->has('r_7'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('r_7') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.r_7_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="r_8">{{ trans('cruds.hollandTest.fields.r_8') }}</label>
                            <input class="form-control" type="number" name="r_8" id="r_8" value="{{ old('r_8', '0') }}" step="1">
                            @if($errors->has('r_8'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('r_8') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.r_8_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="i_1">{{ trans('cruds.hollandTest.fields.i_1') }}</label>
                            <input class="form-control" type="number" name="i_1" id="i_1" value="{{ old('i_1', '0') }}" step="1">
                            @if($errors->has('i_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('i_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.i_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="i_2">{{ trans('cruds.hollandTest.fields.i_2') }}</label>
                            <input class="form-control" type="number" name="i_2" id="i_2" value="{{ old('i_2', '0') }}" step="1">
                            @if($errors->has('i_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('i_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.i_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="i_3">{{ trans('cruds.hollandTest.fields.i_3') }}</label>
                            <input class="form-control" type="number" name="i_3" id="i_3" value="{{ old('i_3', '0') }}" step="1">
                            @if($errors->has('i_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('i_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.i_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="i_4">{{ trans('cruds.hollandTest.fields.i_4') }}</label>
                            <input class="form-control" type="number" name="i_4" id="i_4" value="{{ old('i_4', '0') }}" step="1">
                            @if($errors->has('i_4'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('i_4') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.i_4_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="i_5">{{ trans('cruds.hollandTest.fields.i_5') }}</label>
                            <input class="form-control" type="number" name="i_5" id="i_5" value="{{ old('i_5', '0') }}" step="1">
                            @if($errors->has('i_5'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('i_5') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.i_5_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="i_6">{{ trans('cruds.hollandTest.fields.i_6') }}</label>
                            <input class="form-control" type="number" name="i_6" id="i_6" value="{{ old('i_6', '0') }}" step="1">
                            @if($errors->has('i_6'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('i_6') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.i_6_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="i_7">{{ trans('cruds.hollandTest.fields.i_7') }}</label>
                            <input class="form-control" type="number" name="i_7" id="i_7" value="{{ old('i_7', '0') }}" step="1">
                            @if($errors->has('i_7'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('i_7') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.i_7_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="i_8">{{ trans('cruds.hollandTest.fields.i_8') }}</label>
                            <input class="form-control" type="number" name="i_8" id="i_8" value="{{ old('i_8', '0') }}" step="1">
                            @if($errors->has('i_8'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('i_8') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.i_8_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="a_1">{{ trans('cruds.hollandTest.fields.a_1') }}</label>
                            <input class="form-control" type="number" name="a_1" id="a_1" value="{{ old('a_1', '0') }}" step="1">
                            @if($errors->has('a_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('a_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.a_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="a_2">{{ trans('cruds.hollandTest.fields.a_2') }}</label>
                            <input class="form-control" type="number" name="a_2" id="a_2" value="{{ old('a_2', '0') }}" step="1">
                            @if($errors->has('a_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('a_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.a_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="a_3">{{ trans('cruds.hollandTest.fields.a_3') }}</label>
                            <input class="form-control" type="number" name="a_3" id="a_3" value="{{ old('a_3', '0') }}" step="1">
                            @if($errors->has('a_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('a_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.a_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="a_4">{{ trans('cruds.hollandTest.fields.a_4') }}</label>
                            <input class="form-control" type="number" name="a_4" id="a_4" value="{{ old('a_4', '0') }}" step="1">
                            @if($errors->has('a_4'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('a_4') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.a_4_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="a_5">{{ trans('cruds.hollandTest.fields.a_5') }}</label>
                            <input class="form-control" type="number" name="a_5" id="a_5" value="{{ old('a_5', '0') }}" step="1">
                            @if($errors->has('a_5'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('a_5') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.a_5_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="a_6">{{ trans('cruds.hollandTest.fields.a_6') }}</label>
                            <input class="form-control" type="number" name="a_6" id="a_6" value="{{ old('a_6', '0') }}" step="1">
                            @if($errors->has('a_6'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('a_6') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.a_6_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="a_7">{{ trans('cruds.hollandTest.fields.a_7') }}</label>
                            <input class="form-control" type="number" name="a_7" id="a_7" value="{{ old('a_7', '0') }}" step="1">
                            @if($errors->has('a_7'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('a_7') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.a_7_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="a_8">{{ trans('cruds.hollandTest.fields.a_8') }}</label>
                            <input class="form-control" type="number" name="a_8" id="a_8" value="{{ old('a_8', '0') }}" step="1">
                            @if($errors->has('a_8'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('a_8') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.a_8_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="s_1">{{ trans('cruds.hollandTest.fields.s_1') }}</label>
                            <input class="form-control" type="number" name="s_1" id="s_1" value="{{ old('s_1', '0') }}" step="1">
                            @if($errors->has('s_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('s_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.s_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="s_2">{{ trans('cruds.hollandTest.fields.s_2') }}</label>
                            <input class="form-control" type="number" name="s_2" id="s_2" value="{{ old('s_2', '0') }}" step="1">
                            @if($errors->has('s_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('s_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.s_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="s_3">{{ trans('cruds.hollandTest.fields.s_3') }}</label>
                            <input class="form-control" type="number" name="s_3" id="s_3" value="{{ old('s_3', '0') }}" step="1">
                            @if($errors->has('s_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('s_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.s_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="s_4">{{ trans('cruds.hollandTest.fields.s_4') }}</label>
                            <input class="form-control" type="number" name="s_4" id="s_4" value="{{ old('s_4', '0') }}" step="1">
                            @if($errors->has('s_4'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('s_4') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.s_4_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="s_5">{{ trans('cruds.hollandTest.fields.s_5') }}</label>
                            <input class="form-control" type="number" name="s_5" id="s_5" value="{{ old('s_5', '0') }}" step="1">
                            @if($errors->has('s_5'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('s_5') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.s_5_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="s_6">{{ trans('cruds.hollandTest.fields.s_6') }}</label>
                            <input class="form-control" type="number" name="s_6" id="s_6" value="{{ old('s_6', '0') }}" step="1">
                            @if($errors->has('s_6'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('s_6') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.s_6_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="s_7">{{ trans('cruds.hollandTest.fields.s_7') }}</label>
                            <input class="form-control" type="number" name="s_7" id="s_7" value="{{ old('s_7', '0') }}" step="1">
                            @if($errors->has('s_7'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('s_7') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.s_7_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="s_8">{{ trans('cruds.hollandTest.fields.s_8') }}</label>
                            <input class="form-control" type="number" name="s_8" id="s_8" value="{{ old('s_8', '0') }}" step="1">
                            @if($errors->has('s_8'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('s_8') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.s_8_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="e_1">{{ trans('cruds.hollandTest.fields.e_1') }}</label>
                            <input class="form-control" type="number" name="e_1" id="e_1" value="{{ old('e_1', '0') }}" step="1">
                            @if($errors->has('e_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('e_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.e_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="e_2">{{ trans('cruds.hollandTest.fields.e_2') }}</label>
                            <input class="form-control" type="number" name="e_2" id="e_2" value="{{ old('e_2', '0') }}" step="1">
                            @if($errors->has('e_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('e_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.e_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="e_3">{{ trans('cruds.hollandTest.fields.e_3') }}</label>
                            <input class="form-control" type="number" name="e_3" id="e_3" value="{{ old('e_3', '0') }}" step="1">
                            @if($errors->has('e_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('e_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.e_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="e_4">{{ trans('cruds.hollandTest.fields.e_4') }}</label>
                            <input class="form-control" type="number" name="e_4" id="e_4" value="{{ old('e_4', '0') }}" step="1">
                            @if($errors->has('e_4'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('e_4') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.e_4_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="e_5">{{ trans('cruds.hollandTest.fields.e_5') }}</label>
                            <input class="form-control" type="number" name="e_5" id="e_5" value="{{ old('e_5', '0') }}" step="1">
                            @if($errors->has('e_5'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('e_5') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.e_5_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="e_6">{{ trans('cruds.hollandTest.fields.e_6') }}</label>
                            <input class="form-control" type="number" name="e_6" id="e_6" value="{{ old('e_6', '0') }}" step="1">
                            @if($errors->has('e_6'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('e_6') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.e_6_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="e_7">{{ trans('cruds.hollandTest.fields.e_7') }}</label>
                            <input class="form-control" type="number" name="e_7" id="e_7" value="{{ old('e_7', '0') }}" step="1">
                            @if($errors->has('e_7'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('e_7') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.e_7_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="e_8">{{ trans('cruds.hollandTest.fields.e_8') }}</label>
                            <input class="form-control" type="number" name="e_8" id="e_8" value="{{ old('e_8', '0') }}" step="1">
                            @if($errors->has('e_8'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('e_8') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.e_8_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="c_1">{{ trans('cruds.hollandTest.fields.c_1') }}</label>
                            <input class="form-control" type="number" name="c_1" id="c_1" value="{{ old('c_1', '0') }}" step="1">
                            @if($errors->has('c_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('c_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.c_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="c_2">{{ trans('cruds.hollandTest.fields.c_2') }}</label>
                            <input class="form-control" type="number" name="c_2" id="c_2" value="{{ old('c_2', '0') }}" step="1">
                            @if($errors->has('c_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('c_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.c_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="c_3">{{ trans('cruds.hollandTest.fields.c_3') }}</label>
                            <input class="form-control" type="number" name="c_3" id="c_3" value="{{ old('c_3', '0') }}" step="1">
                            @if($errors->has('c_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('c_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.c_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="c_4">{{ trans('cruds.hollandTest.fields.c_4') }}</label>
                            <input class="form-control" type="number" name="c_4" id="c_4" value="{{ old('c_4', '0') }}" step="1">
                            @if($errors->has('c_4'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('c_4') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.c_4_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="c_5">{{ trans('cruds.hollandTest.fields.c_5') }}</label>
                            <input class="form-control" type="number" name="c_5" id="c_5" value="{{ old('c_5', '0') }}" step="1">
                            @if($errors->has('c_5'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('c_5') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.c_5_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="c_6">{{ trans('cruds.hollandTest.fields.c_6') }}</label>
                            <input class="form-control" type="number" name="c_6" id="c_6" value="{{ old('c_6', '0') }}" step="1">
                            @if($errors->has('c_6'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('c_6') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.c_6_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="c_7">{{ trans('cruds.hollandTest.fields.c_7') }}</label>
                            <input class="form-control" type="number" name="c_7" id="c_7" value="{{ old('c_7', '0') }}" step="1">
                            @if($errors->has('c_7'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('c_7') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hollandTest.fields.c_7_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="c_8">{{ trans('cruds.hollandTest.fields.c_8') }}</label>
                            <input class="form-control" type="number" name="c_8" id="c_8" value="{{ old('c_8', '0') }}" step="1">
                            @if($errors->has('c_8'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('c_8') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection
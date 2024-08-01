@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.workReadinessTest.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.work-readiness-tests.update", [$workReadinessTest->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.workReadinessTest.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $workReadinessTest->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="result_id">{{ trans('cruds.workReadinessTest.fields.result') }}</label>
                            <select class="form-control select2" name="result_id" id="result_id">
                                @foreach($results as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('result_id') ? old('result_id') : $workReadinessTest->result->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('result'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('result') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.result_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cbs_1">{{ trans('cruds.workReadinessTest.fields.cbs_1') }}</label>
                            <input class="form-control" type="number" name="cbs_1" id="cbs_1" value="{{ old('cbs_1', $workReadinessTest->cbs_1) }}" step="1">
                            @if($errors->has('cbs_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cbs_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cbs_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cbs_2">{{ trans('cruds.workReadinessTest.fields.cbs_2') }}</label>
                            <input class="form-control" type="number" name="cbs_2" id="cbs_2" value="{{ old('cbs_2', $workReadinessTest->cbs_2) }}" step="1">
                            @if($errors->has('cbs_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cbs_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cbs_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cbs_3">{{ trans('cruds.workReadinessTest.fields.cbs_3') }}</label>
                            <input class="form-control" type="number" name="cbs_3" id="cbs_3" value="{{ old('cbs_3', $workReadinessTest->cbs_3) }}" step="1">
                            @if($errors->has('cbs_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cbs_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cbs_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cbs_4">{{ trans('cruds.workReadinessTest.fields.cbs_4') }}</label>
                            <input class="form-control" type="number" name="cbs_4" id="cbs_4" value="{{ old('cbs_4', $workReadinessTest->cbs_4) }}" step="1">
                            @if($errors->has('cbs_4'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cbs_4') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cbs_4_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cbs_5">{{ trans('cruds.workReadinessTest.fields.cbs_5') }}</label>
                            <input class="form-control" type="number" name="cbs_5" id="cbs_5" value="{{ old('cbs_5', $workReadinessTest->cbs_5) }}" step="1">
                            @if($errors->has('cbs_5'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cbs_5') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cbs_5_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cbs_6">{{ trans('cruds.workReadinessTest.fields.cbs_6') }}</label>
                            <input class="form-control" type="number" name="cbs_6" id="cbs_6" value="{{ old('cbs_6', $workReadinessTest->cbs_6) }}" step="1">
                            @if($errors->has('cbs_6'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cbs_6') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cbs_6_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cbs_7">{{ trans('cruds.workReadinessTest.fields.cbs_7') }}</label>
                            <input class="form-control" type="number" name="cbs_7" id="cbs_7" value="{{ old('cbs_7', $workReadinessTest->cbs_7) }}" step="1">
                            @if($errors->has('cbs_7'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cbs_7') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cbs_7_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cbs_8">{{ trans('cruds.workReadinessTest.fields.cbs_8') }}</label>
                            <input class="form-control" type="number" name="cbs_8" id="cbs_8" value="{{ old('cbs_8', $workReadinessTest->cbs_8) }}" step="1">
                            @if($errors->has('cbs_8'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cbs_8') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cbs_8_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cbs_9">{{ trans('cruds.workReadinessTest.fields.cbs_9') }}</label>
                            <input class="form-control" type="number" name="cbs_9" id="cbs_9" value="{{ old('cbs_9', $workReadinessTest->cbs_9) }}" step="1">
                            @if($errors->has('cbs_9'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cbs_9') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cbs_9_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cbs_10">{{ trans('cruds.workReadinessTest.fields.cbs_10') }}</label>
                            <input class="form-control" type="number" name="cbs_10" id="cbs_10" value="{{ old('cbs_10', $workReadinessTest->cbs_10) }}" step="1">
                            @if($errors->has('cbs_10'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cbs_10') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cbs_10_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cms_1">{{ trans('cruds.workReadinessTest.fields.cms_1') }}</label>
                            <input class="form-control" type="number" name="cms_1" id="cms_1" value="{{ old('cms_1', $workReadinessTest->cms_1) }}" step="1">
                            @if($errors->has('cms_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cms_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cms_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cms_2">{{ trans('cruds.workReadinessTest.fields.cms_2') }}</label>
                            <input class="form-control" type="number" name="cms_2" id="cms_2" value="{{ old('cms_2', $workReadinessTest->cms_2) }}" step="1">
                            @if($errors->has('cms_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cms_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cms_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cms_3">{{ trans('cruds.workReadinessTest.fields.cms_3') }}</label>
                            <input class="form-control" type="number" name="cms_3" id="cms_3" value="{{ old('cms_3', $workReadinessTest->cms_3) }}" step="1">
                            @if($errors->has('cms_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cms_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cms_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cms_4">{{ trans('cruds.workReadinessTest.fields.cms_4') }}</label>
                            <input class="form-control" type="number" name="cms_4" id="cms_4" value="{{ old('cms_4', $workReadinessTest->cms_4) }}" step="1">
                            @if($errors->has('cms_4'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cms_4') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cms_4_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cs_1">{{ trans('cruds.workReadinessTest.fields.cs_1') }}</label>
                            <input class="form-control" type="number" name="cs_1" id="cs_1" value="{{ old('cs_1', $workReadinessTest->cs_1) }}" step="1">
                            @if($errors->has('cs_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cs_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cs_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cs_2">{{ trans('cruds.workReadinessTest.fields.cs_2') }}</label>
                            <input class="form-control" type="number" name="cs_2" id="cs_2" value="{{ old('cs_2', $workReadinessTest->cs_2) }}" step="1">
                            @if($errors->has('cs_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cs_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cs_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cs_3">{{ trans('cruds.workReadinessTest.fields.cs_3') }}</label>
                            <input class="form-control" type="number" name="cs_3" id="cs_3" value="{{ old('cs_3', $workReadinessTest->cs_3) }}" step="1">
                            @if($errors->has('cs_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cs_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cs_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cs_4">{{ trans('cruds.workReadinessTest.fields.cs_4') }}</label>
                            <input class="form-control" type="number" name="cs_4" id="cs_4" value="{{ old('cs_4', $workReadinessTest->cs_4) }}" step="1">
                            @if($errors->has('cs_4'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cs_4') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cs_4_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cs_5">{{ trans('cruds.workReadinessTest.fields.cs_5') }}</label>
                            <input class="form-control" type="number" name="cs_5" id="cs_5" value="{{ old('cs_5', $workReadinessTest->cs_5) }}" step="1">
                            @if($errors->has('cs_5'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cs_5') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cs_5_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cs_6">{{ trans('cruds.workReadinessTest.fields.cs_6') }}</label>
                            <input class="form-control" type="number" name="cs_6" id="cs_6" value="{{ old('cs_6', $workReadinessTest->cs_6) }}" step="1">
                            @if($errors->has('cs_6'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cs_6') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cs_6_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cs_7">{{ trans('cruds.workReadinessTest.fields.cs_7') }}</label>
                            <input class="form-control" type="number" name="cs_7" id="cs_7" value="{{ old('cs_7', $workReadinessTest->cs_7) }}" step="1">
                            @if($errors->has('cs_7'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cs_7') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cs_7_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cs_8">{{ trans('cruds.workReadinessTest.fields.cs_8') }}</label>
                            <input class="form-control" type="number" name="cs_8" id="cs_8" value="{{ old('cs_8', $workReadinessTest->cs_8) }}" step="1">
                            @if($errors->has('cs_8'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cs_8') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cs_8_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cs_9">{{ trans('cruds.workReadinessTest.fields.cs_9') }}</label>
                            <input class="form-control" type="number" name="cs_9" id="cs_9" value="{{ old('cs_9', $workReadinessTest->cs_9) }}" step="1">
                            @if($errors->has('cs_9'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cs_9') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.cs_9_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fs_1">{{ trans('cruds.workReadinessTest.fields.fs_1') }}</label>
                            <input class="form-control" type="number" name="fs_1" id="fs_1" value="{{ old('fs_1', $workReadinessTest->fs_1) }}" step="1">
                            @if($errors->has('fs_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fs_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.fs_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fs_2">{{ trans('cruds.workReadinessTest.fields.fs_2') }}</label>
                            <input class="form-control" type="number" name="fs_2" id="fs_2" value="{{ old('fs_2', $workReadinessTest->fs_2) }}" step="1">
                            @if($errors->has('fs_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fs_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.fs_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fs_3">{{ trans('cruds.workReadinessTest.fields.fs_3') }}</label>
                            <input class="form-control" type="number" name="fs_3" id="fs_3" value="{{ old('fs_3', $workReadinessTest->fs_3) }}" step="1">
                            @if($errors->has('fs_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fs_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.fs_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="ics_1">{{ trans('cruds.workReadinessTest.fields.ics_1') }}</label>
                            <input class="form-control" type="number" name="ics_1" id="ics_1" value="{{ old('ics_1', $workReadinessTest->ics_1) }}" step="1">
                            @if($errors->has('ics_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ics_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.ics_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="ics_2">{{ trans('cruds.workReadinessTest.fields.ics_2') }}</label>
                            <input class="form-control" type="number" name="ics_2" id="ics_2" value="{{ old('ics_2', $workReadinessTest->ics_2) }}" step="1">
                            @if($errors->has('ics_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ics_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.ics_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="ics_3">{{ trans('cruds.workReadinessTest.fields.ics_3') }}</label>
                            <input class="form-control" type="number" name="ics_3" id="ics_3" value="{{ old('ics_3', $workReadinessTest->ics_3) }}" step="1">
                            @if($errors->has('ics_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ics_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.ics_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="ics_4">{{ trans('cruds.workReadinessTest.fields.ics_4') }}</label>
                            <input class="form-control" type="number" name="ics_4" id="ics_4" value="{{ old('ics_4', $workReadinessTest->ics_4) }}" step="1">
                            @if($errors->has('ics_4'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ics_4') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.ics_4_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="ics_5">{{ trans('cruds.workReadinessTest.fields.ics_5') }}</label>
                            <input class="form-control" type="number" name="ics_5" id="ics_5" value="{{ old('ics_5', $workReadinessTest->ics_5) }}" step="1">
                            @if($errors->has('ics_5'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ics_5') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.ics_5_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="its_1">{{ trans('cruds.workReadinessTest.fields.its_1') }}</label>
                            <input class="form-control" type="number" name="its_1" id="its_1" value="{{ old('its_1', $workReadinessTest->its_1) }}" step="1">
                            @if($errors->has('its_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('its_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.its_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="its_2">{{ trans('cruds.workReadinessTest.fields.its_2') }}</label>
                            <input class="form-control" type="number" name="its_2" id="its_2" value="{{ old('its_2', $workReadinessTest->its_2) }}" step="1">
                            @if($errors->has('its_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('its_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.its_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="its_3">{{ trans('cruds.workReadinessTest.fields.its_3') }}</label>
                            <input class="form-control" type="number" name="its_3" id="its_3" value="{{ old('its_3', $workReadinessTest->its_3) }}" step="1">
                            @if($errors->has('its_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('its_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.its_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="ls_1">{{ trans('cruds.workReadinessTest.fields.ls_1') }}</label>
                            <input class="form-control" type="number" name="ls_1" id="ls_1" value="{{ old('ls_1', $workReadinessTest->ls_1) }}" step="1">
                            @if($errors->has('ls_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ls_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.ls_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="ls_2">{{ trans('cruds.workReadinessTest.fields.ls_2') }}</label>
                            <input class="form-control" type="number" name="ls_2" id="ls_2" value="{{ old('ls_2', $workReadinessTest->ls_2) }}" step="1">
                            @if($errors->has('ls_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ls_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.ls_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="ls_3">{{ trans('cruds.workReadinessTest.fields.ls_3') }}</label>
                            <input class="form-control" type="number" name="ls_3" id="ls_3" value="{{ old('ls_3', $workReadinessTest->ls_3) }}" step="1">
                            @if($errors->has('ls_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ls_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.ls_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="ls_4">{{ trans('cruds.workReadinessTest.fields.ls_4') }}</label>
                            <input class="form-control" type="number" name="ls_4" id="ls_4" value="{{ old('ls_4', $workReadinessTest->ls_4) }}" step="1">
                            @if($errors->has('ls_4'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ls_4') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.ls_4_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="ls_5">{{ trans('cruds.workReadinessTest.fields.ls_5') }}</label>
                            <input class="form-control" type="number" name="ls_5" id="ls_5" value="{{ old('ls_5', $workReadinessTest->ls_5) }}" step="1">
                            @if($errors->has('ls_5'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ls_5') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.ls_5_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sms_1">{{ trans('cruds.workReadinessTest.fields.sms_1') }}</label>
                            <input class="form-control" type="number" name="sms_1" id="sms_1" value="{{ old('sms_1', $workReadinessTest->sms_1) }}" step="1">
                            @if($errors->has('sms_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sms_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.sms_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sms_3">{{ trans('cruds.workReadinessTest.fields.sms_3') }}</label>
                            <input class="form-control" type="number" name="sms_3" id="sms_3" value="{{ old('sms_3', $workReadinessTest->sms_3) }}" step="1">
                            @if($errors->has('sms_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sms_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.sms_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sms_4">{{ trans('cruds.workReadinessTest.fields.sms_4') }}</label>
                            <input class="form-control" type="number" name="sms_4" id="sms_4" value="{{ old('sms_4', $workReadinessTest->sms_4) }}" step="1">
                            @if($errors->has('sms_4'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sms_4') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.sms_4_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sms_5">{{ trans('cruds.workReadinessTest.fields.sms_5') }}</label>
                            <input class="form-control" type="number" name="sms_5" id="sms_5" value="{{ old('sms_5', $workReadinessTest->sms_5) }}" step="1">
                            @if($errors->has('sms_5'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sms_5') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.sms_5_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sms_7">{{ trans('cruds.workReadinessTest.fields.sms_7') }}</label>
                            <input class="form-control" type="number" name="sms_7" id="sms_7" value="{{ old('sms_7', $workReadinessTest->sms_7) }}" step="1">
                            @if($errors->has('sms_7'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sms_7') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.sms_7_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sms_9">{{ trans('cruds.workReadinessTest.fields.sms_9') }}</label>
                            <input class="form-control" type="number" name="sms_9" id="sms_9" value="{{ old('sms_9', $workReadinessTest->sms_9) }}" step="1">
                            @if($errors->has('sms_9'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sms_9') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.sms_9_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sts_1">{{ trans('cruds.workReadinessTest.fields.sts_1') }}</label>
                            <input class="form-control" type="number" name="sts_1" id="sts_1" value="{{ old('sts_1', $workReadinessTest->sts_1) }}" step="1">
                            @if($errors->has('sts_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sts_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.sts_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sts_2">{{ trans('cruds.workReadinessTest.fields.sts_2') }}</label>
                            <input class="form-control" type="number" name="sts_2" id="sts_2" value="{{ old('sts_2', $workReadinessTest->sts_2) }}" step="1">
                            @if($errors->has('sts_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sts_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.sts_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sts_3">{{ trans('cruds.workReadinessTest.fields.sts_3') }}</label>
                            <input class="form-control" type="number" name="sts_3" id="sts_3" value="{{ old('sts_3', $workReadinessTest->sts_3) }}" step="1">
                            @if($errors->has('sts_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sts_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.sts_3_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sts_4">{{ trans('cruds.workReadinessTest.fields.sts_4') }}</label>
                            <input class="form-control" type="number" name="sts_4" id="sts_4" value="{{ old('sts_4', $workReadinessTest->sts_4) }}" step="1">
                            @if($errors->has('sts_4'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sts_4') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.sts_4_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tps_2">{{ trans('cruds.workReadinessTest.fields.tps_2') }}</label>
                            <input class="form-control" type="number" name="tps_2" id="tps_2" value="{{ old('tps_2', $workReadinessTest->tps_2) }}" step="1">
                            @if($errors->has('tps_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tps_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.tps_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tps_4">{{ trans('cruds.workReadinessTest.fields.tps_4') }}</label>
                            <input class="form-control" type="number" name="tps_4" id="tps_4" value="{{ old('tps_4', $workReadinessTest->tps_4) }}" step="1">
                            @if($errors->has('tps_4'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tps_4') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.tps_4_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tps_5">{{ trans('cruds.workReadinessTest.fields.tps_5') }}</label>
                            <input class="form-control" type="number" name="tps_5" id="tps_5" value="{{ old('tps_5', $workReadinessTest->tps_5) }}" step="1">
                            @if($errors->has('tps_5'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tps_5') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.tps_5_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tps_6">{{ trans('cruds.workReadinessTest.fields.tps_6') }}</label>
                            <input class="form-control" type="number" name="tps_6" id="tps_6" value="{{ old('tps_6', $workReadinessTest->tps_6) }}" step="1">
                            @if($errors->has('tps_6'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tps_6') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.workReadinessTest.fields.tps_6_helper') }}</span>
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
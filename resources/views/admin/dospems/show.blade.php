@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dospem.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dospems.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dospem.fields.nip') }}
                        </th>
                        <td>
                            {{ $dospem->nip }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dospem.fields.nama') }}
                        </th>
                        <td>
                            {{ $dospem->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dospem.fields.whatshapp') }}
                        </th>
                        <td>
                            {{ $dospem->whatshapp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dospem.fields.photo') }}
                        </th>
                        <td>
                            @if($dospem->photo)
                                <a href="{{ $dospem->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $dospem->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dospems.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
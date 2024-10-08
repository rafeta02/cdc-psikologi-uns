@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.competenceItem.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.competence-items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.competenceItem.fields.name') }}
                        </th>
                        <td>
                            {{ $competenceItem->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competenceItem.fields.description') }}
                        </th>
                        <td>
                            {!! $competenceItem->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competenceItem.fields.image') }}
                        </th>
                        <td>
                            @if($competenceItem->image)
                                <a href="{{ $competenceItem->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $competenceItem->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competenceItem.fields.source') }}
                        </th>
                        <td>
                            {{ $competenceItem->source }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competenceItem.fields.competence') }}
                        </th>
                        <td>
                            {{ $competenceItem->competence->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.competence-items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
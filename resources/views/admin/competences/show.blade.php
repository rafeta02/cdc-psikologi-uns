@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.competence.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.competences.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.competence.fields.name') }}
                        </th>
                        <td>
                            {{ $competence->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competence.fields.slug') }}
                        </th>
                        <td>
                            {{ $competence->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competence.fields.description') }}
                        </th>
                        <td>
                            {!! $competence->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competence.fields.image') }}
                        </th>
                        <td>
                            @if($competence->image)
                                <a href="{{ $competence->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $competence->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.competences.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#competence_competence_items" role="tab" data-toggle="tab">
                {{ trans('cruds.competenceItem.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="competence_competence_items">
            @includeIf('admin.competences.relationships.competenceCompetenceItems', ['competenceItems' => $competence->competenceCompetenceItems])
        </div>
    </div>
</div>

@endsection
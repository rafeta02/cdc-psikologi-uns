@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.contest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.contest.fields.judul') }}
                        </th>
                        <td>
                            {{ $contest->judul }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contest.fields.deskripsi') }}
                        </th>
                        <td>
                            {{ $contest->deskripsi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contest.fields.penyelenggara') }}
                        </th>
                        <td>
                            {{ $contest->penyelenggara }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contest.fields.tanggal') }}
                        </th>
                        <td>
                            {{ $contest->tanggal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contest.fields.deadline') }}
                        </th>
                        <td>
                            {{ $contest->deadline }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contest.fields.link') }}
                        </th>
                        <td>
                            {{ $contest->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contest.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Contest::TYPE_SELECT[$contest->type] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
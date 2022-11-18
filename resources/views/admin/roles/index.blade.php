@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="box   box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">Role @lang('global.app_list')</h3>
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <p class="pull-right">
            <a href="{{ route('admin.roles.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> @lang('global.app_add_new') Role</a>
        </p>
        <table class="table table-bordered table-striped {{ count($roles) > 0 ? 'datatable' : '' }} dt-select">
            <thead>
                <tr>
                    <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                    <th>NO</th>
                    <th>@lang('global.roles.fields.name')</th>
                    <th>@lang('global.roles.fields.permission')</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @if (count($roles) > 0)
                @foreach ($roles as $key=>$role)
                <tr data-entry-id="{{ $role->id }}">
                    <td></td>
                    <td>{{$key+1}}</td>
                    <td style="text-align:left;">{{ $role->name }}</td>
                    <td style="width:40%;">
                        @foreach ($role->permissions()->pluck('name') as $permission)
                        <span class="label label-primary label-many">{{ $permission }}</span>
                        @endforeach
                    </td>
                    <td style="width:30%;">
                        <a href="{{ route('admin.roles.edit',[$role->id]) }}" class="btn btn-flat btn-xs btn-info"><i class="fa fa-edit"></i> @lang('global.app_edit')</a>
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                        'route' => ['admin.roles.destroy', $role->id])) !!}
                        {!! Form::button('<i class="fa fa-trash"></i> '.trans('global.app_delete'), array('type'=>'submit','class' => 'btn btn-xs btn-danger btn-flat')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="6">@lang('global.app_no_entries_in_table')</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>


@stop

@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('admin.roles.mass_destroy') }}';
    </script>
@endsection
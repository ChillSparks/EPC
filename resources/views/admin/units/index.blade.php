@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="box   box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">@lang('global.app_list')</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-flat btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <p style="text-align:right">
            <a href="{{ route('admin.unit.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> @lang('global.app_add_new') unit</a>
        </p>
        <table class="table table-bordered table-striped {{ count($units) > 0 ? 'datatable' : '' }} dt-select">
            <thead>
                <tr>
                    <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                    <th>@lang('global.unit.fields.name')</th>
                    <th>@lang('global.unit.fields.des')</th>
                    <th>@lang('global.unit.fields.created_by')</th>
                    <th>@lang('global.unit.fields.updated_by')</th>
                    <th>@lang('global.unit.fields.created_date')</th>
                    <th>@lang('global.unit.fields.updated_date')</th>
                    <th>&nbsp;</th>

                </tr>
            </thead>

            <tbody>
                @if (count($units) > 0)
                @foreach ($units as $unit)
                <tr data-entry-id="{{ $unit->id }}">
                    <td></td>
                    <td>{{ $unit->name }}</td>
                    <td>{{ $unit->des }}</td>
                    <td>{{ $unit->created_by }}</td>
                    <td>{{ $unit->updated_by }}</td>
                    <td>{{ $unit->created_at }}</td>
                    <td>{{ $unit->updated_at }}</td>
                    <td>
                        <a href="{{ route('admin.unit.edit',[$unit->id]) }}" class="btn btn-flat btn-xs btn-info"><i class="fa fa-edit"></i> @lang('global.app_edit')</a>
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                        'route' => ['admin.unit.destroy', $unit->id])) !!}
                        {!! Form::button('<i class="fa fa-trash"></i> '.trans('global.app_delete'), array('type'=>'submit','class' => 'btn btn-xs btn-danger btn-flat')) !!}
                        {!! Form::close() !!}
                    </td>

                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="3">@lang('global.app_no_entries_in_table')</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@stop

@section('javascript')
<script>
    window.route_mass_crud_entries_destroy = '{{ route("admin.unit.mass_destroy") }}';
</script>
@endsection
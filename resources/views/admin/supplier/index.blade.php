@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="box   box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">@lang('global.app_list')</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <p style="text-align:right">
            <a href="{{ route('admin.supplier.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> @lang('global.app_add_new') Supplier</a>
        </p>
        <table class="table table-bordered table-striped {{ count($suppliers) > 0 ? 'datatable' : '' }} dt-select">
            <thead>
                <tr>
                    <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                    <th>@lang('global.supplier.fields.name')</th>
                    <th>@lang('global.supplier.fields.des')</th>
                    <th>@lang('global.supplier.fields.created_by')</th>
                    <th>@lang('global.supplier.fields.updated_by')</th>
                    <th>@lang('global.supplier.fields.created_date')</th>
                    <th>@lang('global.supplier.fields.updated_date')</th>
                    <th>&nbsp;</th>

                </tr>
            </thead>

            <tbody>
                @if (count($suppliers) > 0)
                @foreach ($suppliers as $supplier)
                <tr data-entry-id="{{ $supplier->id }}">
                    <td></td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->des }}</td>
                    <td>{{ $supplier->created_by }}</td>
                    <td>{{ $supplier->updated_by }}</td>
                    <td>{{ $supplier->created_at }}</td>
                    <td>{{ $supplier->updated_at }}</td>
                    <td>
                        <a href="{{ route('admin.supplier.edit',[$supplier->id]) }}" class="btn btn-flat btn-xs btn-info">@lang('global.app_edit')</a>
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                        'route' => ['admin.supplier.destroy', $supplier->id])) !!}
                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger btn-flat')) !!}
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
    window.route_mass_crud_entries_destroy = '{{ route("supplier.mass_destroy") }}';
</script>
@endsection
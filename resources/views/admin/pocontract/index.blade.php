@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="box   box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">@lang('global.app_list') PO Contract</h3>
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <p class="pull-right">
            <a href="{{ route('admin.pocontract.create') }}" class="btn btn-flat btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> @lang('global.app_add_new') PO Contract</a>
        </p>
        <table class="table table-bordered table-striped {{ count($contracts) > 0 ? 'datatable' : '' }}">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>@lang('global.po_contract.fields.po_no')</th>
                    <th>@lang('global.po_contract.fields.po_date')</th>
                    <th>@lang('global.po_contract.fields.supplier')</th>
                    <th>@lang('global.po_contract.fields.do_no')</th>
                    <th>@lang('global.po_contract.fields.do_date')</th>
                    <th>@lang('global.po_contract.fields.remark')</th>
                    <th>&nbsp;</th>

                </tr>
            </thead>

            <tbody>
                @if (count($contracts) > 0)
                @foreach ($contracts as $key=>$contract)
                <tr data-entry-id="{{ $contract->id }}">
                    <td>{{$key+1}}</td>
                    <td>{{ $contract->po_no }}</td>
                    <td>{{ $contract->po_date }}</td>
                    <td>{{ $contract->supplier_name }}</td>
                    <td>
                        <a href="{{ route('admin.doitems.create',[$contract->id]) }}" class="btn btn-flat btn-xs btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> {{ $contract->do_no }}</a>
                    </td>
                    <td>{{ $contract->do_date }}</td>
                    <td>{{ $contract->remark }}</td>
                    <td>
                        <a href="{{ route('admin.pocontract.edit',[$contract->id]) }}" class="btn btn-flat btn-xs btn-info"><i class="fa fa-edit"></i> @lang('global.app_edit')</a>
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                        'route' => ['admin.pocontract.destroy', $contract->id])) !!}
                        {!! Form::button('<i class="fa fa-trash"></i> '.trans('global.app_delete'), array('type'=>'submit','class' => 'btn btn-xs btn-danger btn-flat')) !!}
                        {!! Form::close() !!}
                    </td>

                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@stop

@section('javascript')
<script>
    window.route_mass_crud_entries_destroy = '{{ route("admin.pocontract.mass_destroy") }}';
</script>
@endsection
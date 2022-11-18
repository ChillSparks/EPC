@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="box   box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">All Items in Warehouses</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-flat btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <table class="table table-bordered table-striped {{ count($store_items) > 0 ? 'datatable' : '' }}">
            <thead>
                <tr>
                    <th>@lang('global.do_item.fields.no')</th>
                    <th>Stock Code</th>
                    <th>WareHouse</th>
                    <th>@lang('global.do_item.fields.item_name')</th>
                    <th>@lang('global.do_item.fields.unit')</th>
                    <th>@lang('global.do_item.fields.price')</th>
                    <th>@lang('global.do_item.fields.qty')</th>
                    <th>@lang('global.do_item.fields.amt')</th>
                    <th>@lang('global.do_item.fields.brand')</th>
                    <th>@lang('global.do_item.fields.mfg_country')</th>
                    <th>@lang('global.do_item.fields.mfg_company')</th>
                    <th>@lang('global.do_item.fields.mfg_date')</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                </tr>
            </thead>

            <tbody>
                @if (count($store_items) > 0)
                @foreach ($store_items as $key=>$store_item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $store_item->item_name }}</td>
                    <td>{{ $store_item->store_code }}</td>
                    <td>{{ $store_item->warehouse }}</td>
                    <td>{{ $store_item->unit }}</td>
                    <td>{{ $store_item->qty }}</td>
                    <td>{{ $store_item->price }}</td>
                    <td>{{ $store_item->amt }}</td>
                    <td>{{ $store_item->brand }}</td>
                    <td>{{ $store_item->mfg_country }}</td>
                    <td>{{ $store_item->mfg_company }}</td>
                    <td>{{ $store_item->mfg_date }}</td>
                    <td>{{ $store_item->manual_filename }}</td>
                    <td>{{ $store_item->item_remark }}</td>
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
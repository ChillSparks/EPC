@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
{!! Form::open(['method' => 'POST', 'route' => ['admin.tocheck.store'], 'id'=>'checkingForm']) !!}
<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Checking Amount</a></li>
                <li><a href="#tab_2" data-toggle="tab">Checking Items</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="panel-body">
                        @if (count($order_received_infos) > 0)
                        @foreach ($order_received_infos as $order_received_info)
                        <div class="col-xs-3 form-group">
                            {!! Form::label('po_no', 'PO Contract NO *', ['class' => 'control-label']) !!}
                            {!! Form::text('po_no',$order_received_info->po_no, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                            {!! Form::hidden('rev_id',$order_received_info->id)!!}
                            {!! Form::hidden('po_id',$order_received_info->po_id)!!}
                        </div>
                        <div class="col-xs-3 form-group">
                            {!! Form::label('po_date', 'PO Contract Date *', ['class' => 'control-label']) !!}
                            {!! Form::text('po_date',$order_received_info->po_date, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                        </div>
                        <div class="col-xs-3 form-group">
                            {!! Form::label('s_name', 'Supplier Name *', ['class' => 'control-label']) !!}
                            {!! Form::text('s_name',$order_received_info->supplier, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                        </div>
                        <div class="col-xs-3 form-group">
                            {!! Form::label('po_no', 'DO Item NO *', ['class' => 'control-label']) !!}
                            {!! Form::text('po_no',$order_received_info->do_no, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                        </div>
                        <div class="col-xs-3 form-group">
                            {!! Form::label('po_no', 'DO Item Date *', ['class' => 'control-label']) !!}
                            {!! Form::text('po_no',$order_received_info->do_date, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                        </div>
                        <div class="col-xs-3 form-group">
                            {!! Form::label('vehicle_name', 'Vehicle Name', ['class' => 'control-label']) !!}
                            {!! Form::text('vehicle_name',$order_received_info->vehicle_name, ['id'=>'v_name','disabled','class' => 'form-control']) !!}
                        </div>
                        <div class="col-xs-3 form-group">
                            {!! Form::label('chk_place', 'Checking Place *', ['class' => 'control-label']) !!}
                            {!! Form::text('chk_place',$order_received_info->chk_place, ['id'=>'chk_place','disabled','class' => 'form-control']) !!}
                        </div>
                        <div class="col-xs-3 form-group">
                            {!! Form::label('chk_date', 'Checking Date *', ['class' => 'control-label']) !!}
                            {!! Form::text('chk_date',$order_received_info->chk_date, ['id'=>'chk_date','disabled','class' => 'form-control']) !!}
                        </div>
                        <!-- start -->
                        <div class="col-xs-3 form-group">
                            {!! Form::label('net_amt', 'Net Amount *', ['class' => 'control-label']) !!}
                            {!! Form::text('net_amt',old('net_amt'), ['id'=>'chk_place','class' => 'form-control']) !!}
                        </div>
                        <div class="col-xs-3 form-group">
                            {!! Form::label('rev_amt', 'Receiced Amount *', ['class' => 'control-label']) !!}
                            {!! Form::text('rev_amt',old('rev_amt'), ['id'=>'chk_date','class' => 'form-control']) !!}
                        </div>
                        <div class="col-xs-3 form-group">
                            {!! Form::label('red_amt', 'Reduce Amount', ['class' => 'control-label']) !!}
                            {!! Form::text('red_amt',old('red_amt'), ['id'=>'chk_remark','class' => 'form-control']) !!}
                        </div>
                        <div class="col-xs-3 form-group">
                            {!! Form::label('excess_amt', 'Excess Amount *', ['class' => 'control-label']) !!}
                            {!! Form::text('excess_amt',old('excess_amt'), ['id'=>'chk_place','class' => 'form-control']) !!}
                        </div>
                        <div class="col-xs-3 form-group">
                            {!! Form::label('damage_amt', 'Damage Amount *', ['class' => 'control-label']) !!}
                            {!! Form::text('damage_amt',old('damage_amt'), ['id'=>'chk_date','class' => 'form-control']) !!}
                        </div>
                        <div class="col-xs-3 form-group">
                            {!! Form::label('chk_box_no', 'Check Box Number', ['class' => 'control-label']) !!}
                            {!! Form::text('chk_box_no',old('chk_box_no'), ['id'=>'chk_remark','class' => 'form-control']) !!}
                        </div>
                        <div class="col-xs-6 form-group">
                            {!! Form::label('chk_remark', 'Remark', ['class' => 'control-label']) !!}
                            {!! Form::text('chk_remark',old('chk_remark'), ['id'=>'chk_remark','class' => 'form-control']) !!}
                        </div>
                        <p class="danger">{{$errors->update->first('net_amt')}}</p>
                        <p class="danger">{{$errors->update->first('rev_amt')}}</p>
                        <p class="danger">{{$errors->update->first('red_amt')}}</p>
                        <p class="danger">{{$errors->update->first('excess_amt')}}</p>
                        <p class="danger">{{$errors->update->first('damage_amt')}}</p>
                        <input type="hidden" name="dt_data" value="">
                        <!-- end -->
                        <p class="help-block"></p>
                        @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                        @endif
                        @endforeach
                        @endif
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div class="panel-body table-responsive">
                        @isset($to_checkitems)
                        <table id="total" class="table table-bordered table-striped {{ count($to_checkitems) > 0 ? 'datatable' : '' }} dt-select">
                            <thead>
                                <tr>
                                    <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                                    <th>@lang('global.do_item.fields.no')</th>
                                    <th>@lang('global.do_item.fields.item_name')</th>
                                    <th>@lang('global.do_item.fields.unit')</th>
                                    <th>@lang('global.do_item.fields.qty')</th>
                                    <th>Received Quantity</th>
                                    <th>@lang('global.do_item.fields.remark')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($to_checkitems) > 0)
                                @foreach ($to_checkitems as $key=>$to_checkitem)
                                <tr data-entry-id="{{ $to_checkitem->id }}">
                                    <td></td>
                                    <td style="text-align: center;">{{$key + 1}}</td>
                                    <td>{{ $to_checkitem->item_name }}</td>
                                    <td>{{ $to_checkitem->unit }}</td>
                                    <td>{{ $to_checkitem->qty }}</td>
                                    <td>
                                        {!! Form::number('r_qty',$to_checkitem->qty , ['id'=>'r_qty','class' => 'form-control']) !!}
                                    </td>
                                    <td>
                                        {!! Form::text('r_item_remark','', ['id'=>'r_item_remark','class' => 'form-control']) !!}
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
                        <p class="danger">{{$errors->update->first('dt_data')}}</p>

                        @endisset
                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
            <div class="panel-footer">
                @foreach ($order_received_infos as $check)
                @can('checker')
                {!! Form::button('<i class="fa fa-check"></i> Check Confirmed', ['type'=>'submit','class' => 'btn btn-primary']) !!}
                @endcan
                @can('approved_1')
                {!! Form::button('<i class="fa fa-check"></i> Check Confirmed', ['type'=>'submit','class' => 'btn btn-primary']) !!}
                @endcan
                @can('approved_2')
                {!! Form::button('<i class="fa fa-check"></i> Check Confirmed', ['type'=>'submit','class' => 'btn btn-primary']) !!}
                @endcan
                @endforeach
            </div>
        </div>

    </div>

</div>
{!! Form::close() !!}
@stop

@section('javascript')
<script>
    jQuery(document).ready(function() {
        jQuery('form#checkingForm').on('submit', function() {
            // e.preventDefault();
            var table = $('.datatable').DataTable();
            var rowData = table.rows('.selected').data()[0];
            var dtData = [];
            $('.datatable tbody tr.selected').each(function() {
                var id = $(this).data('entry-id');
                var qty = $(this).find("input[name=r_qty]").val();
                var r_item_remark = $(this).find("input[name=r_item_remark]").val();
                dtData.push({
                    'id': id,
                    'r_qty': qty,
                    'r_remark': r_item_remark
                });
            });
            dtData = JSON.stringify(dtData);
            $('input[name=dt_data').val(dtData);
        });
    });
</script>
@endsection
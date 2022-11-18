@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><a href="#tab_1" data-toggle="tab">Purchase Order Contract Details</a></li>
                <li class="active"><a href="#tab_2" data-toggle="tab">Store Code Entry</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="tab_1">
                    <div class="panel-body">
                        @if (count($order_received_infos) > 0)
                        @foreach ($order_received_infos as $order_received_info)
                        <div class="col-xs-4 form-group">
                            {!! Form::label('po_no', 'PO Contract NO *', ['class' => 'control-label']) !!}
                            {!! Form::text('po_no',$order_received_info->po_no, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                            {!! Form::hidden('rev_id',$order_received_info->id)!!}
                            {!! Form::hidden('po_id',$order_received_info->po_id)!!}
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('po_date', 'PO Contract Date *', ['class' => 'control-label']) !!}
                            {!! Form::text('po_date',$order_received_info->po_date, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('s_name', 'Supplier Name *', ['class' => 'control-label']) !!}
                            {!! Form::text('s_name',$order_received_info->supplier, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('po_no', 'DO Item NO *', ['class' => 'control-label']) !!}
                            {!! Form::text('po_no',$order_received_info->do_no, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('po_no', 'DO Item Date *', ['class' => 'control-label']) !!}
                            {!! Form::text('po_no',$order_received_info->do_date, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('vehicle_name', 'Vehicle Name', ['class' => 'control-label']) !!}
                            {!! Form::text('vehicle_name',$order_received_info->vehicle_name, ['id'=>'v_name','disabled','class' => 'form-control']) !!}
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('chk_place', 'Checking Place *', ['class' => 'control-label']) !!}
                            {!! Form::text('chk_place',$order_received_info->chk_place, ['id'=>'chk_place','disabled','class' => 'form-control']) !!}
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('chk_date', 'Checking Date *', ['class' => 'control-label']) !!}
                            {!! Form::text('chk_date',$order_received_info->chk_date, ['id'=>'chk_date','disabled','class' => 'form-control']) !!}
                        </div>
                        <!-- start -->
                        <div class="col-xs-4 form-group">
                            {!! Form::label('net_amt', 'Net Amount *', ['class' => 'control-label']) !!}
                            {!! Form::text('net_amt',$order_received_info->net_amt, ['disabled','class' => 'form-control']) !!}
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('rev_amt', 'Receiced Amount *', ['class' => 'control-label']) !!}
                            {!! Form::text('rev_amt',$order_received_info->rev_amt, ['disabled','class' => 'form-control']) !!}
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('red_amt', 'Reduce Amount', ['class' => 'control-label']) !!}
                            {!! Form::text('red_amt',$order_received_info->red_amt, ['disabled','class' => 'form-control']) !!}
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('excess_amt', 'Excess Amount *', ['class' => 'control-label']) !!}
                            {!! Form::text('excess_amt',$order_received_info->excess_amt, ['disabled','class' => 'form-control']) !!}
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('damage_amt', 'Damage Amount *', ['class' => 'control-label']) !!}
                            {!! Form::text('damage_amt',$order_received_info->damage_amt, ['disabled','class' => 'form-control']) !!}
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('chk_box_no', 'Check Box Number', ['class' => 'control-label']) !!}
                            {!! Form::text('chk_box_no',$order_received_info->chk_box_no, ['disabled','class' => 'form-control']) !!}
                        </div>
                        <div class="col-xs-4 form-group">
                            {!! Form::label('chk_remark', 'Remark', ['class' => 'control-label']) !!}
                            {!! Form::text('chk_remark',$order_received_info->chk_remark, ['disabled','class' => 'form-control']) !!}
                        </div>
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
                <div class="tab-pane active" id="tab_2">
                    <div class="panel-body table-responsive">
                        @if(count($to_checkitems) > 0)
                        <table id="removeBtn" class="table table-bordered table-striped {{ count($to_checkitems) > 0 ? 'datatable' : '' }}">
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($to_checkitems as $key=>$to_checkitem)
                                <tr>
                                    <form id="StoreCode">
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <input name="id" type="hidden" class="form-control" id="id" value="{{$to_checkitem->id}}">
                                            <input name="stockcode" type="text" class="form-control" id="stockcode">
                                        </td>
                                        <td>
                                            <input name="warehouse" type="text" class="form-control" id="warehouse">
                                        </td>
                                        <td>{{$to_checkitem->item_name}}</td>
                                        <td>{{$to_checkitem->unit}}</td>
                                        <td>{{$to_checkitem->price}}</td>
                                        <td>{{$to_checkitem->qty}}</td>
                                        <td>{{$to_checkitem->amt}}</td>
                                        <td>
                                            <button type="submit" class="btn btn-flat btn-primary">Save</button>
                                        </td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                    <div class="panel-body table-responsive">
                        @isset($store_items)
                        @if(count($store_items) > 0)
                        <table id="total" class="table table-bordered table-striped {{ count($store_items) > 0 ? 'datatable' : '' }}">
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($store_items as $key=>$store_item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$store_item->store_code}}</td>
                                    <td>{{$store_item->warehouse}}</td>
                                    <td>{{$store_item->item_name}}</td>
                                    <td>{{$store_item->unit}}</td>
                                    <td>{{$store_item->price}}</td>
                                    <td>{{$store_item->qty}}</td>
                                    <td>{{$store_item->amt}}</td>
                                </tr>
                                @endforeach
                            <tfoot>
                                <tr>
                                    <td colspan="7" style="text-align:right;">Total</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                            </tbody>
                        </table>
                        @endif
                        @endisset
                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>
    $('#removeBtn').DataTable({
        "dom": 'T<"clear">lfrtip'
    });
    $('#total').DataTable({
        "paging": true,
        "autoWidth": true,
        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();
            nb_cols = api.columns().nodes().length;
            var j = 7;
            while (j < nb_cols) {
                var pageTotal = api
                    .column(j, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return Number(a) + Number(b);
                    }, 0);
                // Update footer
                $(api.column(j).footer()).html(parseFloat(Math.round(pageTotal * 100) / 100).toFixed(3));
                j++;
            }
        }
    });
    jQuery(document).ready(function() {
        jQuery('form#StoreCode').on('submit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: "{{ route('admin.store-code.store') }}",
                data: {
                    stock_code: $('#stockcode').val(),
                    warehouse: $('#warehouse').val(),
                    id: $('#id').val()
                },
                success: function(data) {
                    location.reload();
                },
                error: function(response) {
                    console.log(response);
                },
            });
        });
    });
</script>
@endsection
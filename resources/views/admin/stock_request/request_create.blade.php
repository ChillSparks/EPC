@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('content')
<!-- <h3 class="page-title">@lang('global.po_contract.title')</h3> -->
{!! Form::open(['method' => 'POST','route'=>'admin.stock_request.store','id'=> 'RequestForm']) !!}
<div class="box box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">@lang('global.app_create') Issue Request Form</h3>
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-3 form-group">
                    {!! Form::label('v_no', 'Voucher No', ['class' => 'control-label']) !!}
                    {!! Form::text('v_no', $last_id, ['class' => 'form-control', 'disabled', 'placeholder' => '']) !!}
                    {!! Form::hidden('v_no', $last_id, ['class' => 'form-control','placeholder' => '']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('l_no', 'Letter NO', ['class' => 'control-label']) !!}
                    {!! Form::text('l_no', old('l_no'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="danger">{{ $errors->update->first('l_no') }}</p>
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('to_dept', 'To Department', ['class' => 'control-label']) !!}
                    {!! Form::text('to_dept', old('to_dept'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="danger">{{ $errors->update->first('to_dept') }}</p>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="col-xs-3 form-group">
                    {!! Form::label('req_date', 'Date', ['class' => 'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name='req_date' class="form-control" id="datepicker1" value="{{date('Y-m-d')}}">
                    </div>
                    <p class="danger">{{ $errors->update->first('req_date') }}</p>
                    <!-- /.input group -->
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('con_date', 'Confirm Date', ['class' => 'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name='con_date' class="form-control" id="datepicker2" value="{{date('Y-m-d')}}">
                    </div>
                    <p class="danger">{{ $errors->update->first('con_date') }}</p>
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('division', 'Division', ['class' => 'control-label']) !!}
                    <select id="division" name="division" class="form-control">
                        <option value="" selected disabled>Select</option>
                        @foreach($divisions as $key => $division)
                        <option value="{{$key}}"> {{$division}}</option>
                        @endforeach
                    </select>
                    <p class="danger">{{ $errors->update->first('division') }}</p>
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('township', 'Township', ['class' => 'control-label']) !!}
                    <select name="township" id="township" class="form-control">
                    </select>
                    <p class="danger">{{ $errors->update->first('township') }}</p>
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('reson', 'Reason For Issue', ['class' => 'control-label']) !!}
                    {{ Form::textarea('reason', null, ['placeholder' => 'Reason for issue', 'class' => 'form-control' ,'rows' =>3, 'maxlength' => "400"]) }}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('remark', 'Remark', ['class' => 'control-label']) !!}
                    {{ Form::textarea('remark', null, ['placeholder' => 'Remark', 'class' => 'form-control' ,'rows' =>3, 'maxlength' => "400"]) }}
                </div>
            </div>
            <div class="col-md-12">
                @if($errors->update->first('dt_data')!=null)
                <div class="alert alert-danger alert-dismissible">
                    <p>{{ $errors->update->first('dt_data') }}</p>
                </div>
                @endif
                <div class="col-md-12">
                    <table class="table table-bordered table-striped {{ count($store_items) > 0 ? 'datatable' : '' }} dt-select">
                        <thead>
                            <tr>
                                <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                                <th>@lang('global.do_item.fields.no')</th>
                                <th>Stock Code</th>
                                <th>@lang('global.do_item.fields.item_name')</th>
                                <th>WareHouse</th>
                                <th>@lang('global.do_item.fields.unit')</th>
                                <th>Available Quantity</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (count($store_items) > 0)
                            @foreach ($store_items as $no=>$store_item)
                            <tr data-entry-id="{{ $store_item->id }}">
                                @if($store_item->qty!=0)
                                <td></td>
                                @else
                                <td id="disable"></td>
                                @endif
                                <td>{{ $no+1 }}</td>
                                <td>{{ $store_item->store_code }}</td>
                                <td>{{ $store_item->item_name }}</td>
                                <td>{{ $store_item->warehouse }}</td>
                                <td>{{ $store_item->unit }}</td>
                                <td style="width:10%">
                                    {!! Form::hidden('rem_qty',$store_item->qty , ['id'=>'rem_qty','class' => 'form-control', 'placeholder' => '']) !!}
                                    @if($store_item->qty!=0)
                                    {!! Form::number('qty',$store_item->qty , ['id'=>'qty','class' => 'form-control', 'placeholder' => '']) !!}
                                    @else
                                    <input type="text" name="qty" id="qty" value="Out of Stock" disabled>
                                    @endif
                                </td>
                                <input type="hidden" name="dt_data" value="">
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-12">
                {!! Form::button(' <i class="fa fa-save"></i> '.trans('global.app_save'), ['type'=>'submit','class' => 'btn btn-success']) !!}
                <a class="btn btn-flat btn-danger " href="{{ route('admin.stock_request.create') }}"><i class="fa fa-reply-all"></i> Cancel</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @stop
    @section('javascript')
    @foreach ($store_items as $no=>$store_item)
    <script>
        //Date picker
        $("#disable").find("checkbox").prop("disabled",true);
        $(function() {
            $("#datepicker1").datepicker();
            $("#datepicker1").datepicker("option", "dateFormat", "yy-mm-dd");
            $("#datepicker1").datepicker("option", "maxDate", "+100y");
            $("#datepicker1").datepicker("option", "minDate", "-10y");
            $("#datepicker1").datepicker("option", "changeMonth", true);
            $("#datepicker1").datepicker("option", "changeYear", true);
            $("#datepicker1").datepicker("setDate", new Date());

            $("#datepicker2").datepicker();
            $("#datepicker2").datepicker("option", "dateFormat", "yy-mm-dd");
            $("#datepicker2").datepicker("option", "maxDate", "+100y");
            $("#datepicker2").datepicker("option", "minDate", "-10y");
            $("#datepicker2").datepicker("option", "changeMonth", true);
            $("#datepicker2").datepicker("option", "changeYear", true);
            $("#datepicker2").datepicker("setDate", new Date());
        });
        $(document).ready(function() {
            jQuery('form#RequestForm').on('submit', function() {
                var dtData = [];
                $('.datatable tbody tr.selected').each(function() {
                    var id = $(this).data('entry-id');
                    var qty = $(this).find("input[name=qty]").val();
                    dtData.push({
                        'id': id,
                        'qty': qty
                    });
                });
                dtData = JSON.stringify(dtData);
                $('input[name=dt_data').val(dtData);
            });
            $('#division').change(function() {
                var divisionID = $(this).val();
                if (divisionID) {
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "{{ route('admin.township') }}",
                        data: {
                            'id': divisionID
                        },
                        success: function(res) {
                            console.log(res);
                            if (res) {
                                $("#township").empty();
                                $("#township").append('<option>Select</option>');
                                $.each(res, function(key, value) {
                                    $("#township").append('<option value="' + value + '">' + value + '</option>');
                                });

                            } else {
                                $("#township").empty();
                            }
                        }
                    });
                } else {
                    $("#township").empty();
                    $("#division").empty();
                }
            });
        });
    </script>
    @endforeach
    @endsection
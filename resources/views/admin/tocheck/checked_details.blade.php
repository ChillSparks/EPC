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
                                    {!! Form::text('net_amt',$order_received_info->net_amt, ['disabled','class' => 'form-control']) !!}
                                </div>
                                <div class="col-xs-3 form-group">    
                                    {!! Form::label('rev_amt', 'Receiced Amount *', ['class' => 'control-label']) !!}
                                    {!! Form::text('rev_amt',$order_received_info->rev_amt, ['disabled','class' => 'form-control']) !!}
                                </div> 
                                <div class="col-xs-3 form-group">    
                                    {!! Form::label('red_amt', 'Reduce Amount', ['class' => 'control-label']) !!}
                                    {!! Form::text('red_amt',$order_received_info->red_amt, ['disabled','class' => 'form-control']) !!}
                                </div> 
                                <div class="col-xs-3 form-group">    
                                    {!! Form::label('excess_amt', 'Excess Amount *', ['class' => 'control-label']) !!}
                                    {!! Form::text('excess_amt',$order_received_info->excess_amt, ['disabled','class' => 'form-control']) !!}
                                </div>
                                <div class="col-xs-3 form-group">    
                                    {!! Form::label('damage_amt', 'Damage Amount *', ['class' => 'control-label']) !!}
                                    {!! Form::text('damage_amt',$order_received_info->damage_amt, ['disabled','class' => 'form-control']) !!}
                                </div> 
                                <div class="col-xs-3 form-group">    
                                    {!! Form::label('chk_box_no', 'Check Box Number', ['class' => 'control-label']) !!}
                                    {!! Form::text('chk_box_no',$order_received_info->chk_box_no, ['disabled','class' => 'form-control']) !!}
                                </div> 
                                <div class="col-xs-6 form-group">    
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
                <div class="tab-pane" id="tab_2">
                    <div class="panel-body table-responsive">
                        @isset($to_checkitems)
                            <table class="table table-bordered table-striped {{ count($to_checkitems) > 0 ? 'datatable' : '' }}">
                                <thead>
                                    <tr>
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
                                                <td style="text-align: center;">{{$key + 1}}</td>
                                                <td>{{ $to_checkitem->item_name }}</td>
                                                <td>{{ $to_checkitem->unit }}</td>
                                                <td>{{ $to_checkitem->qty }}</td>
                                                <td>{{ $to_checkitem->r_qty }}</td>                         
                                                <td>{{ $to_checkitem->item_remark }}</td>
                                            </tr>                                   
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                                        </tr>
                                    @endif
                                    
                                </tbody>
                            </table>
                        @endisset  
                    </div>
                </div>
                {!! Form::close() !!} 
              <!-- /.tab-pane -->
            </div>
                <div class="panel-footer">
                    @foreach ($order_received_infos as $check)
                    <div class="row text-center">
                        <div class="col-sm-4">
                                @if($check->checker == 1) 
                                    <div class="card">
                                        <img class="card-img-top" src="{{URL::asset('/images/check.png')}}" alt="seal" height="50%" width="60%">
                                        <div class="card-body">
                                            <p class="card-text">
                                                <strong><p> Checking Name: {{$check->updated_by}}</p></strong>
                                                <strong><p> Checking Date: {{ date('d-M-y', strtotime($check->updated_at)) }}</p></strong>
                                            </p>
                                        </div>
                                    </div>
                                @endif                             
                        </div>
                        <div class="col-sm-4">
                            @if($check->approved_level_2 == 0)
                                @can('approved_level_2')
                                    {!! Form::open(['method' => 'PUT', 'route' => ['admin.tocheck.secondApproved', $check->id], 'style'=>'display: inline-block']) !!}
                                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                                        <input type="hidden" name="id" value="{{ $check->id }}" >
                                        <input type = "hidden"  name = "isApproved" value = "1">
                                        <button type="submit" class="btn btn-flat btn-success" style="color:white" value="1"> 
                                        <strong>Approve</strong>  </button>
                                    {!!Form::close()!!}
                                    {!! Form::open(['method' => 'PUT', 'route' => ['admin.tocheck.secondApproved', $check->id], 'style'=>'display: inline-block']) !!}
                                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                                        <input type="hidden" name="id" value="{{ $check->id }}" >
                                        <input type = "hidden"  name = "isApproved" value = "2">
                                        <button type="submit" class="btn btn-flat btn-danger" style="color:white" value="1"> 
                                        <strong>Reject</strong>  </button>
                                    {!!Form::close()!!}
                                @endcan
                            @elseif($check->approved_level_2 == 1)
                                <div class="card">
                                    <img class="card-img-top" src="{{URL::asset('/images/approved.png')}}" alt="seal" height="50%" width="60%">
                                    <div class="card-body">
                                        <p class="card-text">
                                            <strong><p> Checking Name: {{$check->updated_by}}</p></strong>
                                            <strong><p> Checking Date: {{ date('d-M-y', strtotime($check->updated_at)) }}</p></strong>
                                        </p>
                                    </div>
                                </div>
                            @else($check->approved_level_2 == 2)
                            <div class="card">
                                    <img class="card-img-top" src="{{URL::asset('/images/reject.png')}}" alt="seal" height="50%" width="60%">
                                    <div class="card-body">
                                        <p class="card-text">
                                            <strong><p> Checking Name: {{$check->updated_by}}</p></strong>
                                            <strong><p> Checking Date: {{ date('d-M-y', strtotime($check->updated_at)) }}</p></strong>
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-4">
                        @if($check->approved_level_1 == 0) 
                            @can('approved_level_1')
                                {!! Form::open(['method' => 'PUT', 'route' => ['admin.tocheck.firstApproved', $check->id], 'style'=>'display: inline-block']) !!}
                                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                                    <input type="hidden" name="id" value="{{ $check->id }}" >
                                    <input type = "hidden"  name = "isApproved" value = "1">
                                    <button type="submit" class="btn btn-flat btn-success" style="color:white" value="1"> 
                                    <strong>Approve</strong>  </button>
                                {!!Form::close()!!}
                                {!! Form::open(['method' => 'PUT', 'route' => ['admin.tocheck.firstApproved', $check->id], 'style'=>'display: inline-block']) !!}
                                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                                    <input type="hidden" name="id" value="{{ $check->id }}" >
                                    <input type = "hidden"  name = "isApproved" value = "2">
                                    <button type="submit" class="btn btn-flat btn-danger" style="color:white" value="1"> 
                                    <strong>Reject</strong>  </button>
                                {!!Form::close()!!}
                            @endcan
                            @elseif($check->approved_level_1 == 1)
                                <div class="card">
                                    <img class="card-img-top" src="{{URL::asset('/images/approved.png')}}" alt="seal" height="50%" width="60%">
                                    <div class="card-body">
                                        <p class="card-text">
                                            <strong><p> Checking Name: {{$check->updated_by}}</p></strong>
                                            <strong><p> Checking Date: {{ date('d-M-y', strtotime($check->updated_at)) }}</p></strong>
                                        </p>
                                    </div>
                                </div>
                            @else($check->approved_level_1 == 2)
                            <div class="card">
                                    <img class="card-img-top" src="{{URL::asset('/images/reject.png')}}" alt="seal" height="50%" width="60%">
                                    <div class="card-body">
                                        <p class="card-text">
                                            <strong><p> Checking Name: {{$check->updated_by}}</p></strong>
                                            <strong><p> Checking Date: {{ date('d-M-y', strtotime($check->updated_at)) }}</p></strong>
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach   
                </div>
            </div>  
        </div>
    </div>
    
@stop

@section('javascript')
<script>
</script> 
@endsection
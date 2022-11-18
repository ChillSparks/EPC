@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
{!! Form::open(['method' => 'POST', 'route' => ['admin.tocheck.store'], 'id'=>'checkingForm']) !!}
<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Issue Request Info</a></li>
                <li><a href="#tab_2" data-toggle="tab">Issue Request Items</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="panel-body">
                        @foreach($stock_requests as $key=>$stock_request)
                        <div class="row">
                            <div class="col-xs-3 form-group">
                                {!! Form::label('v_no', 'Voucher No', ['class' => 'control-label']) !!}

                                {!! Form::text('v_no',$stock_request->voucher_no , ['class' => 'form-control','disabled','placeholder' => '']) !!}
                            </div>
                            <div class="col-xs-3 form-group">
                                {!! Form::label('l_no', 'Letter NO', ['class' => 'control-label']) !!}
                                {!! Form::text('l_no', $stock_request->l_no, ['class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                            <div class="col-xs-6 form-group">
                                {!! Form::label('to_dept', 'To Department', ['class' => 'control-label']) !!}
                                {!! Form::text('to_dept', $stock_request-> dept_biz_name, ['class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                            <div class="col-xs-3 form-group">
                                {!! Form::label('req_date', 'Date', ['class' => 'control-label']) !!}
                                {!! Form::date('to_dept', $stock_request->date, ['class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                            <div class="col-xs-3 form-group">
                                {!! Form::label('con_date', 'Confirm Date', ['class' => 'control-label']) !!}
                                {!! Form::date('to_dept', $stock_request->confirm_date, ['class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                            <div class="col-xs-3 form-group">
                                {!! Form::label('division', 'Division', ['class' => 'control-label']) !!}
                                {!! Form::text('division', $stock_request->division, ['class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                            <div class="col-xs-3 form-group">
                                {!! Form::label('township', 'Township', ['class' => 'control-label']) !!}
                                {!! Form::text('township', $stock_request->township, ['class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                            <div class="col-xs-6 form-group">
                                {!! Form::label('reson', 'Reason For Issue', ['class' => 'control-label']) !!}
                                {{ Form::textarea('reason', $stock_request->reason, ['placeholder' => 'Reason for issue', 'class' => 'form-control' ,'rows' =>3, 'maxlength' => "400"]) }}
                            </div>
                            <div class="col-xs-6 form-group">
                                {!! Form::label('remark', 'Remark', ['class' => 'control-label']) !!}
                                {{ Form::textarea('remark', $stock_request->remark, ['placeholder' => 'Remark', 'class' => 'form-control' ,'rows' =>3, 'maxlength' => "400"]) }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div class="panel-body table-responsive">
                        @isset($stock_requests_details)
                        <table id="total" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('global.do_item.fields.no')</th>
                                    <th>Store Code</th>
                                    <th>@lang('global.do_item.fields.item_name')</th>
                                    <th>@lang('global.do_item.fields.unit')</th>
                                    <th>@lang('global.do_item.fields.qty')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($stock_requests_details) > 0)
                                @foreach ($stock_requests_details as $key=>$stock_requests_detail)
                                <tr data-entry-id="{{ $stock_requests_detail->id }}">
                                    <td style="text-align: center;">{{$key + 1}}</td>
                                    <td>{{ $stock_requests_detail->stock_code }}</td>
                                    <td>{{ $stock_requests_detail->item_name }}</td>
                                    <td>{{ $stock_requests_detail->unit }}</td>
                                    <td class="qty">{{ $stock_requests_detail->qty }}</td>
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
                @foreach ($stock_requests as $stock_request)
                <div class="row text-center">
                    <div class="col-sm-6">
                        @if($stock_request->approved_level_2 == 0)
                        @can('approved_level_2')
                        {!! Form::open(['method' => 'PUT', 'route' => ['admin.stock_request.secondApproved', $stock_request->id], 'style'=>'display: inline-block']) !!}
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <input type="hidden" name="id" value="{{ $stock_request->id }}">
                        <input type="hidden" name="isApproved" value="1">
                        <button type="submit" class="btn btn-flat btn-success" style="color:white" value="1">
                            <strong>Approve</strong> </button>
                        {!!Form::close()!!}
                        {!! Form::open(['method' => 'PUT', 'route' => ['admin.stock_request.secondApproved', $stock_request->id], 'style'=>'display: inline-block']) !!}
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <input type="hidden" name="id" value="{{ $stock_request->id }}">
                        <input type="hidden" name="isApproved" value="2">
                        <button type="submit" class="btn btn-flat btn-danger" style="color:white" value="1">
                            <strong>Reject</strong> </button>
                        {!!Form::close()!!}
                        @endcan
                        @elseif($stock_request->approved_level_2 == 1)
                        <div class="card">
                            <img class="card-img-top" src="{{URL::asset('/images/approved.png')}}" alt="seal" height="30%" width="40%">
                            <div class="card-body">
                                <p class="card-text">
                                    <strong>
                                        <p> Checking Name: {{$stock_request->updated_by}}</p>
                                    </strong>
                                    <strong>
                                        <p> Checking Date: {{ date('d-M-y', strtotime($stock_request->updated_at)) }}</p>
                                    </strong>
                                </p>
                            </div>
                        </div>
                        @else($stock_request->approved_level_2 == 2)
                        <div class="card">
                            <img class="card-img-top" src="{{URL::asset('/images/reject.png')}}" alt="seal" height="30%" width="40%">
                            <div class="card-body">
                                <p class="card-text">
                                    <strong>
                                        <p> Checking Name: {{$stock_request->updated_by}}</p>
                                    </strong>
                                    <strong>
                                        <p> Checking Date: {{ date('d-M-y', strtotime($stock_request->updated_at)) }}</p>
                                    </strong>
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        @if($stock_request->approved_level_1 == 0)
                        @can('approved_level_1')
                        {!! Form::open(['method' => 'PUT', 'route' => ['admin.stock_request.firstApproved', $stock_request->id], 'style'=>'display: inline-block']) !!}
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <input type="hidden" name="id" value="{{ $stock_request->id }}">
                        <input type="hidden" name="isApproved" value="1">
                        <button type="submit" class="btn btn-flat btn-success" style="color:white" value="1">
                            <strong>Approve</strong> </button>
                        {!!Form::close()!!}
                        {!! Form::open(['method' => 'PUT', 'route' => ['admin.stock_request.firstApproved', $stock_request->id], 'style'=>'display: inline-block']) !!}
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <input type="hidden" name="id" value="{{ $stock_request->id }}">
                        <input type="hidden" name="isApproved" value="2">
                        <button type="submit" class="btn btn-flat btn-danger" style="color:white" value="1">
                            <strong>Reject</strong> </button>
                        {!!Form::close()!!}
                        @endcan
                        @elseif($stock_request->approved_level_1 == 1)
                        <div class="card">
                            <img class="card-img-top" src="{{URL::asset('/images/approved.png')}}" alt="seal" height="30%" width="40%">
                            <div class="card-body">
                                <p class="card-text">
                                    <strong>
                                        <p> Checking Name: {{$stock_request->updated_by}}</p>
                                    </strong>
                                    <strong>
                                        <p> Checking Date: {{ date('d-M-y', strtotime($stock_request->updated_at)) }}</p>
                                    </strong>
                                </p>
                            </div>
                        </div>
                        @else($stock_request->approved_level_1 == 2)
                        <div class="card">
                            <img class="card-img-top" src="{{URL::asset('/images/reject.png')}}" alt="seal" height="30%" width="40%">
                            <div class="card-body">
                                <p class="card-text">
                                    <strong>
                                        <p> Checking Name: {{$stock_request->updated_by}}</p>
                                    </strong>
                                    <strong>
                                        <p> Checking Date: {{ date('d-M-y', strtotime($stock_request->updated_at)) }}</p>
                                    </strong>
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
 
@endsection
@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
{!! Form::open(['method' => 'POST', 'route' => ['admin.stock_issue.store'], 'id'=>'IssueForm']) !!}
<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Issue Info</a></li>
                <li><a href="#tab_2" data-toggle="tab">Issue Items</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="panel-body">
                        @foreach($stock_requests as $key=>$stock_request)
                        <div class="row">
                            <div class="col-xs-3 form-group">
                                {!! Form::label('req_voucher_no', 'EPS 25-A NO', ['class' => 'control-label']) !!}
                                {!! Form::hidden('req_voucher_no',$stock_request->voucher_no) !!}
                                {!! Form::hidden('request_id',$stock_request->id)!!}
                                {!! Form::text('req_voucher_no',$stock_request->voucher_no , ['class' => 'form-control','disabled','placeholder' => '']) !!}
                            </div>
                            <div class="col-xs-3 form-group">
                                {!! Form::label('req_date', 'EPS 25-A Date', ['class' => 'control-label']) !!}
                                {!! Form::text('req_date', $stock_request->date, ['class' => 'form-control', 'placeholder' => '']) !!}
                                <p class="danger">{{ $errors->update->first('req_date') }}</p>
                            </div>
                            <div class="col-xs-3 form-group">
                                {!! Form::label('issue_no', 'EPS 25-B NO', ['class' => 'control-label']) !!}
                                {!! Form::text('issue_no',$last_id , ['class' => 'form-control','placeholder' => '']) !!}
                                {!! Form::hidden('l_no',$stock_request->l_no, ['class' => 'form-control','placeholder' => '']) !!}
                                <p class="danger">{{ $errors->update->first('issue_no') }}</p>
                            </div>
                            <div class="col-xs-3 form-group">
                                {!! Form::label('issue_date', 'EPS 25-B Date', ['class' => 'control-label']) !!}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name='issue_date' class="form-control" id="datepicker" value="{{date('Y-m-d')}}">
                                </div>
                                <p class="danger">{{ $errors->update->first('issue_date') }}</p>
                                <!-- /.input group -->
                            </div>
                            <div class="col-xs-6 form-group">
                                {!! Form::label('to_dept', 'To Department', ['class' => 'control-label']) !!}
                                {!! Form::text('to_dept', $stock_request-> dept_biz_name, ['class' => 'form-control', 'placeholder' => '']) !!}
                                <p class="danger">{{ $errors->update->first('to_dept') }}</p>
                            </div>
                            <div class="col-xs-3 form-group">
                                {!! Form::label('division', 'Division', ['class' => 'control-label']) !!}
                                {!! Form::text('division', $stock_request->division, ['class' => 'form-control', 'placeholder' => '']) !!}
                                <p class="danger">{{ $errors->update->first('division') }}</p>
                            </div>
                            <div class="col-xs-3 form-group">
                                {!! Form::label('township', 'Township', ['class' => 'control-label']) !!}
                                {!! Form::text('township', $stock_request->township, ['class' => 'form-control', 'placeholder' => '']) !!}
                                <p class="danger">{{ $errors->update->first('township') }}</p>
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
                        <table id="total"  class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                
                                    <th>@lang('global.do_item.fields.no')</th>
                                    <th>Stock Code</th>
                                    <th>@lang('global.do_item.fields.item_name')</th>
                                    <th>@lang('global.do_item.fields.unit')</th>
                                    <th>Quantity</th>
                                    <th>@lang('global.do_item.fields.price')</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($stock_requests_details) > 0)
                                @php
                                    $total=0;
                                @endphp
                                @foreach ($stock_requests_details as $key=>$stock_requests_detail)
                                <tr data-entry-id="{{ $stock_requests_detail->id }}">
                                    <input type="hidden" name="stock_req_detail_id[]" value="{{ $stock_requests_detail->id }}">
                                    <td style="text-align: center;">{{$key + 1}}</td>
                                    <td>{{ $stock_requests_detail->stock_code }}</td>
                                    {!! Form::hidden('stock_code',$stock_requests_detail->stock_code)!!}
                                    <td>{{ $stock_requests_detail->item_name }}</td>
                                    <td>{{ $stock_requests_detail->unit }}</td>
                                    <td>{{ $stock_requests_detail->qty }}</td>
                                    <td>{{ $stock_requests_detail->price }}</td>
                                    <td>{{ $stock_requests_detail->amt }}</td>
                                </tr>
                                @endforeach
                                <tfoot>
                                    <tr>
                                        <td colspan="6" style="text-align:right;">Total</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
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
                <!-- /.tab-pane -->
            </div>
            <div class="panel-footer">
            @can('issue_creator')
                {!! Form::button(' <i class="fa fa-save"></i> Create', ['type'=>'submit','class' => 'btn btn-success']) !!}
                <a class="btn btn-flat btn-danger" id="parameter" href=''><i class="fa fa-times"></i> Cancel</a>
                {!! Form::close() !!}
            @endcan
            </div>
        </div>
    </div>
</div>
            
@stop

@section('javascript')

<script>
$('#total').DataTable(
            {
                "paging": true,
                "autoWidth": true,
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api();
                    nb_cols = api.columns().nodes().length;
                    var j = 6;
                    while(j < nb_cols){
                        var pageTotal = api
                    .column( j, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return Number(a) + Number(b);
                    }, 0 );
            // Update footer
            $( api.column( j ).footer() ).html(parseFloat(Math.round(pageTotal * 100) / 100).toFixed(3));
                        j++;
                    } 
                }
            }
        );

</script>
@endsection

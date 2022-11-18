@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
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
                        @foreach($stock_issues as $key=>$stock_issue)
                        <div class="row">
                            <div class="col-xs-3 form-group">
                                {!! Form::label('req_voucher_no', 'EPS 25-A NO', ['class' => 'control-label']) !!}
                                {!! Form::text('req_voucher_no',$stock_issue-> req_voucher_no , ['disabled','class' => 'form-control','disabled','placeholder' => '']) !!}
                            </div>
                            <div class="col-xs-3 form-group">
                                {!! Form::label('req_date', 'EPS 25-A Date', ['class' => 'control-label']) !!}
                                {!! Form::text('req_date', $stock_issue->req_date, ['disabled','class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                            <div class="col-xs-3 form-group">
                                {!! Form::label('issue_no', 'EPS 25-B NO', ['class' => 'control-label']) !!}
                                {!! Form::text('issue_no',$stock_issue->issue_no , ['disabled','class' => 'form-control','placeholder' => '']) !!}
                            </div>
                            <div class="col-xs-3 form-group">
                                {!! Form::label('issue_date', 'EPS 25-B Date', ['class' => 'control-label']) !!}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input  type="text" name='issue_date' class="form-control" id="datepicker" value="{{$stock_issue->issue_date}}" disabled>
                                </div>
                            </div>
                            <div class="col-xs-6 form-group">
                                {!! Form::label('to_dept', 'To Department', ['class' => 'control-label']) !!}
                                {!! Form::text('to_dept', $stock_issue->to_dept, ['disabled','class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                            <div class="col-xs-3 form-group">
                                {!! Form::label('division', 'Division', ['class' => 'control-label']) !!}
                                {!! Form::text('division', $stock_issue->division, ['disabled','class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                            <div class="col-xs-3 form-group">
                                {!! Form::label('township', 'Township', ['class' => 'control-label']) !!}
                                {!! Form::text('township', $stock_issue->township, ['disabled','class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                            <div class="col-xs-6 form-group">
                                {!! Form::label('reson', 'Reason For Issue', ['class' => 'control-label']) !!}
                                {{ Form::textarea('reason', $stock_issue->reason, ['disabled','placeholder' => 'Reason for issue', 'class' => 'form-control' ,'rows' =>3, 'maxlength' => "400"]) }}
                            </div>
                            <div class="col-xs-6 form-group">
                                {!! Form::label('remark', 'Remark', ['class' => 'control-label']) !!}
                                {{ Form::textarea('remark', $stock_issue->remark, ['disabled','placeholder' => 'Remark', 'class' => 'form-control' ,'rows' =>3, 'maxlength' => "400"]) }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div class="panel-body table-responsive">
                        @isset($stock_issue_details)
                        <table id="total" class="table table-bordered table-striped">
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
                                @if(count($stock_issue_details) > 0)
                                @php
                                $total=0;
                                @endphp
                                @foreach ($stock_issue_details as $key=>$stock_issue_detail)
                                <tr data-entry-id="{{ $stock_issue_detail->id }}">
                                    <td style="text-align: center;">{{$key + 1}}</td>
                                    <td>{{ $stock_issue_detail->stock_code }}</td>
                                    <td>{{ $stock_issue_detail->item_name }}</td>
                                    <td>{{ $stock_issue_detail->unit }}</td>
                                    <td>{{ $stock_issue_detail->qty }}</td>
                                    <td>{{ $stock_issue_detail->price }}</td>
                                    <td>{{ $stock_issue_detail->amt }}</td>
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
                @foreach ($stock_issues as $issue_confirm)
                @if($issue_confirm->approved_level_1 == 0)
                @can('approved_level_1')
                {!! Form::open(['method' => 'PUT', 'route' => ['admin.stock_issue.confrimApproved', $issue_confirm->id], 'style'=>'display: inline-block']) !!}
                <meta name="csrf-token" content="{{ csrf_token() }}" />
                <input type="hidden" name="id" value="{{ $issue_confirm->id }}">
                <input type="hidden" name="isApproved" value="1">
                <button type="submit" class="btn btn-flat btn-success" style="color:white" value="1">
                    <strong>Approve</strong> </button>
                {!!Form::close()!!}
                {!! Form::open(['method' => 'PUT', 'route' => ['admin.stock_issue.confrimApproved', $issue_confirm->id], 'style'=>'display: inline-block']) !!}
                <meta name="csrf-token" content="{{ csrf_token() }}" />
                <input type="hidden" name="id" value="{{ $issue_confirm->id }}">
                <input type="hidden" name="isApproved" value="2">
                <button type="submit" class="btn btn-flat btn-danger" style="color:white" value="1">
                    <strong>Reject</strong> </button>
                {!!Form::close()!!}
                @endcan
                @elseif($issue_confirm->approved_level_1 == 1)
                <div class="card">
                    <img class="card-img-top" src="{{URL::asset('/images/approved.png')}}" alt="seal" height="10%" width="20%">
                    <div class="card-body">
                        <p class="card-text">
                            <strong>
                                <p> Checking Name: {{$issue_confirm->updated_by}}</p>
                            </strong>
                            <strong>
                                <p> Checking Date: {{ date('d-M-y', strtotime($issue_confirm->updated_at)) }}</p>
                            </strong>
                        </p>
                    </div>
                </div>
                @else($issue_confirm->approved_level_1 == 2)
                <div class="card">
                    <img class="card-img-top" src="{{URL::asset('/images/reject.png')}}" alt="seal" height="10%" width="20%">
                    <div class="card-body">
                        <p class="card-text">
                            <strong>
                                <p> Checking Name: {{$issue_confirm->updated_by}}</p>
                            </strong>
                            <strong>
                                <p> Checking Date: {{ date('d-M-y', strtotime($issue_confirm->updated_at)) }}</p>
                            </strong>
                        </p>
                    </div>
                </div>
                @endif

                @endforeach
            </div>
        </div>
    </div>
</div>

@stop

@section('javascript')

<script>
    $('#total').DataTable({
        "paging": true,
        "autoWidth": true,
        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();
            nb_cols = api.columns().nodes().length;
            var j = 6;
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
</script>
@endsection
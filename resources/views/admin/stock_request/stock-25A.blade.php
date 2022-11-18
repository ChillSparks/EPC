@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="box  box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">@lang('global.app_list') Issue Request</h3>
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <p>
            <a href="{{ route('admin.stock_request.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create Issue Request</a>
        </p>
        @if (session()->has('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
        @endif
        <div class="row">
            <div class="panel-body table-responsive">
                <table class="table table-bordered table-striped {{ count($stock_requests) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Voucher No</th>
                            <th>Date</th>
                            <th>Department Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($stock_requests) > 0)
                        @foreach($stock_requests as $key=>$stock_request)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$stock_request->voucher_no}}</td>
                            <td>{{$stock_request->confirm_date}}</td>
                            <td>{{$stock_request->dept_biz_name}}</td>
                            <td>
                                @if($stock_request->approved_level_2 == 0)
                                <span class="label label-warning label-many">Need Approved</span>
                                @elseif($stock_request->approved_level_2 == 1 && $stock_request->approved_level_1 == 0)
                                <span class="label label-success label-many">Lv_2_Approved</span>
                                @elseif($stock_request->approved_level_2 == 1 && $stock_request->approved_level_1 == 1)
                                <span class="label label-danger label-many">Closed</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('admin.stock_request.detail',$stock_request->id) }}" class="btn btn-flat btn-xs btn-primary"><i class="fa fa-eye"> View Details</i></a>
                                {!! Form::open(array(
                                'style' => 'display: inline-block;',
                                'method' => 'DELETE',
                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                'route' => ['admin.stock_request.destroy', $stock_request->id])) !!}
                                {!! Form::button('<i class="fa fa-trash"></i> '.trans('global.app_delete'), array('type'=>'submit','class' => 'btn btn-xs btn-danger btn-flat')) !!}
                                {!! Form::close() !!}
                                <a href="{{ URL::to('admin/printRequest',$stock_request->id) }}" id="request{{$stock_request->id}}" class="fa fa-print btn btn-xs btn-info">Print</a></td>
                        </tr>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                        <script src="http://www.position-absolute.com/creation/print/jquery.printPage.js"></script>
                        <script>
                            $(document).ready(function() {
                                $("#request{{$stock_request->id}}").printPage();
                            });
                        </script>
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
    </div>
</div>

@stop

@section('javascript')


@endsection
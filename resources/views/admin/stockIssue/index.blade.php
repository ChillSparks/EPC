@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="box box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">@lang('global.app_list') Stock Issue</h3>
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="panel-body table-responsive">
                @isset($stock_requests)
                <table id="removeBtn" class="table table-bordered table-striped {{ count($stock_requests) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Request Voucher No</th>
                            <th>Request Date</th>
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
                            <td>
                                @if($stock_request->issue_create_flag == 0)
                                <a href="{{route('admin.stock_issue.create',[$stock_request->id])}}" class="btn btn-flat btn-success"><i class="fa fa-plus"></i>&nbsp; @lang('global.app_create') &nbsp;</a>
                                @else
                                <a href="{{route('admin.issue.confirm',[$stock_request->id])}}" class="btn btn-flat btn-primary"><i class="fa fa-eye"></i> View Detail</a>
                                @endif
                                <a href="{{ URL::to('admin/printIssue',$stock_request->id) }}" id="btnPrint{{$stock_request->id}}" class="fa fa-print btn btn-info btn-flat"> Print</a>
                            </td>
                        </tr>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                        <script src="http://www.position-absolute.com/creation/print/jquery.printPage.js"></script>
                        <script>
                            $(document).ready(function() {
                                $("#btnPrint{{$stock_request->id}}").printPage();
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
                @endisset
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
</script>
@endsection
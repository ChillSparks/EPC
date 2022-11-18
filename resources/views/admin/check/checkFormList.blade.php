@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<style>
    .table-responsive{
        width:100%;
    }
</style>

<!------------------------------------------- v v List   -------------------------------------->
<div class="box box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">List To Check (Form - 16)</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <p class="pull-right">
            <!-- po received id -->
            <a href="{{ route('admin.check.create',['id'=>$contracts[0]->id]) }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create Check Form</a>
           
        </p>
        <div class="table-responsive">
        <table id="tbl" class="table table-bordered table-striped {{ count($chk_lists) > 0 ? 'datatable' : '' }}">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Checking Form ( To Check)</th>
                    <th>PO Contract NO</th>
                    <th>PO Contract Date</th>
                    <th>Form 16A</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @if (count($chk_lists) > 0)
                @foreach ($chk_lists as $key=>$chk_list)
                <tr data-entry-id="{{ $chk_list->received_id }}" data-href="{{ route('admin.check.show',$chk_list->received_id) }}">
                    <td>{{$key +1}}</td>
                    <td>Checking Form {{$key +1}}</td>
                    <td>{{ $chk_list->po_no }}</td>
                    <td>{{ $chk_list->po_date }}</td>
                    <td><a href="{{ URL::to('/admin/printForm16A/' . $chk_list->received_id )}}" class="btn btn-flat btn-xs btn-info" id="btnPrint{{$chk_list->received_id}}"><i class="fa fa-print"> Form 16A Print</i></a></td>
                    <td>
                        <a href="{{ route('admin.check.show',$chk_list->received_id) }}" class="btn btn-flat btn-xs btn-primary"><i class="fa fa-eye"> View Details</i></a>
                        <!-- <a href="{{ route('admin.check.editcheck',$chk_list->received_id) }}"class="btn btn-flat btn-xs btn-info"><i class="fa fa-edit">Edit</i></a> -->
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                        'route' => ['admin.check.delete', $chk_list->received_id])) !!}
                        {!! Form::button('<i class="fa fa-trash"></i> '.trans('global.app_delete'), array('type'=>'submit','class' => 'btn btn-xs btn-danger btn-flat')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script src="http://www.position-absolute.com/creation/print/jquery.printPage.js"></script>
                <script>
                $('.datatable').on('click', 'tbody tr', function() {
                    window.location.href = $(this).data('href');
                });
                $(document).ready(function(){
                        $("#btnPrint{{$chk_list->received_id}}").printPage();
                    });    
            </script>
                @endforeach
                @else
                <tr>
                    <td colspan="6">@lang('global.app_no_entries_in_table')</td>
                </tr>
                @endif
            </tbody>
        </table>
        </div>
    </div>
</div>
<!------------------------------------------- End List   -------------------------------------->

@stop


@section('javascript')



@endsection
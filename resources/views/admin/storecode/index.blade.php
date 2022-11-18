@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="box   box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">Checking Completed @lang('global.app_list')</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-flat btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped {{ count($to_chk_lists) > 0 ? 'datatable' : '' }}">
            <thead>
                <tr>
                    <th>@lang('global.tocheck.fields.no')</th>
                    <th>@lang('global.tocheck.fields.po_no')</th>
                    <th>@lang('global.tocheck.fields.po_date')</th>
                    <th>@lang('global.tocheck.fields.do_no')</th>
                    <th>@lang('global.tocheck.fields.do_date')</th>
                    <th>@lang('global.tocheck.fields.supplier')</th>
                    <th>@lang('global.tocheck.fields.remark')</th>
                    <th>@lang('global.tocheck.fields.status')</th>
                </tr>
            </thead>
                
            <tbody>
                @if (count($to_chk_lists) > 0)
                    @foreach ($to_chk_lists as $key=>$to_chk_list)
                        <tr data-entry-id="{{ $to_chk_list->id }}">
                            <td>
                                {{ $key+1 }}
                            </td>
                            <td>{{ $to_chk_list->po_no }}</td>
                            <td>{{ $to_chk_list->po_date }}</td>
                                <td><a href="{{ route('admin.store-code.item-details',['check'=>$to_chk_list->id]) }}">{{ $to_chk_list->do_no }}</a></td>
                            <td>{{ $to_chk_list->do_date }}</td>
                            <td>{{ $to_chk_list->supplier }}</td>
                            <td>{{ $to_chk_list->remark }}</td>
                            <td>
                                <a href="{{ URL::to('admin/printGR/' . $to_chk_list->id ) }}"  id="btnPrint{{$to_chk_list->id}}" class="btn btn-flatPrint"><span class="label label-info label-many"><i class="fa fa-print"></i> Print GR</span></a>
                            </td>
                        </tr>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                        <script src="http://www.position-absolute.com/creation/print/jquery.printPage.js"></script>
                        <script>
                            $(document).ready(function(){
                                $("#btnPrint{{$to_chk_list->id}}").printPage();
                            });
                        </script>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">@lang('global.app_no_entries_in_table')</td>
                    </tr>
                @endif
            </tbody>
        </table>
</div>
    </div>
</div>


@stop

@section('javascript') 
  
@endsection
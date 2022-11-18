@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="box   box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">@lang('global.app_list')</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-flat btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
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
                    @if($to_chk_list->checker == 0)
                    <td><a href="{{ route('admin.tocheck.item-details',['check'=>$to_chk_list->id]) }}" class="btn btn-flat btn-success">{{ $to_chk_list->do_no }}</a></td>
                    @else
                    <td><a href="{{ route('admin.tocheck.checker-comfirm',['check'=>$to_chk_list->id]) }}" class="btn btn-flat btn-primary">{{ $to_chk_list->do_no }}</a></td>
                    @endif
                    <td>{{ $to_chk_list->do_date }}</td>
                    <td>{{ $to_chk_list->supplier }}</td>
                    <td>{{ $to_chk_list->remark }}</td>
                    <td>
                        @if($to_chk_list->checker == 0)
                        <span class="label label-info label-many">Pending</span>
                        @elseif($to_chk_list->checker == 1 && $to_chk_list->approved_level_2 == 0)
                        <span class="label label-warning label-many">Approved</span>
                        @elseif($to_chk_list->checker == 1 && $to_chk_list->approved_level_2 == 1)
                        <span class="label label-success label-many">Approved</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="8">@lang('global.app_no_entries_in_table')</td>
                </tr>
                @endif
            </tbody>
        </table>

    </div>
</div>


@stop

@section('javascript')
@endsection
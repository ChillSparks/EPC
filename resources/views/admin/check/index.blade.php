@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<!-- <h3 class="page-title">@lang('global.checking.title')</h3> -->
<div class="box box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">Purchase Order Contract @lang('global.app_list')</h3>
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
          <table class="table table-bordered table-striped {{ count($contracts) > 0 ? 'datatable' : '' }}">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>@lang('global.checking.fields.po_no')</th>
                    <th>@lang('global.checking.fields.po_date')</th>
                    <th>@lang('global.checking.fields.do_no')</th>
                    <th>@lang('global.checking.fields.do_date')</th>
                    <th>@lang('global.checking.fields.status')</th>
                </tr>
            </thead>
                
            <tbody>
                @if (count($contracts) > 0)
                    @foreach ($contracts as $key=>$contract)
                        <tr data-entry-id="{{ $contract->id }}">
                            <td>{{$key+1}}</td>
                            <td>{{ $contract->po_no }}</td>
                            <td>{{ $contract->po_date }}</td>
                            <td>{{ $contract->do_no }}</td>
                            <td>{{ $contract->do_date }}</td>
                            <td>
                                {!! Form::open(['route'=> 'admin.check.formlist','method' => 'GET']) !!}
                                {!! Form::hidden('id', $contract->id, ['class' => 'form-control']) !!}
                                {!! Form::submit('Checking Form', ['class' => 'btn btn-xs btn-info']) !!}
                                {!! Form::close() !!}                              
                            </td>
                        </tr>
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


@stop


@section('javascript') 
    <script>

        $(document).ready(function(){
            $("#btnPrint").printPage();
        });  
    </script>
@endsection
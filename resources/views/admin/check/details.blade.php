@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
{!! Form::open(['method' => 'POST']) !!}
<div class="box box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">Check Form Details</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row"> 
            <div class="col-md-12">           
                @if (count($chk_lists) > 0)
                    @foreach ($chk_lists as $chk_list)
                    <div class="col-xs-4 form-group">    
                        {!! Form::label('po_no', 'PO Contract NO *', ['class' => 'control-label']) !!}
                        {!! Form::text('po_no',$chk_list->po_no, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                    </div>
                    <div class="col-xs-4 form-group">    
                        {!! Form::label('po_date', 'PO Contract Date *', ['class' => 'control-label']) !!}
                        {!! Form::text('po_date',$chk_list->po_date, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                    </div>
                    <div class="col-xs-4 form-group">    
                        {!! Form::label('s_name', 'Supplier Name *', ['class' => 'control-label']) !!}
                        {!! Form::text('s_name',$chk_list->supplier_name, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                    </div> 
                    <div class="col-xs-4 form-group">    
                        {!! Form::label('po_no', 'DO Item NO *', ['class' => 'control-label']) !!}
                        {!! Form::text('po_no',$chk_list->do_no, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                    </div>
                    <div class="col-xs-4 form-group">    
                        {!! Form::label('po_no', 'DO Item Date *', ['class' => 'control-label']) !!}
                        {!! Form::text('po_no',$chk_list->do_date, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                    </div>  
                    <div class="col-xs-4 form-group">
                        {!! Form::label('vehicle_name', 'Vehicle Name', ['class' => 'control-label']) !!}
                        {!! Form::text('vehicle_name',$chk_list->vehicle_name, ['id'=>'v_name','disabled','class' => 'form-control']) !!}    
                    </div>
                    <div class="col-xs-4 form-group">    
                        {!! Form::label('chk_place', 'Checking Place *', ['class' => 'control-label']) !!}
                        {!! Form::text('chk_place',$chk_list->chk_place, ['id'=>'chk_place','disabled','class' => 'form-control']) !!}
                    </div>
                    <div class="col-xs-4 form-group">    
                        {!! Form::label('chk_date', 'Checking Date *', ['class' => 'control-label']) !!}
                        {!! Form::text('chk_date',$chk_list->chk_date, ['id'=>'chk_date','disabled','class' => 'form-control']) !!}
                    </div> 
                    <div class="col-xs-4 form-group">    
                        {!! Form::label('chk_remark', 'Remark', ['class' => 'control-label']) !!}
                        {!! Form::text('chk_remark',$chk_list->chk_remark, ['id'=>'chk_remark','disabled','class' => 'form-control']) !!}
                    </div>                                                
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                        {{ $errors->first('name') }}
                        </p>
                    @endif
                    @endforeach
                @endif
            </div>
            <div class="col-md-12">
                <div class="panel-body table-responsive">
                @isset($chk_details)
                <table class="table table-bordered table-striped {{ count($chk_details) > 0 ? 'datatable' : '' }}">
                        <thead>
                            <tr>
                                <th>@lang('global.do_item.fields.no')</th>
                                <th>@lang('global.do_item.fields.item_name')</th>
                                <th>@lang('global.do_item.fields.unit')</th>
                                <th>@lang('global.do_item.fields.qty')</th>
                                <th>@lang('global.do_item.fields.price')</th>
                                <th>@lang('global.do_item.fields.amt')</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            @if (count($chk_details) > 0)
                                @foreach ($chk_details as $key=>$chk_detail)
                                    <tr data-entry-id="{{ $chk_detail->id }}">
                                            <td style="text-align: center;">{{$key + 1}}</td>
                                            <td>{{ $chk_detail->item_name }}</td>
                                            <td>{{ $chk_detail->unit }}</td>
                                            <td>{{ $chk_detail->qty }}</td>
                                            <td>{{ $chk_detail->price }}</td>
                                            <td>{{ $chk_detail->amt }}</td>
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
        </div>
    </div>
    
    <div class="modal-footer">
            <a class="btn btn-flat btn-danger" href="{{ URL::previous() }}"><i class="fa fa-reply-all"></i> Back</a>
    </div>
    {!! Form::close() !!}
</div>

<!------------------------------------------- End Add modal  ------------------------------------ -->

@stop


@section('javascript') 

@endsection
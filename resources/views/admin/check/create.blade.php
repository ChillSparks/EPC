@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
{!! Form::open(['method' => 'POST', 'route' => ['admin.check.store'],'id'=>'createForm']) !!}
<div class="box box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">Create Check Form</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row"> 
            <div class="col-md-12">           
                @if (count($contracts) > 0)
                    @foreach ($contracts as $contract)
                    <div class="col-xs-4 form-group">    
                        {!! Form::label('po_no', 'PO Contract NO *', ['class' => 'control-label']) !!}
                        {!! Form::hidden('po_id',$contract->id,['id' => 'contract_id']) !!}
                        {!! Form::text('po_no',$contract->po_no, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                    </div>
                    <div class="col-xs-4 form-group">    
                        {!! Form::label('po_date', 'PO Contract Date *', ['class' => 'control-label']) !!}
                        {!! Form::text('po_date',$contract->po_date, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                    </div>
                    <div class="col-xs-4 form-group">    
                        {!! Form::label('s_name', 'Supplier Name *', ['class' => 'control-label']) !!}
                        {!! Form::text('s_name',$contract->supplier_name, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                    </div> 
                    <div class="col-xs-4 form-group">    
                        {!! Form::label('po_no', 'DO Item NO *', ['class' => 'control-label']) !!}
                        {!! Form::text('po_no',$contract->do_no, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                    </div>
                    <div class="col-xs-4 form-group">    
                        {!! Form::label('po_no', 'DO Item Date *', ['class' => 'control-label']) !!}
                        {!! Form::text('po_no',$contract->do_date, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                    </div>  
                    <div class="col-xs-4 form-group">
                        {!! Form::label('vehicle_name', 'Vehicle Name', ['class' => 'control-label']) !!}
                        {!! Form::text('vehicle_name',old('vehicle_name'), ['id'=>'v_name','class' => 'form-control']) !!}    
                    </div>
                    <div class="col-xs-4 form-group">    
                        {!! Form::label('chk_place', 'Checking Place *', ['class' => 'control-label']) !!}
                        {!! Form::text('chk_place',old('chk_place'), ['id'=>'chk_place','class' => 'form-control']) !!}
                        <p class="danger">{!! $errors->update->first('chk_place') !!}
                    </div>
                    <div class="col-xs-4 form-group">    
                        {!! Form::label('chk_date', 'Checking Date *', ['class' => 'control-label']) !!}
                        {!! Form::text('chk_date',old('chk_date',date('Y-m-d')), ['id'=>'chk_date','class' => 'form-control']) !!}
                    </div> 
                    <div class="col-xs-4 form-group">    
                        {!! Form::label('chk_remark', 'Remark', ['class' => 'control-label']) !!}
                        {!! Form::text('chk_remark',old('chk_remark'), ['id'=>'chk_remark','class' => 'form-control']) !!}
                    </div> 
                    <input type="hidden" name="dt_data" value="">                                               
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
                @isset($item_details)
                <table class="table table-bordered table-striped {{ count($item_details) > 0 ? 'datatable' : '' }} dt-select">
                        <thead>
                            <tr>
                                <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                                <th>@lang('global.do_item.fields.no')</th>
                                <th>@lang('global.do_item.fields.item_name')</th>
                                <th>@lang('global.do_item.fields.unit')</th>
                                <th>@lang('global.do_item.fields.qty')</th>
                                <th>Left Quantity</th>
                                <th>Received Quantity</th>
                                <th>@lang('global.do_item.fields.price')</th>
                                <th>@lang('global.do_item.fields.amt')</th>
                            </tr>
                        </thead>
                        
                        <tbody>    
                            @if(count($item_details) > 0)
                                @foreach ($item_details as $key=>$item_detail)
                                    <tr data-entry-id="{{ $item_detail->id }}">
                                        <td></td>
                                        <td style="text-align: center;">{{$key + 1}}</td>
                                        <td>{{ $item_detail->item_name }}</td>
                                        <td>{{ $item_detail->unit }}</td>
                                        <td>{{ $item_detail->qty }}</td>
                                        <td>{{ $item_detail->l_qty }}</td>
                                        <td>{!! Form::number('received_qty',$item_detail->l_qty , ['id'=>'received_qty','class' => 'form-control']) !!}</td>
                                        <td>{{ $item_detail->price }}</td>
                                        <td>{{ $item_detail->amt }}</td>
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
        <a class="btn btn-danger" id="parameter" href=''><i class="fa fa-times"></i> Cancel</a>
        {!! Form::button(' <i class="fa fa-save"></i>  Save', ['type'=>'submit','class' => 'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
</div>

<!------------------------------------------- End Add modal  ------------------------------------ -->

@stop


@section('javascript') 
<script>
    jQuery(document).ready(function() {
        jQuery('form#createForm').on('submit', function() {
            // e.preventDefault();
            var table = $('.datatable').DataTable();
            var rowData = table.rows('.selected').data()[0];
            var dtData = [];
            $('.datatable tbody tr.selected').each(function() {
                var id = $(this).data('entry-id');
                var received_qty = $(this).find("input[name=received_qty]").val();
                dtData.push({
                    'id': id,
                    'r_qty': received_qty
                });
            });
            dtData = JSON.stringify(dtData);
            $('input[name=dt_data').val(dtData);
        });
    });
</script>
@endsection
@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('content')
<h3 class="page-title">@lang('global.po_contract.title')</h3>
{!! Form::model($contracts, ['method' => 'PUT', 'route' => ['admin.pocontract.update', $contracts->id]]) !!}
    <div class="box box-success">
        <!--.box-header -->
        <div class="box-header with-border">
            <h3 class="box-title">@lang('global.app_create')</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin.division.index') }}">
                    <i class="fa fa-reply-all fa_custom fa-2x"></i>
                </a>
                <button type="button" class="btn btn-flat btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12 form-group">
              {!! Form::label('po_no', 'PO Contract NO*', ['class' => 'control-label']) !!}
              {!! Form::text('po_no', old('po_no'), ['class' => 'form-control','disabled', 'placeholder' => '', 'required' => '']) !!}
            </div>
            <div class="panel-body table-responsive">
            <table id="dynamicTable" class="table table-bordered table-striped dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('global.po_contract.fields.po_no')</th>
                        <th>@lang('global.po_contract.fields.po_date')</th>
                        <th>@lang('global.po_contract.fields.supplier')</th>
                        <th>@lang('global.po_contract.fields.do_no')</th>
                        <th>@lang('global.po_contract.fields.do_date')</th>
                        <th>@lang('global.po_contract.fields.remark')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                <tr data-entry-id="">
                    <td></td>
                    <td><input type="text" name="addmore[0][name]" placeholder="Enter your Name" class="form-control" /></td>  
                    <td><input type="text" name="addmore[0][qty]" placeholder="Enter your Qty" class="form-control" /></td> 
                    <td><input type="text" name="addmore[0][name]" placeholder="Enter your Name" class="form-control" /></td>  
                    <td><input type="text" name="addmore[0][qty]" placeholder="Enter your Qty" class="form-control" /></td>   
                    <td><input type="text" name="addmore[0][price]" placeholder="Enter your Price" class="form-control" /></td> 
                    <td><input type="text" name="addmore[0][price]" placeholder="Enter your Price" class="form-control" /></td>
                    <td><button type="button" id="add" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i></button></td>
                </tr>
                </tbody>
            </table>
        </div>
            <p class="help-block"></p>
              @if($errors->has('name'))
                <p class="help-block">
                  {{ $errors->first('name') }}
                </p>
              @endif
            <div class="col-xs-12 form-group">
              {!! Form::button(' <i class="fa fa-save"></i>  '.trans('global.app_save'), ['type'=>'submit','class' => 'btn btn-success']) !!}
                <a class="btn btn-flat btn-danger " href="{{ route('admin.pocontract.index') }}"><i class="fa fa-reply-all"></i> Cancel</a>
              {!! Form::close() !!}
            </div>
            </div>
        </div>
    </div>
@stop
@section('javascript') 
<script>
  //Date picker
  $('#datepicker1').datepicker({
    autoclose: true
  })
  $('#datepicker2').datepicker({
    autoclose: true
  })

      var i = 0;
       $("#add").click(function(){
           ++i;
           $("#dynamicTable").append('<tr><td></td><td><input type="text" name="addmore['+i+'][name]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="addmore['+i+'][name]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="addmore['+i+'][name]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="addmore['+i+'][name]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="addmore['+i+'][qty]" placeholder="Enter your Qty" class="form-control" /></td><td><input type="text" name="addmore['+i+'][price]" placeholder="Enter your Price" class="form-control" /></td><td><button type="button" class="btn btn-flat btn-danger remove-tr"><i class="fa fa-close"></i></button></td></tr>');
       });
       $(document).on('click', '.remove-tr', function(){  
            $(this).parents('tr').remove();
       });  
</script>
@endsection

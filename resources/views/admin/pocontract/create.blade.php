@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('content')
<!-- <h3 class="page-title">@lang('global.po_contract.title')</h3> -->
{!! Form::open(['method' => 'POST', 'route' => ['admin.pocontract.store']]) !!}
<div class="box   box-success">
  <!--.box-header -->
  <div class="box-header with-border">
    <h3 class="box-title">@lang('global.app_create') PO Contract</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-xs-12 form-group">
        <div class="col-xs-4 form-group">
          {!! Form::label('po_no', 'PO Contract NO *', ['class' => 'control-label']) !!}
          {!! Form::text('po_no', old('po_no'), ['class' => 'form-control', 'placeholder' => '']) !!}
          <p class="danger">{{ $errors->update->first('po_no') }}</p>
        </div>
        <div class="col-xs-4 form-group">
          {!! Form::label('po_date', 'PO Contract Date *', ['class' => 'control-label']) !!}
          {!! Form::text('po_date',old('po_date',date('Y-m-d')) , ['id'=>'datepicker1','class' => 'form-control','placeholder' => '' ]) !!}
          <p class="danger">{{ $errors->update->first('po_date') }}</p>
        </div>
        <div class="col-xs-4 form-group">
          {!! Form::label('supplier_id', 'Supplier Name *', ['class' => 'control-label']) !!}
          {!! Form::select('supplier_id', $suppliers, null, ['id'=>'select-drop','class' => 'form-control']) !!}
        </div>
      </div>
      <div class="col-xs-12 form-group">
        <div class="col-xs-4 form-group">
          {!! Form::label('do_no', 'DO NO *', ['class' => 'control-label']) !!}
          {!! Form::text('do_no', old('do_no'), ['class' => 'form-control', 'placeholder' => '' ]) !!}
          <p class="danger">{{ $errors->update->first('do_no') }}</p>
        </div>
        <div class="col-xs-4 form-group">
          {!! Form::label('do_date', 'DO Date *', ['class' => 'control-label']) !!}
          {!! Form::text('do_date', old('do_date',date('Y-m-d')), ['id'=>'datepicker2','class' => 'form-control', 'placeholder' => '' ]) !!}
          <p class="danger">{{ $errors->update->first('do_date') }}</p>
        </div>
        <div class="col-xs-4 form-group">
          {!! Form::label('remark', 'Remark *', ['class' => 'control-label']) !!}
          {!! Form::text('remark', old('remark'), ['class' => 'form-control', 'placeholder' => '' ]) !!}

        </div>
      </div>
      <div class="col-xs-12 form-group">
        {!! Form::button(' <i class="fa fa-save"></i> '.trans('global.app_save'), ['type'=>'submit','class' => 'btn btn-success']) !!}
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
  $(function() {
    $("#datepicker1").datepicker();
    $("#datepicker1").datepicker("option", "dateFormat", "yy-mm-dd");
    $("#datepicker1").datepicker("option", "maxDate", "+100y");
    $("#datepicker1").datepicker("option", "minDate", "-10y");
    $("#datepicker1").datepicker("option", "changeMonth", true);
    $("#datepicker1").datepicker("option", "changeYear", true);
    $("#datepicker1").datepicker("setDate", new Date());

    $("#datepicker2").datepicker();
    $("#datepicker2").datepicker("option", "dateFormat", "yy-mm-dd");
    $("#datepicker2").datepicker("option", "maxDate", "+100y");
    $("#datepicker2").datepicker("option", "minDate", "-10y");
    $("#datepicker2").datepicker("option", "changeMonth", true);
    $("#datepicker2").datepicker("option", "changeYear", true);
    $("#datepicker2").datepicker("setDate", new Date());
  });

</script>
@endsection
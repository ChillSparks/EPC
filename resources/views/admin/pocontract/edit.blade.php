@extends('layouts.app')
@section('content')
<!-- <h3 class="page-title">@lang('global.pocontracts.title')</h3> -->

{!! Form::model($contracts, ['method' => 'PUT', 'route' => ['admin.pocontract.update', $contracts->id]]) !!}
<div class="box   box-success">
  <!--.box-header -->
  <div class="box-header with-border">
    <h3 class="box-title">PO Contract @lang('global.app_edit')</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-xs-12">
        <div class="col-xs-4 form-group">
          {!! Form::label('po_no', 'PO Contract NO*', ['class' => 'control-label']) !!}
          {!! Form::text('po_no', old('po_no'), ['class' => 'form-control', 'placeholder' => '']) !!}
          <p class="danger">{{ $errors->update->first('po_no') }}</p>
        </div>
        <div class="col-xs-4 form-group">
          {!! Form::label('po_date', 'PO Contract Date*', ['class' => 'control-label']) !!}
          {!! Form::text('po_date',old('po_date',date('Y-m-d')) , ['id'=>'datepicker1','class' => 'form-control','placeholder' => '']) !!}
          <p class="danger">{{ $errors->update->first('po_date') }}</p>
        </div>
        <div class="col-xs-4 form-group">
          {!! Form::label('supplier_id', 'Supplier Name*', ['class' => 'control-label']) !!}
          {!! Form::select('supplier_id', $suppliers, null, ['id'=>'select-drop','class' => 'form-control']) !!}
        </div>
      </div>
      <div class="col-xs-12">
        <div class="col-xs-4 form-group">
          {!! Form::label('do_no', 'DO NO*', ['class' => 'control-label']) !!}
          {!! Form::text('do_no', old('do_no'), ['class' => 'form-control', 'placeholder' => '']) !!}
          <p class="danger">{{ $errors->update->first('do_no') }}</p>
        </div>
        <div class="col-xs-4 form-group">
          {!! Form::label('do_date', 'DO Date*', ['class' => 'control-label']) !!}
          {!! Form::text('do_date', old('do_date',date('Y-m-d')), ['id'=>'datepicker2','class' => 'form-control', 'placeholder' => '']) !!}
          <p class="danger">{{ $errors->update->first('do_date') }}</p>
        </div>
        <div class="col-xs-4 form-group">
          {!! Form::label('remark', 'Remark*', ['class' => 'control-label']) !!}
          {!! Form::text('remark', old('remark'), ['class' => 'form-control', 'placeholder' => '']) !!}
        </div>
      </div>
      
      <div class="col-xs-12 form-group">
        {!! Form::button(' <i class="fa fa-refresh"></i> '.trans('global.app_update'), ['type'=>'submit','class' => 'btn btn-success']) !!}
        <a class="btn btn-flat btn-danger " href="{{ route('admin.pocontract.index') }}"><i class="fa fa-reply-all"></i> Cancel</a>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@stop
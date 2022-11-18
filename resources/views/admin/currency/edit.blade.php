@extends('layouts.app')
@section('content')
<!-- <h3 class="page-title">@lang('global.pocontracts.title')</h3> -->

{!! Form::model($currency, ['method' => 'PUT', 'route' => ['admin.currency.update', $currency->id]]) !!}
<div class="box   box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">Currency Edit</h3>
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-xs-6 form-group">
                {!! Form::label('po_no', 'Name', ['class' => 'control-label']) !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="danger">{{ $errors->update->first('name') }}</p>
            </div>
            <div class="col-xs-6 form-group">
                {!! Form::label('des', 'Description', ['class' => 'control-label']) !!}
                {!! Form::text('des',old('des') , ['class' => 'form-control','placeholder' => '']) !!}
                <p class="danger">{{ $errors->update->first('des') }}</p>
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
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.division.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.division.store']]) !!}
    <div class="box   box-success">
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
                    {!! Form::label('name', 'Division Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="danger">{{ $errors->update->first('name') }}</p>

                    {!! Form::label('des', 'Description*', ['class' => 'control-label']) !!}
                    {!! Form::text('des', old('des'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="danger">{{ $errors->update->first('des') }}</p>

                    {!! Form::button(' <i class="fa fa-save"></i>  '.trans('global.app_save'), ['type'=>'submit','class' => 'btn btn-success']) !!}
                    <a class="btn btn-flat btn-danger " href="{{ route('admin.division.index') }}"><i class="fa fa-reply-all"></i> Cancel</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop


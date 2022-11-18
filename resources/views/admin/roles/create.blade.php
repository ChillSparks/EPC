@extends('layouts.app')

@section('content')
<h3 class="page-title">@lang('global.roles.title')</h3>
{!! Form::open(['method' => 'POST', 'route' => ['admin.roles.store']]) !!}
<div class="box   box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">@lang('global.app_create') Role</h3>
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '','required'=> '']) !!}
                    <p class="danger">{{ $errors->update->first('name') }}</p>
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('permission', 'Permissions', ['class' => 'control-label']) !!}
                    {!! Form::select('permission[]', $permissions, old('permission'), ['class' => 'form-control select2', 'multiple' => 'multiple','required'=> '']) !!}
                    <p class="danger">{{ $errors->update->first('permission') }}</p>
                </div>
            </div>
            <div class="col-xs-12 form-group">
                {!! Form::button(' <i class="fa fa-save"></i> '.trans('global.app_save'), ['type'=>'submit','class' => 'btn btn-success']) !!}
                <a class="btn btn-flat btn-danger " href="{{ route('admin.roles.index') }}"><i class="fa fa-reply-all"></i> Cancel</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
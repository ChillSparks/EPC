@extends('layouts.app')
@section('content')
{!! Form::model($user, ['method' => 'PUT', 'route' => ['admin.users.update', $user->id]]) !!}
<div class="box   box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">@lang('global.app_edit') User</h3>
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
                    {!! Form::label('email', 'Email*', ['class' => 'control-label']) !!}
                    {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => '','required'=> '']) !!}
                    <p class="danger">{{ $errors->update->first('email') }}</p>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="col-xs-6 form-group">
                    {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="danger">{{ $errors->update->first('password') }}</p>
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('roles', 'Roles*', ['class' => 'control-label']) !!}
                    {!! Form::select('roles[]', $roles, old('roles') ? old('roles') : $user->roles()->pluck('name', 'name'), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
                    <p class="danger">{{ $errors->update->first('roles') }}</p>
                </div>
            </div>
            <div class="col-xs-12 form-group">
                {!! Form::button(' <i class="fa fa-refresh"></i> '.trans('global.app_update'), ['type'=>'submit','class' => 'btn btn-success']) !!}
                <a class="btn btn-flat btn-danger " href="{{ route('admin.roles.index') }}"><i class="fa fa-reply-all"></i> Cancel</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
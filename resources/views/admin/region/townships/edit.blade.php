@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.township.title')</h3>
    
    {!! Form::model($townships, ['method' => 'PUT', 'route' => ['admin.township.update', $townships->id]]) !!}
    <div class="box   box-success">
        <!--.box-header -->
        <div class="box-header with-border">
            <h3 class="box-title"> @lang('global.app_edit')</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin.township.index') }}">
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
                    {!! Form::label('division_id', 'State/Division Name*', ['class' => 'control-label']) !!}
                    {!! Form::select('division_id', $divisions, null, ['id'=>'select-drop','class' => 'form-control']) !!}
                    {!! Form::label('name', 'Township Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    {!! Form::label('des', 'Description*', ['class' => 'control-label']) !!}
                    {!! Form::text('des', old('des'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('name'))
                            <p class="help-block">
                                {{ $errors->first('name') }}
                            </p>
                            @endif
                    {!! Form::button(' <i class="fa fa-refresh"></i>  '.trans('global.app_update'), ['type'=>'submit','class' => 'btn btn-success']) !!}
                    <a class="btn btn-flat btn-danger " href="{{ route('admin.division.index') }}"><i class="fa fa-reply-all"></i> Cancel</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        </div>
    </div>
@stop        

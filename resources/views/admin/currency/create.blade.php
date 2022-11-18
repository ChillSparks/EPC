@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="box   box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">Currency</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-flat btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
        {!! Form::open(['method' => 'POST', 'route' => ['admin.currency.store']]) !!}
            <div class="col-xs-6 form-group">
            {!! Form::label('currency', 'Name', ['class' => 'control-label']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!} 
            <p class="danger">{{ $errors->update->first('name') }}</p>   
            </div>
            <div class="col-xs-6 form-group">
            {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
            {!! Form::text('des', old('des'), ['class' => 'form-control', 'placeholder' => '']) !!} 
            <p class="danger">{{ $errors->update->first('des') }}</p>   
            </div>
            <div class="col-xs-12 form-group">
            {!! Form::button(' <i class="fa fa-save"></i> '.trans('global.app_save'), ['type'=>'submit','class' => 'btn btn-success']) !!}
            <a class="btn btn-flat btn-danger " href="{{ route('admin.currency.index') }}"><i class="fa fa-reply-all"></i> Cancel</a>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@stop

@section('javascript')
<script>

</script>
@endsection
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
        <div class="box-body table-responsive">
            <p style="text-align:right">
                <a href="{{ route('admin.currency.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> @lang('global.app_add_new') Currency</a>
            </p>
            
            <table class="table table-bordered table-striped {{ count($currency) > 0 ? 'datatable' : '' }} dt-select"> 
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('global.currency.fields.name')</th>
                        <th>@lang('global.currency.fields.des')</th>
                        <th>@lang('global.currency.fields.created_by')</th>
                        <th>@lang('global.currency.fields.updated_by')</th>
                        <th>@lang('global.currency.fields.created_date')</th>
                        <th>@lang('global.currency.fields.updated_date')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($currency) > 0)
                    @foreach ($currency as $cur)
                    <tr>
                        <td></td>
                        <td>{{$cur->name}}</td>
                        <td>{{$cur->des}}</td>
                        <td>{{$cur->created_by}}</td>
                        <td>{{$cur->updated_by}}</td>
                        <td>{{$cur->created_at}}</td>
                        <td>{{$cur->updated_at}}</td>
                    <td>
                    <a href="{{ route('admin.currency.edit',[$cur->id]) }}" class="btn btn-flat btn-xs btn-info"><i class="fa fa-edit"></i> @lang('global.app_edit')</a>
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                        'route' => ['admin.currency.destroy', $cur->id])) !!}
                        {!! Form::button('<i class="fa fa-trash"></i> '.trans('global.app_delete'), array('type'=>'submit','class' => 'btn btn-xs btn-danger btn-flat')) !!}
                        {!! Form::close() !!}
                    </td>

                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="3">@lang('global.app_no_entries_in_table')</td>
                </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop

@section('javascript')
<script>

</script>
@endsection
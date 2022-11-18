@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- List Of Divisions -->
            <div class="box   box-success">
                <!--.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('global.app_list') Of State/Division</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-flat btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <p style="text-align:right">
                        <a href="{{ route('admin.division.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> @lang('global.app_add_new') State/Division</a>
                    </p>
                    <table class="table table-bordered table-striped {{ count($divisions) > 0 ? 'datatable' : '' }} dt-select">
                        <thead>
                            <tr>
                                <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                                <th>@lang('global.division.fields.name')</th>
                                <th>@lang('global.division.fields.des')</th>
                                <th>@lang('global.division.fields.created_date')</th>
                                <th>@lang('global.division.fields.updated_date')</th>
                                <th>&nbsp;</th>

                            </tr>
                        </thead>

                        <tbody>
                            @if (count($divisions) > 0)
                            @foreach ($divisions as $division)
                            <tr data-entry-id="{{ $division->id }}">
                                <td></td>
                                <td>{{ $division->name }}</td>
                                <td>{{ $division->des }}</td>
                                <td>{{ $division->created_at }}</td>
                                <td>{{ $division->updated_at }}</td>
                                <td>
                                    <a href="{{ route('admin.division.edit',[$division->id]) }}" class="btn btn-flat btn-xs btn-info"><i class="fa fa-edit"></i>  @lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                    'route' => ['admin.division.destroy', $division->id])) !!}
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
        <!-- right column -->
        <div class="col-md-12">
            <!-- List of Townships -->
            <div class="box   box-success">
                <!--.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('global.app_list') Of Township</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-flat btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <p style="text-align:right">
                        <a href="{{ route('admin.township.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> @lang('global.app_add_new') Township</a>
                    </p>
                    <table class="table table-bordered table-striped {{ count($townships) > 0 ? 'datatable' : '' }} dt-select">
                        <thead>
                            <tr>
                                <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                                <th>@lang('global.division.fields.name')</th>
                                <th>@lang('global.township.fields.name')</th>
                                <th>@lang('global.township.fields.des')</th>
                                <th>@lang('global.township.fields.created_date')</th>
                                <th>@lang('global.township.fields.updated_date')</th>
                                <th>&nbsp;</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (count($townships) > 0)
                            @foreach ($townships as $township)
                            <tr data-entry-id="{{ $township->id }}">
                                <td></td>
                                <td>{{ $township->division_name }}</td>
                                <td>{{ $township->name }}</td>
                                <td>{{ $township->des }}</td>
                                <td>{{ $township->created_at }}</td>
                                <td>{{ $township->updated_at }}</td>
                                <td>
                                    <a href="{{ route('admin.township.edit',[$township->id]) }}" class="btn btn-flat btn-xs btn-info"><i class="fa fa-edit"></i> @lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                    'route' => ['admin.township.destroy', $township->id])) !!}
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
    </div>
</section>


@stop

@section('javascript')
<script>
    window.route_mass_crud_entries_destroy = '{{ route("division.mass_destroy") }}';
    window.route_mass_crud_entries_destroy = '{{ route("township.mass_destroy") }}';
</script>
@endsection
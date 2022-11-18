@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('content')
<style>
    .modal-dialog {
        width: 900px;
    }
</style>
<!-- <h3 class="page-title">@lang('global.do_item.title')</h3>   -->
<div class="col-md-12">
    <div class="box box-success">
        <!--.box-header -->
        <div class="box-header with-border">
            <h3 class="box-title">@lang('global.app_list') Of Items</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-flat btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-xs-12 form-group">
                        {!! Form::label('po_no', 'PO DO Item NO*', ['class' => 'control-label']) !!}
                        {!! Form::text('po_no', $po_no, ['class' => 'form-control','disabled', 'placeholder' => '' ]) !!}
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="col-xs-4 form-group">
                        <button type="button" class="btn btn-flat btn-success" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus" aria-hidden="true"></i> @lang('global.app_add_new') Item
                        </button>
                        <a class="btn btn-flat btn-danger " href="{{ URL::previous() }}"><i class="fa fa-reply-all"></i> Cancel</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel-body table-responsive">
                        @isset($doItems)
                        <table class="table table-bordered table-striped {{ count($doItems) > 0 ? 'datatable' : '' }}">
                            <thead>
                                <tr>
                                    <th>@lang('global.do_item.fields.no')</th>
                                    <th>@lang('global.do_item.fields.action')</th>
                                    <th style="width:30%;">@lang('global.do_item.fields.item_name')</th>
                                    <th>@lang('global.do_item.fields.unit')</th>
                                    <th>@lang('global.do_item.fields.qty')</th>
                                    <th>@lang('global.do_item.fields.price')</th>
                                    <th>@lang('global.do_item.fields.amt')</th>
                                    <th>@lang('global.do_item.fields.brand')</th>
                                    <th>@lang('global.do_item.fields.mfg_country')</th>
                                    <th>@lang('global.do_item.fields.mfg_company')</th>
                                    <th>@lang('global.do_item.fields.mfg_date')</th>
                                    <th>@lang('global.do_item.fields.manual')</th>

                                </tr>
                            </thead>

                            <tbody>
                                @if (count($doItems) > 0)
                                @foreach ($doItems as $key=>$doItem)
                                <tr data-entry-id="{{ $doItem->id }}">
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <a href="{{route('admin.doitems.edit',[$doItem->id])}}" data-toggle="modal" data-target="#editModal{{$doItem->id}}" class="btn btn-flat btn-xs btn-info"><i class="fa fa-edit"></i>&nbsp; @lang('global.app_edit') &nbsp;</a>
                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.doitems.destroy', $doItem->id])) !!}
                                        {!! Form::button('<i class="fa fa-trash"></i> '.trans('global.app_delete'), array('type'=>'submit','class' => 'btn btn-xs btn-danger btn-flat')) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>{{ $doItem->item_name }}</td>
                                    <td>{{ $doItem->unit }}</td>
                                    <td>{{ $doItem->qty }}</td>
                                    <td>{{ $doItem->price }} {{$doItem->currency}}</td>
                                    <td>{{ $doItem->amt }}</td>
                                    <td>{{ $doItem->brand }}</td>
                                    <td>{{ $doItem->mfg_country }}</td>
                                    <td>{{ $doItem->mfg_company }}</td>
                                    <td>{{ $doItem->mfg_date }}</td>
                                    <td>{{ $doItem->manual_orignal_filename }}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="12">@lang('global.app_no_entries_in_table')</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="box box-success">
                <!--.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('global.app_create') Items</h3>
                    <div class="box-tools pull-right">
                        <button type="button" data-dismiss="modal" class="btn btn-flat btn-box-tool"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['id'=>'doForm','method' => 'POST','files' => true]) !!}
                            <div class="col-xs-12 form-group">
                                {!! Form::label('po_no', 'PO doItem NO*', ['class' => 'control-label']) !!}
                                {!! Form::text('po_no', $po_no, ['class' => 'form-control','disabled', 'placeholder' => '' ]) !!}
                            </div>
                            <!-- Item List   -->
                            <div class="col-md-12 transparent">
                                <div class="col-xs-4 form-group">
                                    {!! Form::label('item_name', 'Item Name *', ['class' => 'control-label']) !!}
                                    {!! Form::hidden('po_id', $id) !!}
                                    {!! Form::text('item_name', old('item_name'), ['class' => 'form-control','placeholder' => '' ]) !!}
                                </div>
                                <div class="col-xs-4 form-group">
                                    {!! Form::label('unit', 'Unit *', ['class' => 'control-label']) !!}
                                    {!! Form::select('unit', $units, null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-xs-4 form-group">
                                    {!! Form::label('qty', 'Quantity *', ['class' => 'control-label']) !!}
                                    {!! Form::text('qty', old('qty'), ['class' => 'form-control','placeholder' => '' ]) !!}
                                </div>
                                <div class="col-xs-4 form-group danger" id="item_name_error"></div>
                                <div class="col-xs-4 form-group danger" id="unit_error"></div>
                                <div class="col-xs-4 form-group danger" id="qty_error"></div>
                                <div class="col-xs-4 form-group">
                                    {!! Form::label('price', 'Price *', ['class' => 'control-label ']) !!}
                                    <div class="row" style="margin-left:0px;">
                                        <div class="col-md-6" style="width:164px;padding-right:4px;padding-left:0px;">
                                            {!! Form::text('price',old('price'), ['class' => 'form-control','placeholder' => '' ]) !!}
                                        </div>
                                        <div class="col-xs-4" style="padding:0px;">
                                            <select class='form-control' name="cur">
                                                @if(isset($currency))
                                                @foreach($currency as $var)
                                                <option>{{$var->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4 form-group">
                                    {!! Form::label('brand', 'Brand *', ['class' => 'control-label']) !!}
                                    {!! Form::text('brand', old('brand'), ['class' => 'form-control','placeholder' => '' ]) !!}
                                </div>
                                <div class="col-xs-4 form-group">
                                    {!! Form::label('mfg_country', 'MFG Country*', ['class' => 'control-label']) !!}
                                    {!! Form::text('mfg_country', old('mfg_country'), ['class' => 'form-control','placeholder' => '' ]) !!}
                                </div>
                                <div class="col-xs-12 form-group danger" id="price_error"></div>
                                <div class="col-xs-4 form-group">
                                    {!! Form::label('mfg_company', 'MFG Company*', ['class' => 'control-label']) !!}
                                    {!! Form::text('mfg_company', old('mfg_company'), ['class' => 'form-control','placeholder' => '' ]) !!}
                                </div>
                                <div class="col-xs-4 form-group">
                                    {!! Form::label('mfg_date', 'MFG Date *', ['class' => 'control-label']) !!}
                                    {!! Form::text('mfg_date', old('mfg_date',date('Y-m-d')), ['id'=>'datepicker1','class' => 'form-control','placeholder' => '' ]) !!}
                                </div>
                                <div class="col-xs-4 form-group">
                                    {!! Form::label('manual', 'Manual *', ['class' => 'control-label']) !!}
                                    {!! Form::file('manual', old('manual'), ['class' => 'form-control','placeholder' => '' ]) !!}
                                </div>
                                <p class="help-block"></p>
                                @if($errors->has('item_name'))
                                <p class="help-block">
                                    {{ $errors->first('item_name') }}
                                </p>
                                @endif
                                <div class="col-xs-12 form-group">
                                    {!! Form::button(' <i class="fa fa-save"></i> '.trans('global.app_save'), ['id'=>'btn-submit','type'=>'submit','class' => 'btn btn-success']) !!}
                                    <a class="btn btn-flat btn-danger " href="{{ URL::previous() }}"><i class="fa fa-reply-all"></i> Cancel</a>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Modal End -->

<!-- Edit Modal -->
@foreach ($doItems as $key=>$doItem)
<div class="modal fade" id="editModal{{$doItem->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="box   box-success">
            <!--.box-header -->
            <div class="box-header with-border">
                <h3 class="box-title">@lang('global.app_edit') Items</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-flat btn-box-tool" data-dismiss="modal"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['id'=>'editForm','files' => true]) !!}
                        <div class="col-xs-12 form-group">
                            {!! Form::label('po_no', 'PO doItem NO*', ['class' => 'control-label']) !!}
                            {!! Form::text('po_no', $po_no, ['class' => 'form-control','disabled', 'placeholder' => '' ]) !!}
                        </div>
                        <!-- Item List   -->
                        <div class="col-md-12">
                            <div class="col-xs-4 form-group">
                                {!! Form::label('item_name', 'Item Name *', ['class' => 'control-label']) !!}
                                {!! Form::hidden('po_id', $id) !!}
                                {!! Form::hidden('do_id', $doItem->id) !!}
                                {!! Form::text('item_name', $doItem->item_name, ['class' => 'form-control','placeholder' => '' ]) !!}
                            </div>
                            <div class="col-xs-4 form-group">
                                {!! Form::label('unit', 'Unit *', ['class' => 'control-label']) !!}
                                {!! Form::select('unit', $units, null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-xs-4 form-group">
                                {!! Form::label('qty', 'Quantity *', ['class' => 'control-label']) !!}
                                {!! Form::text('qty',$doItem->qty, ['class' => 'form-control','placeholder' => '' ]) !!}
                            </div>
                            <div class="col-xs-4 danger" id="item_name_edit_error"></div>
                            <div class="col-xs-4 danger" id="unit_edit_error"></div>
                            <div class="col-xs-4 danger" id="qty_edit_error"></div>
                            <div class="col-xs-4 form-group">
                                {!! Form::label('price', 'Price *', ['class' => 'control-label']) !!}
                                {!! Form::text('price',$doItem->price, ['class' => 'form-control','placeholder' => '' ]) !!}
                            </div>
                            <div class="col-xs-4 form-group">
                                {!! Form::label('brand', 'Brand *', ['class' => 'control-label']) !!}
                                {!! Form::text('brand', $doItem->brand, ['class' => 'form-control','placeholder' => '' ]) !!}
                            </div>
                            <div class="col-xs-4 form-group">
                                {!! Form::label('mfg_country', 'MFG Country*', ['class' => 'control-label']) !!}
                                {!! Form::text('mfg_country', $doItem->mfg_country, ['class' => 'form-control','placeholder' => '' ]) !!}
                            </div>
                            <div class="col-xs-12 form-group danger" id="price_edit_error"></div>
                            <div class="col-xs-4 form-group">
                                {!! Form::label('mfg_company', 'MFG Company*', ['class' => 'control-label']) !!}
                                {!! Form::text('mfg_company', $doItem->mfg_company, ['class' => 'form-control','placeholder' => '' ]) !!}
                            </div>
                            <div class="col-xs-4 form-group">
                                {!! Form::label('mfg_date', 'MFG Date *', ['class' => 'control-label']) !!}
                                {!! Form::text('mfg_date', $doItem->mfg_date, ['id'=>'datepicker1','class' => 'form-control','placeholder' => '' ]) !!}
                            </div>
                            <div class="col-xs-4 form-group">
                                {!! Form::label('manual', 'Manual *', ['class' => 'control-label']) !!}
                                {!! Form::file('manual', old('manual'), ['class' => 'form-control','placeholder' => '' ]) !!}
                            </div>
                            <div class="col-xs-12 form-group">
                                {!! Form::button(' <i class="fa fa-save"></i> '.trans('global.app_update'), ['id'=>'btn-submit','type'=>'submit','class' => 'btn btn-success']) !!}
                                <a class="btn btn-flat btn-danger " href="{{ URL::previous() }}"><i class="fa fa-reply-all"></i> Cancel</a>
                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>

</script>
@endforeach

</div>

@stop
@section('javascript')
<script>
    jQuery(document).ready(function() {
        jQuery('form#doForm').on('submit', function(e) {
            $("p").remove("#msg");
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData($('form#doForm')[0]);
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: "{{ route('admin.doitems.store') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.success) {
                        $('form#doForm').trigger("reset");
                        $('#exampleModal').modal('hide');
                        location.reload();
                    } else if (data.errors) {
                        error = data.errors;
                        $.each(error, function(k, v) {
                            $('#' + k + "_error").append("<p id='msg'>" + v + "</p>");
                        });
                    }
                },
                error: function(response) {
                    console.log(response);
                },
            });
        });
        jQuery('form#editForm').on('submit', function(e) {
            $("p").remove("#msg");
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData($('form#editForm')[0]);
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: "{{ route('admin.doitems.update') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.success) {
                        $('form#editForm').trigger("reset");
                        $('#editModal').modal('hide');
                        location.reload();
                    } else if (data.errors) {
                        error = data.errors;
                        $.each(error, function(k, v) {
                            $('#' + k + "_edit_error").append("<p id='msg'>" + v + "</p>");
                        });
                    }
                },
                error: function(response) {
                    console.log(response);
                },
            });
        });
    });
</script>
@endsection
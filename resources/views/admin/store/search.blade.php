@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('content')
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Horizontal Form</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal">
        {!! Form::open(['method' => 'get','id'=>'searchForm'])!!}
        <div class="box-body">
            <div class="col-md-6 form-group">
                <label for="search_target" class="col-sm-4 control-label">Search Target</label>
                <div class="col-md-8">
                    {!! Form::select('search_target', $columns, null, ['id'=>'search_target','required'=> '','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6 form-group">
                <label for="search_val" class="col-sm-4 control-label">Search Value</label>
                <div class="col-sm-8">
                    {!! Form::text('search_val', '', ['id'=>'search_val','class' => 'form-control','placeholder' => '']) !!}
                </div>
            </div>
            <div class="col-md-6 form-group">
                <label for="from_date" class="col-sm-4 control-label">From Date</label>
                <div class="col-md-8">
                    {!! Form::text('from_date','', ['id'=>'from_date','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6 form-group">
                <label for="to_date" class="col-sm-4 control-label">To Date</label>
                <div class="col-md-8">
                    {!! Form::text('to_date','', ['id'=>'to_date','class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                {!! Form::button(' <i class="fa fa-search"></i> Search', ['type'=>'submit','class' => 'btn btn-success btn-flat']) !!}
                <a class="btn btn-flat btn-danger" href="{{ route('admin.store.search') }}"><i class="fa fa-times"></i> Cancel</a>
                <a class="btn btn-flat btn-info" href="{{ route('admin.store.search') }}"><i class="fa fa-download" aria-hidden="true"></i> Export </a>
            </div>
            <div class="col-md-4"></div>

        </div>
        {!! Form::close()!!}
        <!-- /.box-footer -->
    </form>
</div>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Stock Search Result</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-flat btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-flat btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body table-responsive">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>@lang('global.do_item.fields.no')</th>
                        <th>Stock Code</th>
                        <th>WareHouse</th>
                        <th>@lang('global.do_item.fields.item_name')</th>
                        <th>@lang('global.do_item.fields.unit')</th>
                        <th>@lang('global.do_item.fields.price')</th>
                        <th>@lang('global.do_item.fields.qty')</th>
                        <th>@lang('global.do_item.fields.amt')</th>
                        <th>@lang('global.do_item.fields.brand')</th>
                        <th>@lang('global.do_item.fields.mfg_country')</th>
                        <th>@lang('global.do_item.fields.mfg_company')</th>
                        <th>@lang('global.do_item.fields.mfg_date')</th>
                        <th>Created Date</th>
                        <th>Updated Date</th>
                    </tr>
                </thead>
                <tbody id="data">
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
    </div>
    <!-- /.box-footer-->
</div>
<!-- /.box -->
<!-- <h3 class="page-title">@lang('global.do_item.title')</h3>   -->

@stop
@section('javascript')
<script>
    $(function() {
        $("#from_date").datepicker({
            defaultDate: "+1w",
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            numberOfMonths: 2,
            onClose: function(selectedDate) {
                $("#to_date").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#to_date").datepicker({
            defaultDate: "+1w",
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            numberOfMonths: 2,
            onClose: function(selectedDate) {
                $("#from_date").datepicker("option", "maxDate", selectedDate);
            }
        });
    });

    jQuery(document).ready(function() {
        performSearch();

        function performSearch() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var search_target = $("#search_target option:selected").text();
            var search_value = $('#search_val').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            $.ajax({
                type: 'get',
                dataType: "json",
                url: "{{ route('admin.store.searchResult') }}",
                data: {
                    search_target: search_target,
                    search_value: search_value,
                    frm_date: from_date,
                    to_date: to_date
                },
                success: function(response) {
                    $.each(response.data, function(key, value) {
                        var $tr = $('<tr></tr>');
                        $tr.append("<td >" + (key + 1) + "</td>");
                        $tr.append("<td >" + value.store_code + "</td>");
                        $tr.append("<td >" + value.warehouse + "</td>");
                        $tr.append("<td >" + value.item_name + "</td>");
                        $tr.append("<td >" + value.unit + "</td>");
                        $tr.append("<td >" + value.price + "</td>");
                        $tr.append("<td >" + value.qty + "</td>");
                        $tr.append("<td >" + value.amt + "</td>");
                        $tr.append("<td >" + value.brand + "</td>");
                        $tr.append("<td >" + value.mfg_country + "</td>");
                        $tr.append("<td >" + value.mfg_company + "</td>");
                        $tr.append("<td >" + value.mfg_date + "</td>");
                        $tr.append("<td >" + value.created_at + "</td>");
                        $tr.append("<td >" + value.updated_at + "</td>");
                        $("#data").append($tr);
                    })
                },
                error: function(response) {
                    console.log(response);
                },
            });
        }
        $("form#searchForm").on('submit', function() {
            performSearch();
        });
    });
</script>
@endsection
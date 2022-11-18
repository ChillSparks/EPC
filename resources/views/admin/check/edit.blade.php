@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
{!! Form::open(['method' => 'POST', 'route' => ['admin.check.update'],'id'=>'editForm']) !!}
<div class="box box-success">
    <!--.box-header -->
    <div class="box-header with-border">
        <h3 class="box-title">Edit Check Form</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                @if (count($chk_lists) > 0)
                @foreach ($chk_lists as $chk_list)
                <div class="col-xs-4 form-group">
                    {!! Form::label('po_no', 'PO Contract NO *', ['class' => 'control-label']) !!}
                    {!! Form::hidden('po_id',$chk_list->po_id,['id' => 'contract_id']) !!}
                    {!! Form::text('po_no',$chk_list->po_no, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('po_date', 'PO Contract Date *', ['class' => 'control-label']) !!}
                    {!! Form::text('po_date',$chk_list->po_date, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('s_name', 'Supplier Name *', ['class' => 'control-label']) !!}
                    {!! Form::text('s_name',$chk_list->supplier_name, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('po_no', 'DO Item NO *', ['class' => 'control-label']) !!}
                    {!! Form::text('po_no',$chk_list->do_no, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('po_no', 'DO Item Date *', ['class' => 'control-label']) !!}
                    {!! Form::text('po_no',$chk_list->do_date, ['class' => 'form-control', 'disabled', 'required' => '']) !!}
                </div>

                <div class="col-xs-4 form-group">
                    {!! Form::label('vehicle_name', 'Vehicle Name', ['class' => 'control-label']) !!}
                    {!! Form::text('vehicle_name',$chk_list->vehicle_name, ['id'=>'v_name','class' => 'form-control']) !!}
                </div>
                <div class="col-xs-4 form-group">

                    {!! Form::label('chk_place', 'Checking Place *', ['class' => 'control-label']) !!}
                    {!! Form::text('chk_place',$chk_list->chk_place, ['id'=>'chk_place','class' => 'form-control']) !!}
                    <input type="hidden" value="{{$chk_list->received_id}}" name="po_received_id">
                    <p class="danger">{!! $errors->update->first('chk_place') !!}
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('chk_date', 'Checking Date *', ['class' => 'control-label']) !!}
                    {!! Form::text('chk_date',old('chk_date',date('Y-m-d')), ['id'=>'chk_date','class' => 'form-control']) !!}
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('chk_remark', 'Remark', ['class' => 'control-label']) !!}
                    {!! Form::text('chk_remark',$chk_list->chk_remark, ['id'=>'chk_remark','class' => 'form-control']) !!}
                </div>

                <p class="help-block"></p>
                @if($errors->has('name'))
                <p class="help-block">
                    {{ $errors->first('name') }}
                </p>
                @endif
                @endforeach
                @endif
            </div>
            <div class="col-md-12">
                <div class="panel-body table-responsive">
                    @isset($chk_details)
                    <table class="table table-bordered table-striped {{ count($chk_details) > 0 ? 'datatable' : '' }} dt-select">
                        <thead>
                            <tr>
                                <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                                <th>@lang('global.do_item.fields.no')</th>
                                <th>@lang('global.do_item.fields.item_name')</th>
                                <th>@lang('global.do_item.fields.unit')</th>
                                <th>@lang('global.do_item.fields.qty')</th>
                                <th>@lang('global.do_item.fields.price')</th>
                                <th>@lang('global.do_item.fields.amt')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (count($chk_details) > 0)
                            @foreach ($chk_details as $key=>$chk_detail)
                            @if($chk_detail->received_flag== 1)
                            <tr data-entry-id="{{ $chk_detail->id }}" class="selected">
                                <td></td>
                                <td style="text-align: center;">{{$key + 1}}</td>
                                <td>{{ $chk_detail->item_name }}</td>
                                <td>{{ $chk_detail->unit }}</td>
                                <td>{{ $chk_detail->qty }}</td>
                                <td>{{ $chk_detail->price }}</td>
                                <td>{{ $chk_detail->amt }}</td>
                            </tr>
                            @elseif($chk_detail->received_flag== 0)
                            <tr data-entry-id="{{ $chk_detail->id }}">
                                <td></td>
                                <td style="text-align: center;">{{$key + 1}}</td>
                                <td>{{ $chk_detail->item_name }}</td>
                                <td>{{ $chk_detail->unit }}</td>
                                <td>{{ $chk_detail->qty }}</td>
                                <td>{{ $chk_detail->price }}</td>
                                <td>{{ $chk_detail->amt }}</td>
                            </tr>
                            @endif
                            @endforeach
                            @else
                            <tr>
                                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                    @endisset
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a class="btn btn-flat btn-danger" id="parameter" href=''><i class="fa fa-times"></i> Cancel</a>
        {!! Form::button(' <i class="fa fa-save"></i> Update', ['type'=>'submit','class' => 'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
</div>

<!------------------------------------------- End Add modal  ------------------------------------ -->

@stop


@section('javascript')
<script>
    jQuery(document).ready(function() {
        jQuery('form#editForm').on('submit', function(e) {
            var dtData = [];
            $('.datatable tbody tr.selected').each(function() {
                dtData.push($(this).data('entry-id'));
            });
            $(this).append("<input type='hidden' name='dtData'" + "' value=' " + dtData + " '/><br/>");
        });
    });
</script>
@endsection
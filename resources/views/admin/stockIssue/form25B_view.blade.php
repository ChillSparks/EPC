<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>  
      .table{
            width:680px;
            font-size:14px;
        }
        .table2{
            width:680px;
            font-size:14px;
        }
        .height2{
            height:606px;
            position:absolute;
            top:236px;
        }
        .height3{
            height:198px;
            position:absolute;
            top:842px;
        }
        #page{
            font-family: "Pyitaungsu";
            box-sizing: border-box;
            width:730px;
            height: 1068px;
            padding-left: 30px;
            padding-top:6px;
            position: relative;
        }
        .table>tbody>tr>td{
            padding-top:0px;
            padding-left:3px;
            padding-right:3px;
            padding-bottom:3px;
            vertical-align: middle;
            height:40px;
            overflow: hidden;
            border:1px solid black;
        }
        .table2>tbody>tr>td{
            padding-top:0px;
            padding-left:3px;
            padding-right:3px;
            padding-bottom:3px;
            vertical-align: middle;
            height:24px;
            overflow: hidden;
        }
        .left{
            text-align: left;
        }
        .right{

            text-align: right;
        }
        .center{
            text-align:center;
        }
        .table.no-border tr td, .table.no-border tr th {
        border-width: 0;
        }
        .mw{
            width:110px;
        }
        .ud{
            margin-left:100px;
            position:absolute;
            top:100px;
        }
        .bt{
            border-top:1px solid black;
        }
        .bl{
            border-left:1px solid black;
        }
        .br{
            border-right:1px solid black;
        }
        .bb{
            border-bottom:1px solid black;
        }
        p{
            padding-top: 8px;
            margin-bottom: 0px;
            padding-right:10px;
        }
        .sw{
            width:30px;
        }
        .hw{
            width:60px;
        }
        .cw{
            width:140px;
        }
        .uw{
            width:240px;
        }
        .pw{
            width:80px;
        }
        .pd{
            padding-right:0px;
        }
        .voucher_no{
            top:110px;
            left:210px;
            position:absolute;
        }
        .workstation{
            top:135px;
            left:190px;
            position:absolute;
        }
        .issue_no{
            top:27px;
            left:610px;
            position:absolute;
        }
        .issue_date{
            top:57px;
            left:610px;
            position:absolute;
        }
        .reason{
            top:175px;
            left:40px;
            position:absolute;
        }
    </style>
</head>
<body>
@php
    $stock_details = $printData['stock_details'];
    $stock_issues = $printData['stock_issues'];
    $number_of_stock_details = $stock_details->count();
    $number_of_printed_reports = 0;
    $number_of_items_per_report = 10;
    $number_of_items_in_last_report = 0;
    $total=0;
    @endphp

    @if($number_of_stock_details % $number_of_items_per_report == 0)
            @php
            $number_of_printed_reports = floor($number_of_stock_details / $number_of_items_per_report);
            @endphp
    @elseif($number_of_stock_details % $number_of_items_per_report < 0) 
            @php $number_of_printed_reports=floor($number_of_stock_details / $number_of_items_per_report); 
            $number_of_items_in_last_report=$number_of_stock_details; 
            @endphp 
    @elseif($number_of_stock_details % $number_of_items_per_report> 0)
            @php
                $number_of_printed_reports = floor($number_of_stock_details / $number_of_items_per_report);
                $number_of_items_in_last_report = $number_of_stock_details - ($number_of_items_per_report * $number_of_printed_reports);
                $number_of_printed_reports++;
            @endphp
    @endif
<div class="container">
@for($i = 0; $i < $number_of_printed_reports; $i++) 
    <div class="row" id="page">
    @foreach($stock_issues as $stock_issue)
    <p class="issue_no">{!! $stock_issue->issue_no !!}</p>
    <p class="issue_date">{!! $stock_issue->issue_date !!}</p>
    <p class="voucher_no">{!! $stock_issue->req_voucher_no !!}</p>
    <textarea class="workstation" style="line-height:235%;width:375px;border:none;overflow:hidden;resize:none;height:100px;z-index:-1;">{!! $stock_issue->l_no.'/'.$stock_issue->to_dept.'/'.$stock_issue->remark.'/'.$stock_issue->reason !!}</textarea>
    <textarea class="reason" style="font-weight:bold;word-break:break-all;width:120px;border:none;overflow:hidden;resize:none;height:42px;z-index:-1;">{!! $stock_issue->reason !!}</textarea>
        <table class="table2">
            <tr rowspan="3"><td class="bl bt br mw"></td><td class="mw bt" colspan="2">လျှပ်စစ်ပုံစံ-၂၅(ခ)</td><td class="center bt" colspan="3" style="font-size:16px;font-weight:bold;">လျှပ်စစ်ဓာတ်အားဖြန့်ဖြူးရေးလုပ်ငန်း</td><td class="bt"></td><td class="right cw br bt">မူရင်း</td></tr>
            <tr><td class="bl br"></td><td colspan="2"></td><td class="center" colspan="3">ရုံးချုပ် ၊ ပစ္စည်းစီမံရေးဌာန</td><td class="right sw">အမှတ်</td><td class="right br"><p>-----------------------</p></td></tr>
            <tr><td class="bl br bb"></td><td colspan="2"></td><td class="center" colspan="3" style="font-size:16px;font-weight:bold;">ပစ္စည်းထုတ်ပေးလွှာ</td><td class="right sw">နေ့စွဲ </td><td class="right br"><p>-----------------------</p></td></tr>
            <tr><td class="bl"></td><td colspan="2"></td><td class="center" colspan="3"></td><td> </td><td class="br"></td></tr>
            <tr><td colspan="2" class="left bl">ပစ္စည်းတောင်းခံလွှာအမှတ်</td><td colspan="5"><p>--------------------------------------------------------------------------</p></td><td class="center br bl bt bb">ရုံးအမှတ်</td></tr>
            <tr><td colspan="2" class="left bl">လုပ်ငန်းအမည်</td><td colspan="5"><p>--------------------------------------------------------------------------</p></td><td class="center br bl bb"></td></tr>
            <tr><td colspan="2" class="center bl"></td><td colspan="5"><p>--------------------------------------------------------------------------</p></td><td class="br"></td></tr>
            <tr><td colspan="2" class="center bl bb"></td><td colspan="5" class="bb"><p>--------------------------------------------------------------------------</p></td><td class="bb br"></td></tr>
        </table>
    @endforeach
        <table class="table height2">
            <tr class="center"><td>ပစ္စည်းကုဒ်</td><td colspan="2">ပစ္စည်းအမျိုးအမည်</td><td>‌ရေတွက်ပုံ</td><td>အရေအတွက်</td><td style="min-width:102px;">နှုန်း(ကျပ်)</td><td colspan="2" style="min-width:120px;">ငွေပေါင်း(ကျပ်)</td></tr>
            @if(($i+1) == $number_of_printed_reports && $number_of_items_in_last_report > 0)
                @for ($j = 1; $j <= $number_of_items_in_last_report; $j++) @php $getIndex=($j-1) + ($i * $number_of_items_per_report); @endphp
                <tr class="center">
                    <td>{{$stock_details[$getIndex]->stock_code}}</td>
                    @if(strlen($stock_details[$getIndex]->item_name)>22)
                        <td colspan="2" style="word-break:break-all;">{{ $stock_details[$getIndex]->item_name }}</td>
                    @else
                        <td colspan="2">{{ $stock_details[$getIndex]->item_name }}</td>
                    @endif
                    <td>{{$stock_details[$getIndex]->unit}}</td>
                    <td>{{$stock_details[$getIndex]->qty}}</td>
                    <td>{{ number_format($stock_details[$getIndex]->price,3) }}</td>
                    <td colspan="2">{{ number_format($stock_details[$getIndex]->amt,3) }}</td>
                </tr>   
                    @php
                        $total+=$stock_details[$getIndex]->amt;
                    @endphp
                @endfor
                @for ($j = 1; $j <= $number_of_items_per_report-$number_of_items_in_last_report; $j++) @php $getIndex=($j-1) + ($i * $number_of_items_per_report); @endphp 
                <tr class="center">
                    <td></td>
                    <td colspan="2"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2"></td>
                </tr> 
                @endfor
                @else
                    @for ($j = 1; $j <= $number_of_items_per_report; $j++) 
                        @php 
                            $getIndex=($j -1) + ($i * $number_of_items_per_report); 
                        @endphp  
                    <tr class="center">
                        <td>{{$stock_details[$getIndex]->stock_code}}</td>
                        @if(strlen($stock_details[$getIndex]->item_name)>22)
                            <td colspan="2" style="word-break:break-all;">{{ $stock_details[$getIndex]->item_name }}</td>
                        @else
                            <td colspan="2">{{ $stock_details[$getIndex]->item_name }}</td>
                        @endif
                        <td>{{$stock_details[$getIndex]->unit}}</td>
                        <td>{{$stock_details[$getIndex]->qty}}</td>
                        <td>{{ number_format($stock_details[$getIndex]->price,3) }}</td>
                        <td colspan="2">{{ number_format($stock_details[$getIndex]->amt,3) }}</td>
                        @php
                        $total+=$stock_details[$getIndex]->amt;
                        @endphp

                    </tr>  
                    @endfor
                @endif 

            <tr class="center"><td colspan="5" class="center" style="padding-right:10px;"> ({{$number_of_stock_details}} Items Only)</td><td>Total: </td><td>{{number_format($total,3)}}</td></tr>
        </table>
        <table class="table2 height3">
            <tr><td class="bt bl"></td><td colspan="2" class="bt mw"></td><td class="bt mw"></td><td class="right bt" colspan="2"></td><td colspan="2" class="center bt br cw"></td></tr>
            <tr><td class="bl"></td><td colspan="2"></td><td></td><td class="right" colspan="2"></td><td colspan="2" class="center br"></td></tr>
            <tr><td class="bl"></td><td colspan="2"></td><td></td><td class="right" colspan="2"></td><td colspan="2" class="center br"></td></tr>
            <tr><td class="bl pw">ခွင့်ပြုသူ</td><td colspan="3" class="pd left"><p>--------------------------------------------------</p></td><td class="right pw" colspan="2">ပစ္စည်းတောင်းခံသူ</td><td colspan="2" class="center br mw"><p>------------------------------------</p></td></tr>
            <tr><td class="bl mw" colspan="2">ပစ္စည်းထုတ်ပေးသူ</td><td colspan="2" class="pd left"><p>--------------------------------------</p></td><td class="right mw" colspan="2">ရာထူး</td><td colspan="2" class="center br mw"><p>------------------------------------</p></td></tr>
            <tr><td class="bl pd" colspan="3">ပစ္စည်းထုတ်ပေးသောဌာနစိတ်</td><td class="cw pd"><p>--------------------------</p></td><td colspan="5" class="right br">(ဤပစ္စည်းထုတ်ပေးလွှာကိုလုပ်ငန်းတစ်မျိုးထက်ပိုမသုံးရ)</td></tr>
            <tr class="center"><td colspan="8" class="bl bb br"></td></tr>

        </table>
    </div>

    @endfor
</div>

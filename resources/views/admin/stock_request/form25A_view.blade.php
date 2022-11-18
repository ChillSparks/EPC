<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;"/>
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>  
       .table{
            width:684px;
            margin-bottom: 0px;
            font-size:14px;
        }
        .table2{
            width:684px;
            margin-bottom: 0px;
            font-size:14px;
        }
        .height2{
            height:599px;
            position:absolute;
            top:266px;
        }
        .height3{
            height:198px;
            position:absolute;
            margin-bottom:50px;
            top:865px;
        }
        #page{
            font-family: "Pyitaungsu";
            box-sizing: border-box;
            width:730px;
            height: 1070px;
            padding-left: 29px;
            padding-top:6px;
            position: relative;
        }
        .left{
            float: left;
        }
        .right{

            text-align: right;
        }
        .center{
            text-align:center;
        }
        .sw{
            width:20px;
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
        .table.no-border tr td, .table.no-border tr th {
        border-width: 0;
        }
        .table>tbody>tr>td{
            padding-top:0px;
            padding-left:3px;
            padding-right:3px;
            padding-bottom:2px;
            vertical-align: middle;
            height:35px;
            overflow: hidden;
            border:1px solid black;
        }
        .table2>tbody>tr>td{
            padding-top:0px;
            padding-left:8px;
            padding-right:8px;
            padding-bottom:5px;
            vertical-align: middle;
            height:20px;
            overflow: hidden;
        }
        p{
            margin-top: 10px;
            margin-bottom: 0px;
            padding-right:10px;
        }
        .hw{
            width:250px;
        }
        .hw2{
            width:200px;
        }
        .mw{
            width:130px;
        }
        .cw{
            width:80px;
        }
        .nw{
            width:50px;
        }
        .workstation{
            top:110px;
            left:270px;
            position:absolute;
        }
        .reason{
            top:160px;
            left:70px;
            position:absolute;
        }
        .req_date{
            top:57px;
            left:610px;
            position:absolute;
        }
        .voucher_no{
            top:27px;
            left:610px;
            position:absolute;
        }
    </style>
</head>
<body>
<div class="container">
    @php
    $stock_details = $printData['stock_details'];
    $stock_requests = $printData['stock_requests'];
    $number_of_stock_details = $stock_details->count();
    $number_of_printed_reports = 0;
    $number_of_items_per_report = 10;
    $number_of_items_in_last_report = 0;
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
    @for($i = 0; $i < $number_of_printed_reports; $i++) 
    <div class="row" id="page">
        @foreach($stock_requests as $stock_request)
        <p class="req_date">{!! $stock_request->date !!}</p>
        <p class="voucher_no">{!! $stock_request->voucher_no !!}</p>
        <textarea class="workstation" style="line-height:250%;word-break:break-all;width:400px;border:none;overflow:hidden;resize:none;height:100px;z-index:-1;">{!! $stock_request->l_no.'/'.$stock_request->dept_biz_name.'/'.$stock_request->remark.'/'.$stock_request->reason !!}</textarea>
      
        <textarea class="reason" style="font-weight:bold;word-break:break-all;width:120px;border:none;overflow:hidden;resize:none;height:120px;z-index:-1;">{!! $stock_request->reason !!}</textarea>
        <table class="table2">
            <tr rowspan="3"><td class="bl bt"></td><td class="cw bt br"></td><td class="mw bt">လျှပ်စစ်ပုံစံ-၂၅(က)</td><td class="center bt" colspan="3">လျှပ်စစ်ဓာတ်အားဖြန့်ဖြူးရေးလုပ်ငန်း</td><td class="bt"></td><td class="center bt br">မူရင်း</td></tr>
            <tr><td class="bl"></td><td class="br"></td><td></td><td class="center" colspan="2">ရုံးချုပ်၊ပစ္စည်းစီမံရေးဌာန</td><td></td><td class="right">အမှတ်</td><td class="mw br right"><p>----------------------</p></td></tr>
            <tr><td class="bl bb"></td><td class="bb br"></td><td></td><td class="center" colspan="2">ပစ္စည်းတောင်းခံလွှာ</td><td></td><td class="right">နေ့စွဲ</td><td class="mw br right"><p>----------------------</p></td></tr>
            <tr><td class="bl"></td><td></td><td></td><td></td><td></td><td></td><td></td><td class="br"></td></tr>
            <tr><td class="bl center" colspan="3">လုပ်ငန်းအမည်နှင့်အမှတ်</td><td colspan="5" class="br" ><p>---------------------------------------------------------------------------------</p></td></tr>
            <tr><td class="bl" colspan="3"></td><td colspan="5" class="br"><p>---------------------------------------------------------------------------------</p></td></tr>
            <tr><td class="bl" colspan="3"></td><td colspan="5" class="br"><p>---------------------------------------------------------------------------------</p></td></tr>
            <tr><td colspan="2" class="bl"></td><td colspan="5" class="center" style="padding-left:100px;">အောက်ဖော်ပြပါစတိုပစ္စည်းများကိုထုတ်ပေးပါရန်</td><td colspan="2" class="br"></td></tr>
            <tr><td class="bl bb" colspan="2"></td><td colspan="5" class="center bb"></td><td colspan="2" class="br bb"></td></tr>
        </table>
        @endforeach
        <table class="table height2">
            <tr class="center"><td class="sw">စဉ်</td><td colspan="2" class="mw">ပစ္စည်းကုဒ်</td><td class="hw">ပစ္စည်းအမျိုးအမည်</td><td class="mw">‌ရေတွက်ပုံ</td><td colspan="3" class="mw">အရေအတွက်</td></tr>

         
            @if(($i+1) == $number_of_printed_reports && $number_of_items_in_last_report > 0)
                                @for ($j = 1; $j <= $number_of_items_in_last_report; $j++) @php $getIndex=($j-1) + ($i * $number_of_items_per_report); @endphp
                                    <tr>
                                    <td style="text-align:center;">{{$getIndex+1}}</td>
                                    <td style="text-align:center;" colspan="2">{{$stock_details[$getIndex]->stock_code}}</td>
                                    @if(strlen($stock_details[$getIndex]->item_name)>22)
                                        <td style="word-break:break-all;">{{ $stock_details[$getIndex]->item_name }}</td>
                                    @else
                                        <td>{{ $stock_details[$getIndex]->item_name }}</td>
                                    @endif
                                    <td style="text-align:center;">{{$stock_details[$getIndex]->unit}}</td>
                                    <td style="text-align:center;" colspan="3">{{$stock_details[$getIndex]->qty}}</td>
                                    </tr>
                                    
                                @endfor
                                @for ($j = 1; $j <= $number_of_items_per_report-$number_of_items_in_last_report; $j++) @php $getIndex=($j-1) + ($i * $number_of_items_per_report); @endphp 
                                    <tr>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;" colspan="2">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;" colspan="3">&nbsp;</td>
                                    </tr>
                                @endfor
                            @else
                                @for ($j = 1; $j <= $number_of_items_per_report; $j++) 
                                    @php 
                                        $getIndex=($j -1) + ($i * $number_of_items_per_report); 
                                    @endphp 
                                        <tr>
                                        <td style="text-align:center;">{{$getIndex+1}}</td>
                                        <td style="text-align:center;" colspan="2">{{$stock_details[$getIndex]->stock_code}}</td>
                                        @if(strlen($stock_details[$getIndex]->item_name)>22)
                                            <td style="word-break:break-all;">{{ $stock_details[$getIndex]->item_name }}</td>
                                        @else
                                            <td>{{ $stock_details[$getIndex]->item_name }}</td>
                                        @endif                                        <td style="text-align:center;">{{$stock_details[$getIndex]->unit}}</td>
                                        <td style="text-align:center;" colspan="3">{{$stock_details[$getIndex]->qty}}</td>
                                        </tr>
                                        
                                @endfor
                            @endif
                            <tr>
                                <td colspan="6" style="text-align:center;">({{$number_of_stock_details}} Items Only)</td>
                               
                            </tr>
           

        </table>
        <table class="table2 height3">
            <tr><td class="bt bl"></td><td colspan="2" class="bt"></td><td class="bt"></td><td class="right bt" colspan="2"></td><td colspan="2" class="center bt br"></td></tr>
            <tr><td class="bl"></td><td colspan="2"></td><td></td><td class="right" colspan="2"></td><td colspan="2" class="center br"></td></tr>
            <tr><td class="bl"></td><td colspan="2"></td><td></td><td class="right" colspan="2"></td><td colspan="2" class="center br"></td></tr>
            <tr><td class="cw bl">ခွင့်ပြုသူ</td><td colspan="2"><p>---------------------------------------</p></td><td></td><td colspan="3" class="right mw">ပစ္စည်းတောင်းခံသူ</td><td class="right br hw2"><p>-------------------------------------</p></td></tr>
            <tr><td class="cw bl">ရာထူး</td><td colspan="2"><p>---------------------------------------</p></td><td></td><td colspan="3" class="right mw">ရာထူး</td><td class="right br hw2"><p>-------------------------------------</p></td></tr>
            <tr class="center"><td colspan="8" class="bl br"></td></tr>
            <tr class="center"><td colspan="8" class="bl bb br">(ဤပစ္စည်းတောင်းခံလွှာကို လုပ်ငန်းတစ်မျိုးထက်ပိုမသုံးရ ။)</td></tr>
        </table>
    </div>
    @endfor
</div>

</body>

@section('javascript') 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="http://www.position-absolute.com/creation/print/jquery.printPage.js"></script>
    <script>
        $(document).ready(function(){
            $(".btnPrint").printPage();
        });
    </script>
@endsection

  
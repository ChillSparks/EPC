<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>  
        .table{
            width:678px;
            font-size:14px;
            margin-bottom: 0px;
          }
        .table2{
            width:680px;
            font-size:14px;
        }
        .table3{
            padding-top:8px;
            width:676px;
            font-size:14px;
            position:relative;

        }
        #page{
            font-family: "Pyitaungsu";
            box-sizing: border-box;
            width:730px;
            height: 1045px;
            padding-left: 41px;
            padding-top:6px;
            position: relative;
        }
        .height2{
            height:520px;
            top:150px;
            position:absolute;
        }
        .height3{
            top:665px;
            position:absolute;
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
        .hw{
            width:30%;
        }
        .table>tbody>tr>td{
            padding-top:0px;
            padding-left:4px;
            padding-right:4px;
            padding-bottom:3px;
            vertical-align: middle;
            height:24px;
            overflow: hidden;
        }
        .table2>tbody>tr>td{
            padding-top:0px;
            padding-left:4px;
            padding-right:4px;
            padding-bottom:3px;
            vertical-align: middle;
            height:24px;
            overflow: hidden;
        }
        .table3>tbody>tr>td{
            padding-top:0px;
            padding-left:4px;
            padding-right:4px;
            padding-bottom:3px;
            vertical-align: middle;
            height:24px;
            overflow: hidden;
            border:1px solid black;
        }
        .v1{
            position:absolute;
            margin-left:360px;
            top:96px;
        }
        .v2{
            position:absolute;
            margin-left:360px;
            top:128px;
        }
        .v3{
            position:absolute;
            margin-left:360px;
            top:190px;
        }
        .v4{
            position:absolute;
            margin-left:340px;
            top:233px;
        }
        .v5{
            position:absolute;
            margin-left:360px;
            top:260px;
        }
        .v6{
            position:absolute;
            margin-left:360px;
            top:288px;
        }
        .v7{
            position:absolute;
            margin-left:600px;
            top:293px;
        }
        .v8{
            position:absolute;
            margin-left:360px;
            top:392px;
        }
        .v9{
            position:absolute;
            margin-left:360px;
            top:425px;
        }
        .v10{
            position:absolute;
            margin-left:150px;
            top:65px;
        }
        .v11{
            position:absolute;
            margin-left:340px;
            top:455px;
        }
        .v12{
            position:absolute;
            margin-left:340px;
            top:490px;
        }
        .v13{
            position:absolute;
            margin-left:360px;
            top:558px;
        }
        .v14{
            position:absolute;
            margin-left:280px;
            top:588px;
        }
        .v99{
            position:absolute;
            margin-left:360px;
            top:348px;
        }
 
        p{
            margin-top: 10px;
            margin-bottom: 0px;
        }
        .sw{
            width:20px;
        }
        .mw{
            width:50px;
        }
        .hw2{
            width:80px;
        }
        .cw{
            width:190px;
        }
        span{
            padding-bottom:3px;border-bottom: 1.1px solid black;border-bottom-style:dashed;
            word-break:break-all;
        }

    </style>
</head>
<body>
@php
    $chk_details  =$printData['chk_details'];
    $chk_lists    =$printData['chk_lists'];

    $number_of_chk_items = $chk_details->count();
    $number_of_printed_reports = 0;
    $number_of_items_per_report = 10;
    $number_of_items_in_last_report = 0;
@endphp

@if ($number_of_chk_items % $number_of_items_per_report == 0)
            @php
            $number_of_printed_reports = floor($number_of_chk_items / $number_of_items_per_report);
            @endphp
        @elseif($number_of_chk_items % $number_of_items_per_report < 0) 
            @php $number_of_printed_reports=floor($number_of_chk_items / $number_of_items_per_report); 
            $number_of_items_in_last_report=$number_of_chk_items; 
            @endphp 
        @elseif($number_of_chk_items % $number_of_items_per_report> 0)
            @php
                $number_of_printed_reports = floor($number_of_chk_items / $number_of_items_per_report);
                $number_of_items_in_last_report = $number_of_chk_items - ($number_of_items_per_report * $number_of_printed_reports);
                $number_of_printed_reports++;
            @endphp
        @endif 



    <div class="row" id="page">
    <p class="v1">{!! $chk_lists[0]->chk_date !!}</p>
    <p class="v2">{!! $chk_lists[0]->chk_place !!}</p>

    @if(strlen($chk_lists[0]->po_no)>31)
    <p class="v3" style="line-height:235%;">{!! wordwrap($chk_lists[0]->po_no,31,"<br>",true) !!}&nbsp; Dt- &nbsp;{!!$chk_lists[0]->po_date !!}</p>
    @else
    <p class="v3">{!! $chk_lists[0]->po_no!!}&nbsp; Dt- &nbsp;{!!$chk_lists[0]->po_date !!}</p>
    @endif
    @if(strlen($chk_lists[0]->do_no)>31)
    <p class="v6" style="line-height:235%;">{!! wordwrap($chk_lists[0]->do_no,31,"<br>",true) !!} / {!! $chk_lists[0]->do_date !!}</p>
    @else
    <p class="v6">{!! $chk_lists[0]->do_no!!} Dt- {!! $chk_lists[0]->do_date !!}</p>
    @endif
    <p class="v5">{!! $chk_lists[0]->supplier_name !!}</p>
    <p class="v8">{!! $chk_lists[0]->net_amt !!}</p>
    <p class="v9">{!! $chk_lists[0]->rev_amt !!}</p>
    <p class="v13">{!! $chk_lists[0]->chk_box_no !!}</p>
    @if(strlen($chk_lists[0]->chk_remark)>40)
        <p class="v14" style="line-height:235%;">{!! wordwrap($chk_lists[0]->chk_remark,40,"<br>",true) !!}</p>
    @else
        <p class="v14">{!! $chk_lists[0]->chk_remark !!}</p>
    @endif
    <p class="v99">ပူးတွဲပါအသေးစိတ်စစ်ဆေးမှုစာရင်း(ပုံစံ-၁၆-ခ)</p>
        <table class='table no-border' id="tbl1">
                    <tr><td></td><td></td><td class="center" colspan="5">လျှပ်စစ်ဓာတ်အားဖြန့်ဖြူးရေးလုပ်ငန်း</td><td></td><td class="right">ပုံစံ(၁၆)</td></tr>
                    <tr><td></td><td></td><td class="center" colspan="5">ပစ္စည်းစီမံရေးဌာန</td><td colspan="2"></td></tr>
                    <tr><td></td><td></td><td class="center" colspan="5">ပစ္စည်းစစ်ဆေးရေးပုံစံ</td><td colspan="2"></td></tr>
                    <tr><td></td><td></td><td class="center" colspan="5"></td><td colspan="2"></td></tr>
       
                    <tr><td>(၁)</td><td colspan="3">စစ်ဆေးသည့်နေ့</td><td colspan="5"><p>----------------------------------------------------------------------</p></td></tr>
                    <tr><td>(၂)</td><td colspan="3">စစ်ဆေးသည့်နေရာ</td><td colspan="5"><p>----------------------------------------------------------------------</p></td></tr>
                    <tr><td>(၃)</td><td colspan="3">ရည်ညွန်းချက်</td><td colspan="5"><p>----------------------------------------------------------------------</p></td></tr>
                    
                    <tr><td></td><td colspan="3">(က)အမှာစာ/ကန်ထရိုက်စာချုပ်</td><td colspan="5"><p>----------------------------------------------------------------------</p></td></tr>
                    <tr><td></td><td colspan="3">အမှတ် - နေ့စွဲ</td><td colspan="5"><p>----------------------------------------------------------------------</p></td></tr>
                    <tr><td></td><td colspan="3">(ခ)ပစ္စည်းပေးသွင်းဌာန</td><td colspan="5"><p>----------------------------------------------------------------------</p></td></tr>
                    <tr><td></td><td colspan="3">(ဂ)ကုန်တင်စာရင်းအမှတ် ၊နေ့စွဲ</td><td colspan="5"><p>----------------------------------------------------------------------</p></td></tr>
                    <tr><td></td><td colspan="3"></td><td colspan="5"><p>----------------------------------------------------------------------</p></td></tr>
                    <tr><td>(၄)</td><td colspan="3">စစ်ဆေးသောပစ္စည်းအမျိုးအမည်</td><td colspan="5"><p>----------------------------------------------------------------------</p></td></tr>
                    <tr><td>(၅)</td><td colspan="3">စာရင်းပါပစ္စည်းအရေအတွက်</td><td colspan="5"><p>----------------------------------------------------------------------</p></td></tr>
                    <tr><td>(၆)</td><td colspan="3">လက်ခံရရှိသည့်ပစ္စည်းအရေအတွက်</td><td colspan="5"><p>----------------------------------------------------------------------</p></td></tr>
                    <tr><td>(၇)</td><td colspan="3">ပျက်သည့်ပစ္စည်းအရေအတွက်</td><td colspan="5"><p>----------------------------------------------------------------------</p></td></tr>
                    <tr><td>(၈)</td><td colspan="3">လျော့သည့်ပစ္စည်းအရေအတွက်</td><td colspan="5"><P>----------------------------------------------------------------------</p></td></tr>
                    <tr><td>(၉)</td><td colspan="3">ပိုသည့်ပစ္စည်းအရေအတွက်</td><td colspan="5"><P>----------------------------------------------------------------------</p></td></tr>
                    <tr><td>(၁၀)</td><td colspan="3">စစ်ဆေးသည့်သေတ္တာအမှတ်များ</td><td colspan="5"><p>----------------------------------------------------------------------</p></td></tr>
                    
                    <tr><td>(၁၁)</td><td>မှတ်ချက် <td>။</td><td colspan="6"> <p>---------------------------------------------------------------------------------------------</sub></td></tr>
                    <tr><td></td><td> <td></td><td colspan="6"><p>---------------------------------------------------------------------------------------------</p></td></tr>
                    <tr><td></td><td> <td></td><td colspan="6"></td></tr>
            
                <tr class="center"><td colspan="3" class="hw">ပစ္စည်းပေးသွင်းသူ</td><td colspan="3" class="hw">အရည်အသွေးစစ်ဆေးသူ</td><td colspan="3" class="hw">ပစ္စည်းလက်ခံသူ</td></tr>
        </table>
        <table class="table no-border">
                <tr class="center"><td colspan="3" class="hw"></td><td colspan="3" class="hw"></td><td colspan="3" class="hw"></td></tr>
                <tr class="center"><td colspan="3" class="hw"></td><td colspan="3" class="hw"></td><td colspan="3" class="hw"></td></tr>

                <tr><td>လက်မှတ်</td><td colspan="2"><p>------------------------------</p></td><td>လက်မှတ်</td><td colspan="2"><p>----------------------------</p></td><td>လက်မှတ်</td><td colspan="2"><p>------------------------------</p></td></tr>
                <tr><td>အမည်</td><td colspan="2"><p>------------------------------</p></td><td>အမည်</td><td colspan="2"><p>----------------------------</p></td><td>အမည်</td><td colspan="2"><p>------------------------------</p></td></tr>
                <tr><td>ရာထူး</td><td colspan="2"><p>------------------------------</p></td><td>ရာထူး</td><td colspan="2"><p>----------------------------</p></td><td>ရာထူး</td><td colspan="2"><p>------------------------------</p></td></tr>
                <tr><td>ကုမ္ပဏီ</td><td colspan="2"><p>------------------------------</p></td><td>ကုမ္ပဏီ</td><td colspan="2"><p>----------------------------</p></td><td>ကုမ္ပဏီ</td><td colspan="2"><p>------------------------------</p></td></tr>
                <tr><td></td><td colspan="2"></td><td></td><td colspan="2"></td><td></td><td colspan="2"></td></tr>

               
                <tr><td></td><td></td><td colspan="5" class="center">အထက်ပါစစ်ဆေးချက်အားအတည်ပြုပါသည်။</td><td></td><td></td></tr>
                <tr><td></td><td></td><td colspan="5" class="center"></td><td></td><td></td></tr>
                <tr><td></td><td></td><td colspan="5" class="center"></td><td></td><td></td></tr>
        
      
            <tr><td colspan="3" class="left">အထွေထွေမန်နေဂျာ</td><td colspan="3"></td><td></td><td colspan="2" class="right">အင်ဂျင်နီယာချုပ်</td></tr>
            <tr><td colspan="3" class="left">(ပစ္စည်းစီမံရေး)</td><td colspan="3"></td><td></td><td colspan="2" class="right">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td></tr>
            </table>
    </div>
    @for($i = 0; $i < $number_of_printed_reports; $i++)
    <div class="row" id="page">
        @foreach($chk_lists as $chk_list)
            <table class='table no-border'>
                <tr><td></td><td class="sw"></td><td class="hw2"></td><td colspan="3" class="center size">လျှပ်စစ်ဓာတ်အားဖြန့်ဖြူးရေးလုပ်ငန်း</td><td></td><td class="right cw">(ပုံစံ-၁၆-ခ)</td></tr>
                <tr><td></td><td></td><td></td><td colspan="3" class="center size">ပစ္စည်းစီမံရေးဌာန</td><td></td><td></td></tr>
                <tr><td></td><td></td><td></td><td colspan="3" class="center size">ရန်ကုန်မြို့</td><td></td><td></td></tr>
                <tr><td></td><td></td><td></td><td colspan="3" class="center size"></td><td></td><td></td></tr>
                @if(strlen($chk_lists[0]->po_no.$chk_lists[0]->supplier_name)>70)
                <tr><td colspan="2" class="mw size">Contract/PONO</td><td colspan="6" style="border-bottom:1px solid black;border-style:dashed;">{!! wordwrap($chk_lists[0]->po_no."   ".$chk_lists[0]->supplier_name,70,"<br>",true) !!}</td></tr>
                @else
                <tr style="height:45px;"><td colspan="2" class="mw size" style="padding-top:17px;">Contract/PONO</td><td colspan="6" style="border-bottom:1px solid black;border-style:dashed;padding-top:17px;">{!! $chk_lists[0]->po_no."   ".$chk_lists[0]->supplier_name !!}</td></tr>
                @endif
                </table>
<br>
            @endforeach
            <table class="table3 height2" id="tbl2">
                <tr class="center"><td  class="sw" rowspan="2">စဉ်</td><td colspan="2" rowspan="2" class="cw">ပစ္စည်းအမျိုးအမည်</td><td rowspan="2" class="mw">‌ရေတွက်ပုံ</td><td rowspan="2" class="hw2">အရေအတွက်</td><td colspan="2" class="">စံချိန်/စံညွှန်း အရည်အသွေး</td><td rowspan="2">မှတ်ချက်</td></tr>
                <tr class="center"><td>ကိုက်ညီ</td><td>မကိုက်ညီ</td></tr>
                @if(($i+1) == $number_of_printed_reports && $number_of_items_in_last_report > 0)
                                @for ($j = 1; $j <= $number_of_items_in_last_report; $j++) 
                                    @php 
                                        $getIndex=($j-1) + ($i * $number_of_items_per_report); 
                                    @endphp 
                                    <tr>
                                    <td style="text-align:center;">{{$getIndex+1}}</td>
                                    <td style="text-align:center;" colspan="2">{{$chk_details[$getIndex]->item_name}}</td>
                                    <td style="text-align:center;">{{$chk_details[$getIndex]->unit}}</td>
                                    <td style="text-align:center;">{{$chk_details[$getIndex]->qty}}</td>
                                    <td style="text-align:right;"></td>
                                    <td style="text-align:right;"></td>
                                    <td style="text-align:center;"></td>
                                    </tr>
                                    
                                @endfor
                                @for ($j = 1; $j <= $number_of_items_per_report-$number_of_items_in_last_report; $j++) @php $getIndex=($j-1) + ($i * $number_of_items_per_report); @endphp <tr>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;" colspan="2">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    </tr>
                                @endfor
                            @else
                                @for ($j = 1; $j <= $number_of_items_per_report; $j++) 
                                    @php 
                                        $getIndex=($j -1) + ($i * $number_of_items_per_report); 
                                    @endphp 
                                    <tr>
                                    <td style="text-align:center;">{{$getIndex+1}}</td>
                                    <td style="text-align:center;" colspan="2">{{$chk_details[$getIndex]->item_name}}</td>
                                    <td style="text-align:center;">{{$chk_details[$getIndex]->unit}}</td>
                                    <td style="text-align:center;">{{$chk_details[$getIndex]->qty}}</td>
                                    <td style="text-align:right;"></td>
                                    <td style="text-align:right;"></td>
                                    <td style="text-align:center;"></td>
                                    </tr>
                        @endfor
                    @endif
              
            </table>
            <table class="table2 no-border height3">
            <tr><td colspan="8" class="center"></td></tr>
                <tr class="center"><td colspan="3">ပစ္စည်းပေးသွင်းသူ</td> <td colspan="3">အရည်အသွေးစစ်ဆေးသူ</td><td colspan="2">ပစ္စည်းလက်ခံသူ</td></tr>
                <tr><td colspan="8" class="center"></td></tr>
                <tr><td colspan="8" class="center"></td></tr>
                <tr><td colspan="2">လက်မှတ်</td><td class="center"><p>-------------------------</p></td><td>လက်မှတ်</td><td colspan="2" class="center"><p>-------------------------</p></td><td>လက်မှတ်</td><td class="center"><p>-------------------------</p></td></tr>
                <tr><td colspan="2">အမည်</td><td class="center"><p>-------------------------</p></td><td>အမည်     </td><td colspan="2" class="center"><p>-------------------------</p></td><td>အမည်     </td><td class="center"><p>-------------------------</p></td></tr>
                <tr><td colspan="2">ရာထူး</td><td class="center"><p>-------------------------</p></td><td>ရာထူး     </td><td colspan="2" class="center"><p>-------------------------</p></td><td>ရာထူး     </td><td class="center"><p>-------------------------</p></td></tr>
                <tr><td colspan="2">ကုမ္ပဏီ</td><td class="center"><p>-------------------------</p></td><td>ကုမ္ပဏီ  </td><td colspan="2" class="center"><p>-------------------------</p></td><td>ကုမ္ပဏီ  </td><td class="center"><p>-------------------------</p></td></tr>
                <tr><td colspan="8" class="center"></td></tr>
                <tr><td colspan="8" class="center">အထက်ပါစစ်ဆေးချက်အားအတည်ပြုပါသည်။</td></tr>
                <tr><td colspan="8" class="center"></td></tr>
                <tr><td colspan="8" class="center"></td></tr>
                <tr><td colspan='3'>အထွေထွေမန်နေဂျာ</td><td></td><td></td><td></td><td colspan="2" class="right">အင်ဂျင်နီယာချုပ်</td></tr>
                <tr><td colspan='3'>(ပစ္စည်းစီမံရေး)</td><td></td><td></td><td></td><td colspan="2" class="right">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td></tr>


             </table>
    </div>
    @endfor
</body>

</html>
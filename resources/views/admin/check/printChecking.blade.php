<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <style>
        html {
            font-size:18px;
            font-family: "Pyitaungsu";
        }
        .table{
            width:950px;
            margin-left:0.5in;
            font-size:18px;
            margin-top:0.3in;
        }
        .height2{
            top:170px;
            position:absolute;
        }
        .table2{
            font-size:18px;
            width:940px;
            margin-left:0.5in;
            position:absolute;
            height:850px;

        }
        .height3{
            height:150px;
            top:1000px;
            margin-bottom:40px;
            position:absolute;
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
        .table td{
            height:15px;
            overflow: hidden;
        }
        .table.no-border tr td, .table.no-border tr th {
        border-width: 0;
        }
        .table tr td{
            border:1px solid black;
        }
        .sw{
            width:20px;
        }
        .mw{
            width:50px;
        }
        .hw{
            width:80px;
        }
        .cw{
            width:190px;
        }
      
        p{
            margin-top: 10px;
            margin-bottom: 0px;
        }
        .table>tbody>tr>td{
            padding-top:0px;
            padding-left:8px;
            padding-right:8px;
            padding-bottom:5px;
            vertical-align: middle;
            height:24px;
            overflow: hidden;
        }
        .table2>tbody>tr>td{
            padding-top:0px;
            padding-left:8px;
            padding-right:8px;
            padding-bottom:5px;
            vertical-align: middle;
            height:20px;
            overflow: hidden;
            border:1px solid black;
        }
    </style>
</head>
<body onload="printview()">

@php
    $chk_details  =$printData['chk_details'];
    $chk_lists    =$printData['chk_lists'];

    $number_of_chk_items = $chk_details->count();
    $number_of_printed_reports = 0;
    $number_of_items_per_report = 16;
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
<div class="container">
  
@for($i = 0; $i < $number_of_printed_reports; $i++)
    <div class="row" id="page">
        @foreach($chk_lists as $chk_list)
            <table class='table no-border height1'>
                <tr><td></td><td></td><td class="hw"></td><td colspan="3" class="center size">?????????????????????????????????????????????????????????????????????????????????????????????????????????</td><td></td><td class="right cw">(???????????????-??????-???)</td></tr>
                <tr><td></td><td></td><td></td><td colspan="3" class="center size">???????????????????????????????????????????????????</td><td></td><td></td></tr>
                <tr><td></td><td></td><td></td><td colspan="3" class="center size">????????????????????????????????????</td><td></td><td></td></tr>
                <tr><td colspan="2" class="mw size">Contract/PONO</td><td colspan="6"><p>--------------------------------------------------------------------------------------------------------</p></td></tr>
            </table>
            <br>
        @endforeach
            <table class="table2 height2">
                <tr class="center"><td  class="sw" rowspan="2">?????????</td><td colspan="2" rowspan="2" class="cw">???????????????????????????????????????????????????</td><td rowspan="2" class="mw">??????????????????????????????</td><td rowspan="2" class="hw">????????????????????????</td><td colspan="2">?????????????????????/????????????????????????<br>???????????????????????????</td><td rowspan="2">????????????????????????</td></tr>
                <tr class="center"><td>?????????????????????</td><td>????????????????????????</td></tr>
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
                                    <td style="text-align:center;">{{$chk_details[$getIndex]->item_remark}}</td>
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
                                    <td style="text-align:center;">{{$chk_details[$getIndex]->item_remark}}</td>
                                    </tr>
                        @endfor
                    @endif
              
            </table>
            <table class="table no-border height3">
            <tr><td colspan="8" class="center"></td></tr>
                <tr class="center"><td colspan="3">???????????????????????????????????????????????????</td> <td colspan="3">???????????????????????????????????????????????????</td><td colspan="2">??????????????????????????????????????????</td></tr>
                <tr><td colspan="8" class="center"></td></tr>
                <tr><td colspan="8" class="center"></td></tr>
                <tr><td colspan="8" class="center"></td></tr>
                <tr><td colspan="2">?????????????????????</td><td class="center"><p>-------------------------</p></td><td>?????????????????????</td><td colspan="2" class="center"><p>-------------------------</p></td><td>?????????????????????</td><td class="center"><p>-------------------------</p></td></tr>
                <tr><td colspan="2">????????????</td><td class="center"><p>-------------------------</p></td><td>????????????     </td><td colspan="2" class="center"><p>-------------------------</p></td><td>????????????     </td><td class="center"><p>-------------------------</p></td></tr>
                <tr><td colspan="2">???????????????</td><td class="center"><p>-------------------------</p></td><td>???????????????     </td><td colspan="2" class="center"><p>-------------------------</p></td><td>???????????????     </td><td class="center"><p>-------------------------</p></td></tr>
                <tr><td colspan="2">?????????????????????</td><td class="center"><p>-------------------------</p></td><td>?????????????????????  </td><td colspan="2" class="center"><p>-------------------------</p></td><td>?????????????????????  </td><td class="center"><p>-------------------------</p></td></tr>
                <tr><td colspan="8" class="center"></td></tr>
                <tr><td colspan="8" class="center">????????????????????????????????????????????????????????????????????????????????????????????????</td></tr>
                <tr><td colspan="8" class="center"></td></tr>
                <tr><td colspan="8" class="center"></td></tr>
                <tr><td colspan='3'>?????????????????????????????????????????????</td><td></td><td></td><td></td><td colspan="2" class="right">????????????????????????????????????????????????</td></tr>
                <tr><td colspan='3'>(??????????????????????????????????????????)</td><td></td><td></td><td></td><td colspan="2" class="right">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td></tr>


             </table>
       </div>
    </div>
@endfor
<script>
    function printview()
    {
        window.print();
    }
</script>
    </body>
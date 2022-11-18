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
        @page {
            size: landscape;
        }

        .page {
            font-family: "Pyitaungsu";
            box-sizing: border-box;
            height: 715px;/* 705px at other laptop */
            width: 1022px;
            padding-top:5px;
            padding-left: 36px;
            position: relative;
            font-size:14px;
        }


        .table1 table,
        .table1 tr,
        .table1 td {
            border: 1px solid black;
            border-bottom: none;
        }

        .table2 table,
        .table2 tr,
        .table2 td {
            table-layout:fixed;
            overflow:hidden;
            height:45px;
            border: 1px solid black;
        }

        thead td {
            padding: 2px 2px;
        }
        p{
            position:absolute;
            margin-left:450px;
            top:62px;
            font-size:12px;
        }
        .do_date{
            position:absolute;
            margin-left:860px;
            top:80px;
            font-size:14px;
        }
        .warehouse{
            position:absolute;
            top:42px;
            margin-left:450px;
            font-size:14px;

        }
        .supplier{
            position:absolute;
            top:100px;
            margin-left:440px;
            font-size:14px;
        }
        .invoice_no{
            position:absolute;
            top:42px;
            margin-left:860px;
            font-size:14px;
        }
        .invoice_no{
            position:absolute;
            top:42px;
            margin-left:860px;
            font-size:14px;
        }
    </style>
</head>

<body>
    @php
    $tot_amt = $printData['tot_amt'];
    $pos = $printData['po'];
    $po_items = $printData['po_items'];
    $number_of_po_items = $po_items->count();
    $number_of_printed_reports = 0;
    $number_of_items_per_report = 6;
    $number_of_items_in_last_report = 0;
    @endphp
    <!-- $number_of_po_items = 7; // this code is used in about @php @endphp -->
    <!--  မူရင်း -->
    <div>
        @if ($number_of_po_items % $number_of_items_per_report == 0)
        @php
        $number_of_printed_reports = floor($number_of_po_items / $number_of_items_per_report);
        @endphp
        @elseif($number_of_po_items % $number_of_items_per_report < 0) @php $number_of_printed_reports=floor($number_of_po_items / $number_of_items_per_report); $number_of_items_in_last_report=$number_of_po_items; @endphp @elseif($number_of_po_items % $number_of_items_per_report> 0)
            @php
            
            $number_of_printed_reports = floor($number_of_po_items / $number_of_items_per_report);
            $number_of_items_in_last_report = $number_of_po_items - ($number_of_items_per_report * $number_of_printed_reports);
            $number_of_printed_reports++;
            @endphp
            @endif
             
            @for($i = 0; $i < $number_of_printed_reports; $i++) <div class="page">
                @foreach($pos as $po)
                @php
                $number=0;
                   if($po->invoice_no==null)
                   {
                        $number++;
                        $invoice_no=str_pad($number,6,"0",STR_PAD_LEFT);
                   }
                   else{
                       $invoice_no=str_pad($po->invoice_no+1,6,"0",STR_PAD_LEFT);
                   }
                @endphp
                <p>[ပစ္စည်းရရှိလွှာ]</p>
                <p class="do_date">{{$po->do_date}}</p> 
                <p class="warehouse">{{$po_items[0]->warehouse}}</p> 
                <p class="supplier">{{$po->supplier}}</p>
                <p class="invoice_no">{{$invoice_no}}</p> 
                <div class="row">
                    <div style="width:25%;position:relative;">
                        <div style="width:100px;height:100px;border:1px solid black;display:inline-block;">
                        </div>
                        <div style="position:absolute;top:10px;left:140px;">လျှပ်စစ်ပုံစံ ၁၅၉</div>
                    </div>
                    <div style="width:50%;">
                        <div>
                            <div style="width:auto;margin:auto;text-align:center;font-weight:bolder;font-size:20px;">
                                လျှပ်စစ်ဓါတ်အားဖြန့်ဖြူးရေးလုပ်ငန်း
                            </div>
                            <div style="width:230px;margin:auto;text-align:right;padding-top:10px;">
                                _____________________ဂိုဒေါင်
                            </div>
          
                                
                 
                            <div style="width:auto;margin:auto;text-align:center;padding-top:15px">
                                <br>ပေးသွင်းသည့်ဌာန &nbsp;&nbsp;&nbsp;&nbsp; _____________________________________
                            </div>
                        </div>
                    </div>
                    <div style="width:25%;vertical-align:text-bottom;position:relative;">

                        <div style="position:absolute;left:20px;font-weight:bold;">မူရင်း</div>
                        <div style="position:absolute;left:20px;top:40px;">အမှတ် &nbsp; _____________________</div>
                        <div style="position:absolute;left:20px;top:80px;">နေ့စွဲ &nbsp;&nbsp;&nbsp;&nbsp; _____________________</div>
                    </div>
                </div>
                <div class="row">
                    <table class="table1" style="width:100%;margin-top:15px;">
                        <thead>
                            <tr>
                                <td rowspan="2" colspan="3" style="width:1.2in;text-align:center;">ရုံးအမှတ်</td>
                                <td rowspan="2" style="width:1in;text-align:center;">ပေးသွင်းသည့်ကုဒ်</td>
                                <td colspan="2" style="width:3in;text-align:center;">ပစ္စည်းအမှာလွှာ</td>
                                <td colspan="2" style="width:1.5in;text-align:center;">ကုန်ဝယ်ပစ္စည်း လျှပ်စစ်ပုံစံ ၂၅(ခ)</td>
                                <td style="width:1.5in;text-align:left;">ယာဉ်အမျိုအစား</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">အမှတ်</td>
                                <td style="text-align:center;width:0.8in;">နေ့စွဲ</td>
                                <td style="text-align:center;">အမှတ်</td>
                                <td style="text-align:center;width:0.8in;">နေ့စွဲ</td>
                                <td style="text-align:left;">အမည်</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">23</td>
                                <td style="text-align:center;">823</td>
                                <td style="text-align:center;">&nbsp;</td>
                                <td style="text-align:center;">&nbsp;</td>
                                <td style="text-align:left;">{{$po->po_no}}</td>
                                <td style="text-align:center;">{{$po->po_date}}</td>
                                <td style="text-align:left;">{{$po->do_no}}</td>
                                <td style="text-align:center;">{{$po->do_date}}</td>
                                <td style="text-align:left;">နေ့စွဲ</td>
                            </tr>
                        </thead>
                    </table>
                    @endforeach
                    <table class="table2" style="width:100%;border-top:none;">
                        <tbody>
                            <tr>
                                <td style="width:0.44in;text-align:center;">စဉ်</td>
                                <td style="width:1.74in;text-align:center;">ပစ္စည်းကုဒ်</td>
                                <td style="width:2.73in;text-align:center;">ပစ္စည်းအမျိုးအမည်</td>
                                <td style="width:0.96in;text-align:center;">ရေတွက်ပုံ</td>
                                <td style="width:0.6in;text-align:left;">အရေအတွက်</td>
                                <td style="width:1.39in;text-align:center;">နှုန်း(ကျပ်)</td>
                                <td style="width:1.4in;text-align:center;">သင့်ငွေကျပ်</td>
                                <td style="text-align:center;">မှတ်ချက်</td>
                            </tr>

                            <!-- check the report is last report or not -->
                            
                            @if(($i+1) == $number_of_printed_reports && $number_of_items_in_last_report > 0)
                            @for ($j = 1; $j <= $number_of_items_in_last_report; $j++) @php $getIndex=($j-1) + ($i * $number_of_items_per_report); @endphp <tr>
                                <td style="text-align:center;">{{$getIndex+1}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->store_code}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->item_name}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->unit}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->qty}}</td>
                                <td style="text-align:right;">{{$po_items[$getIndex]->price}}</td>
                                <td style="text-align:right;">{{$po_items[$getIndex]->amt}}</td>
                                <td style="text-align:center;"></td>
                                </tr>

                                @endfor
                                @for ($j = 1; $j <= $number_of_items_per_report-$number_of_items_in_last_report; $j++) @php $getIndex=($j-1) + ($i * $number_of_items_per_report); @endphp <tr>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    </tr>
                                    @endfor
                                    @else
                                    @for ($j = 1; $j <= $number_of_items_per_report; $j++) @php $getIndex=($j -1) + ($i * $number_of_items_per_report); @endphp <tr>
                                        <td style="text-align:center;">{{$getIndex+1}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->store_code}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->item_name}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->unit}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->qty}}</td>
                                        <td style="text-align:right;">{{$po_items[$getIndex]->price}}</td>
                                        <td style="text-align:right;">{{$po_items[$getIndex]->amt}}</td>
                                        <td style="text-align:center;"></td>
                                        </tr>

                                        @endfor
                                        @endif

                                        <tr>
                                            <td colspan="2" style="text-align:center;border-right:none;">({{$number_of_po_items}} Items Only)</td>
                                            <td colspan="4" style="text-align:right;padding-right:20px;border-left:none;">Total:</td>
                                            <td style="text-align:right;">{{$tot_amt}}</td>
                                            <td style="text-align:left;"></td>
                                        </tr>

                        </tbody>
                    </table>
                    </div>
                <div style="position:absolute;bottom:0.18in; left:0.3in;display:inline-block;">ဘင့်ကဒ်ရေးသွင်းသူ &nbsp; _______________</div>
                <div style="position:absolute;bottom:0.5in; right:0in;display:inline-block;">လက်ခံသူလက်မှတ် &nbsp; _______________</div>
                <div style="position:absolute;bottom:0.15in; right:0in;display:inline-block;">ရာထူး &nbsp; _______________</div>
            </div> 
            @endfor
    </div>
    <!-- ပ-မူရင်း -->
    <div>
        @if ($number_of_po_items % $number_of_items_per_report == 0)
        @php
        $number_of_printed_reports = floor($number_of_po_items / $number_of_items_per_report);
        @endphp
        @elseif($number_of_po_items % $number_of_items_per_report < 0) @php $number_of_printed_reports=floor($number_of_po_items / $number_of_items_per_report); $number_of_items_in_last_report=$number_of_po_items; @endphp @elseif($number_of_po_items % $number_of_items_per_report> 0)
            @php
            
            $number_of_printed_reports = floor($number_of_po_items / $number_of_items_per_report);
            $number_of_items_in_last_report = $number_of_po_items - ($number_of_items_per_report * $number_of_printed_reports);
            $number_of_printed_reports++;
            @endphp
            @endif
             
            @for($i = 0; $i < $number_of_printed_reports; $i++) <div class="page">
                @foreach($pos as $po)
                @php
                $number=0;
                   if($po->invoice_no==null)
                   {
                        $number++;
                        $invoice_no=str_pad($number,6,"0",STR_PAD_LEFT);
                   }
                   else{
                       $invoice_no=str_pad($po->invoice_no+1,6,"0",STR_PAD_LEFT);
                   }
                @endphp
                <p>[ပစ္စည်းရရှိလွှာ]</p>
                <p class="do_date">{{$po->do_date}}</p> 
                <p class="warehouse">{{$po_items[0]->warehouse}}</p> 
                <p class="supplier">{{$po->supplier}}</p> 
                <p class="invoice_no">{{$invoice_no}}</p> 
                <div class="row">
                    <div style="width:25%;position:relative;">
                        <div style="width:100px;height:100px;border:1px solid black;display:inline-block;">
                        </div>
                        <div style="position:absolute;top:10px;left:140px;">လျှပ်စစ်ပုံစံ ၁၅၉</div>
                    </div>
                    <div style="width:50%;">
                        <div>
                            <div style="width:auto;margin:auto;text-align:center;font-weight:bolder;font-size:20px;">
                                လျှပ်စစ်ဓါတ်အားဖြန့်ဖြူးရေးလုပ်ငန်း
                            </div>
                            <div style="width:230px;margin:auto;text-align:right;padding-top:10px;">
                                _____________________ဂိုဒေါင်
                            </div>
          
                                
                 
                            <div style="width:auto;margin:auto;text-align:center;padding-top:15px">
                                <br>ပေးသွင်းသည့်ဌာန &nbsp;&nbsp;&nbsp;&nbsp; _____________________________________
                            </div>
                        </div>
                    </div>
                    <div style="width:25%;vertical-align:text-bottom;position:relative;">

                        <div style="position:absolute;left:20px;font-weight:bold;">ပ-မူရင်း</div>
                        <div style="position:absolute;left:20px;top:40px;">အမှတ် &nbsp; _____________________</div>
                        <div style="position:absolute;left:20px;top:80px;">နေ့စွဲ &nbsp;&nbsp;&nbsp;&nbsp; _____________________</div>
                    </div>
                </div>
                <div class="row">
                    <table class="table1" style="width:100%;margin-top:15px;">
                        <thead>
                            <tr>
                                <td rowspan="2" colspan="3" style="width:1.2in;text-align:center;">ရုံးအမှတ်</td>
                                <td rowspan="2" style="width:1in;text-align:center;">ပေးသွင်းသည့်ကုဒ်</td>
                                <td colspan="2" style="width:3in;text-align:center;">ပစ္စည်းအမှာလွှာ</td>
                                <td colspan="2" style="width:1.5in;text-align:center;">ကုန်ဝယ်ပစ္စည်း လျှပ်စစ်ပုံစံ ၂၅(ခ)</td>
                                <td style="width:1.5in;text-align:left;">ယာဉ်အမျိုအစား</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">အမှတ်</td>
                                <td style="text-align:center;width:0.8in;">နေ့စွဲ</td>
                                <td style="text-align:center;">အမှတ်</td>
                                <td style="text-align:center;width:0.8in;">နေ့စွဲ</td>
                                <td style="text-align:left;">အမည်</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">23</td>
                                <td style="text-align:center;">823</td>
                                <td style="text-align:center;">&nbsp;</td>
                                <td style="text-align:center;">&nbsp;</td>
                                <td style="text-align:left;">{{$po->po_no}}</td>
                                <td style="text-align:center;">{{$po->po_date}}</td>
                                <td style="text-align:left;">{{$po->do_no}}</td>
                                <td style="text-align:center;">{{$po->do_date}}</td>
                                <td style="text-align:left;">နေ့စွဲ</td>
                            </tr>
                        </thead>
                    </table>
                    @endforeach
                    <table class="table2" style="width:100%;border-top:none;">
                        <tbody>
                            <tr>
                                <td style="width:0.44in;text-align:center;">စဉ်</td>
                                <td style="width:1.74in;text-align:center;">ပစ္စည်းကုဒ်</td>
                                <td style="width:2.73in;text-align:center;">ပစ္စည်းအမျိုးအမည်</td>
                                <td style="width:0.96in;text-align:center;">ရေတွက်ပုံ</td>
                                <td style="width:0.6in;text-align:left;">အရေအတွက်</td>
                                <td style="width:1.39in;text-align:center;">နှုန်း(ကျပ်)</td>
                                <td style="width:1.4in;text-align:center;">သင့်ငွေကျပ်</td>
                                <td style="text-align:center;">မှတ်ချက်</td>
                            </tr>

                            <!-- check the report is last report or not -->
                            
                            @if(($i+1) == $number_of_printed_reports && $number_of_items_in_last_report > 0)
                            @for ($j = 1; $j <= $number_of_items_in_last_report; $j++) @php $getIndex=($j-1) + ($i * $number_of_items_per_report); @endphp <tr>
                                <td style="text-align:center;">{{$getIndex+1}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->store_code}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->item_name}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->unit}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->qty}}</td>
                                <td style="text-align:right;">{{$po_items[$getIndex]->price}}</td>
                                <td style="text-align:right;">{{$po_items[$getIndex]->amt}}</td>
                                <td style="text-align:center;"></td>
                                </tr>

                                @endfor
                                @for ($j = 1; $j <= $number_of_items_per_report-$number_of_items_in_last_report; $j++) @php $getIndex=($j-1) + ($i * $number_of_items_per_report); @endphp <tr>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    </tr>
                                    @endfor
                                    @else
                                    @for ($j = 1; $j <= $number_of_items_per_report; $j++) @php $getIndex=($j -1) + ($i * $number_of_items_per_report); @endphp <tr>
                                        <td style="text-align:center;">{{$getIndex+1}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->store_code}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->item_name}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->unit}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->qty}}</td>
                                        <td style="text-align:right;">{{$po_items[$getIndex]->price}}</td>
                                        <td style="text-align:right;">{{$po_items[$getIndex]->amt}}</td>
                                        <td style="text-align:center;"></td>
                                        </tr>

                                        @endfor
                                        @endif

                                        <tr>
                                            <td colspan="2" style="text-align:center;border-right:none;">({{$number_of_po_items}} Items Only)</td>
                                            <td colspan="4" style="text-align:right;padding-right:20px;border-left:none;">Total:</td>
                                            <td style="text-align:right;">{{$tot_amt}}</td>
                                            <td style="text-align:left;"></td>
                                        </tr>

                        </tbody>
                    </table>
                    </div>
                <div style="position:absolute;bottom:0.18in; left:0.3in;display:inline-block;">ဘင့်ကဒ်ရေးသွင်းသူ &nbsp; _______________</div>
                <div style="position:absolute;bottom:0.5in; right:0in;display:inline-block;">လက်ခံသူလက်မှတ် &nbsp; _______________</div>
                <div style="position:absolute;bottom:0.15in; right:0in;display:inline-block;">ရာထူး &nbsp; _______________</div>
            </div> 
            @endfor
    </div>  
    <div>
        @if ($number_of_po_items % $number_of_items_per_report == 0)
        @php
        $number_of_printed_reports = floor($number_of_po_items / $number_of_items_per_report);
        @endphp
        @elseif($number_of_po_items % $number_of_items_per_report < 0) @php $number_of_printed_reports=floor($number_of_po_items / $number_of_items_per_report); $number_of_items_in_last_report=$number_of_po_items; @endphp @elseif($number_of_po_items % $number_of_items_per_report> 0)
            @php
            
            $number_of_printed_reports = floor($number_of_po_items / $number_of_items_per_report);
            $number_of_items_in_last_report = $number_of_po_items - ($number_of_items_per_report * $number_of_printed_reports);
            $number_of_printed_reports++;
            @endphp
            @endif
             
            @for($i = 0; $i < $number_of_printed_reports; $i++) <div class="page">
                @foreach($pos as $po)
                @php
                $number=0;
                   if($po->invoice_no==null)
                   {
                        $number++;
                        $invoice_no=str_pad($number,6,"0",STR_PAD_LEFT);
                   }
                   else{
                       $invoice_no=str_pad($po->invoice_no+1,6,"0",STR_PAD_LEFT);
                   }
                @endphp
                <p>[ပစ္စည်းရရှိလွှာ]</p>
                <p class="do_date">{{$po->do_date}}</p> 
                <p class="warehouse">{{$po_items[0]->warehouse}}</p> 
                <p class="supplier">{{$po->supplier}}</p>
                <p class="invoice_no">{{$invoice_no}}</p>  
                <div class="row">
                    <div style="width:25%;position:relative;">
                        <div style="width:100px;height:100px;border:1px solid black;display:inline-block;">
                        </div>
                        <div style="position:absolute;top:10px;left:140px;">လျှပ်စစ်ပုံစံ ၁၅၉</div>
                    </div>
                    <div style="width:50%;">
                        <div>
                            <div style="width:auto;margin:auto;text-align:center;font-weight:bolder;font-size:20px;">
                                လျှပ်စစ်ဓါတ်အားဖြန့်ဖြူးရေးလုပ်ငန်း
                            </div>
                            <div style="width:230px;margin:auto;text-align:right;padding-top:10px;">
                                _____________________ဂိုဒေါင်
                            </div>
          
                                
                 
                            <div style="width:auto;margin:auto;text-align:center;padding-top:15px">
                                <br>ပေးသွင်းသည့်ဌာန &nbsp;&nbsp;&nbsp;&nbsp; _____________________________________
                            </div>
                        </div>
                    </div>
                    <div style="width:25%;vertical-align:text-bottom;position:relative;">

                        <div style="position:absolute;left:20px;font-weight:bold;">ပ-မူရင်း</div>
                        <div style="position:absolute;left:20px;top:40px;">အမှတ် &nbsp; _____________________</div>
                        <div style="position:absolute;left:20px;top:80px;">နေ့စွဲ &nbsp;&nbsp;&nbsp;&nbsp; _____________________</div>
                    </div>
                </div>
                <div class="row">
                    <table class="table1" style="width:100%;margin-top:15px;">
                        <thead>
                            <tr>
                                <td rowspan="2" colspan="3" style="width:1.2in;text-align:center;">ရုံးအမှတ်</td>
                                <td rowspan="2" style="width:1in;text-align:center;">ပေးသွင်းသည့်ကုဒ်</td>
                                <td colspan="2" style="width:3in;text-align:center;">ပစ္စည်းအမှာလွှာ</td>
                                <td colspan="2" style="width:1.5in;text-align:center;">ကုန်ဝယ်ပစ္စည်း လျှပ်စစ်ပုံစံ ၂၅(ခ)</td>
                                <td style="width:1.5in;text-align:left;">ယာဉ်အမျိုအစား</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">အမှတ်</td>
                                <td style="text-align:center;width:0.8in;">နေ့စွဲ</td>
                                <td style="text-align:center;">အမှတ်</td>
                                <td style="text-align:center;width:0.8in;">နေ့စွဲ</td>
                                <td style="text-align:left;">အမည်</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">23</td>
                                <td style="text-align:center;">823</td>
                                <td style="text-align:center;">&nbsp;</td>
                                <td style="text-align:center;">&nbsp;</td>
                                <td style="text-align:left;">{{$po->po_no}}</td>
                                <td style="text-align:center;">{{$po->po_date}}</td>
                                <td style="text-align:left;">{{$po->do_no}}</td>
                                <td style="text-align:center;">{{$po->do_date}}</td>
                                <td style="text-align:left;">နေ့စွဲ</td>
                            </tr>
                        </thead>
                    </table>
                    @endforeach
                    <table class="table2" style="width:100%;border-top:none;">
                        <tbody>
                            <tr>
                                <td style="width:0.44in;text-align:center;">စဉ်</td>
                                <td style="width:1.74in;text-align:center;">ပစ္စည်းကုဒ်</td>
                                <td style="width:2.73in;text-align:center;">ပစ္စည်းအမျိုးအမည်</td>
                                <td style="width:0.96in;text-align:center;">ရေတွက်ပုံ</td>
                                <td style="width:0.6in;text-align:left;">အရေအတွက်</td>
                                <td style="width:1.39in;text-align:center;">နှုန်း(ကျပ်)</td>
                                <td style="width:1.4in;text-align:center;">သင့်ငွေကျပ်</td>
                                <td style="text-align:center;">မှတ်ချက်</td>
                            </tr>

                            <!-- check the report is last report or not -->
                            
                            @if(($i+1) == $number_of_printed_reports && $number_of_items_in_last_report > 0)
                            @for ($j = 1; $j <= $number_of_items_in_last_report; $j++) @php $getIndex=($j-1) + ($i * $number_of_items_per_report); @endphp <tr>
                                <td style="text-align:center;">{{$getIndex+1}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->store_code}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->item_name}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->unit}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->qty}}</td>
                                <td style="text-align:right;">{{$po_items[$getIndex]->price}}</td>
                                <td style="text-align:right;">{{$po_items[$getIndex]->amt}}</td>
                                <td style="text-align:center;"></td>
                                </tr>

                                @endfor
                                @for ($j = 1; $j <= $number_of_items_per_report-$number_of_items_in_last_report; $j++) @php $getIndex=($j-1) + ($i * $number_of_items_per_report); @endphp <tr>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    </tr>
                                    @endfor
                                    @else
                                    @for ($j = 1; $j <= $number_of_items_per_report; $j++) @php $getIndex=($j -1) + ($i * $number_of_items_per_report); @endphp <tr>
                                        <td style="text-align:center;">{{$getIndex+1}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->store_code}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->item_name}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->unit}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->qty}}</td>
                                        <td style="text-align:right;">{{$po_items[$getIndex]->price}}</td>
                                        <td style="text-align:right;">{{$po_items[$getIndex]->amt}}</td>
                                        <td style="text-align:center;"></td>
                                        </tr>

                                        @endfor
                                        @endif

                                        <tr>
                                            <td colspan="2" style="text-align:center;border-right:none;">({{$number_of_po_items}} Items Only)</td>
                                            <td colspan="4" style="text-align:right;padding-right:20px;border-left:none;">Total:</td>
                                            <td style="text-align:right;">{{$tot_amt}}</td>
                                            <td style="text-align:left;"></td>
                                        </tr>

                        </tbody>
                    </table>
                    </div>
                <div style="position:absolute;bottom:0.18in; left:0.3in;display:inline-block;">ဘင့်ကဒ်ရေးသွင်းသူ &nbsp; _______________</div>
                <div style="position:absolute;bottom:0.5in; right:0in;display:inline-block;">လက်ခံသူလက်မှတ် &nbsp; _______________</div>
                <div style="position:absolute;bottom:0.15in; right:0in;display:inline-block;">ရာထူး &nbsp; _______________</div>
            </div> 
            @endfor
    </div>             
    <!-- ဒု-မူရင်း -->
    <div>
        @if ($number_of_po_items % $number_of_items_per_report == 0)
        @php
        $number_of_printed_reports = floor($number_of_po_items / $number_of_items_per_report);
        @endphp
        @elseif($number_of_po_items % $number_of_items_per_report < 0) @php $number_of_printed_reports=floor($number_of_po_items / $number_of_items_per_report); $number_of_items_in_last_report=$number_of_po_items; @endphp @elseif($number_of_po_items % $number_of_items_per_report> 0)
            @php
            
            $number_of_printed_reports = floor($number_of_po_items / $number_of_items_per_report);
            $number_of_items_in_last_report = $number_of_po_items - ($number_of_items_per_report * $number_of_printed_reports);
            $number_of_printed_reports++;
            @endphp
            @endif
             
            @for($i = 0; $i < $number_of_printed_reports; $i++) <div class="page">
                @foreach($pos as $po)
                @php
                $number=0;
                   if($po->invoice_no==null)
                   {
                        $number++;
                        $invoice_no=str_pad($number,6,"0",STR_PAD_LEFT);
                   }
                   else{
                       $invoice_no=str_pad($po->invoice_no+1,6,"0",STR_PAD_LEFT);
                   }
                @endphp
                <p>[ပစ္စည်းရရှိလွှာ]</p>
                <p class="do_date">{{$po->do_date}}</p> 
                <p class="warehouse">{{$po_items[0]->warehouse}}</p> 
                <p class="supplier">{{$po->supplier}}</p>
                <p class="invoice_no">{{$invoice_no}}</p> 
                <div class="row">
                    <div style="width:25%;position:relative;">
                        <div style="width:100px;height:100px;border:1px solid black;display:inline-block;">
                        </div>
                        <div style="position:absolute;top:10px;left:140px;">လျှပ်စစ်ပုံစံ ၁၅၉</div>
                    </div>
                    <div style="width:50%;">
                        <div>
                            <div style="width:auto;margin:auto;text-align:center;font-weight:bolder;font-size:20px;">
                                လျှပ်စစ်ဓါတ်အားဖြန့်ဖြူးရေးလုပ်ငန်း
                            </div>
                            <div style="width:230px;margin:auto;text-align:right;padding-top:10px;">
                                _____________________ဂိုဒေါင်
                            </div>
          
                                
                 
                            <div style="width:auto;margin:auto;text-align:center;padding-top:15px">
                                <br>ပေးသွင်းသည့်ဌာန &nbsp;&nbsp;&nbsp;&nbsp; _____________________________________
                            </div>
                        </div>
                    </div>
                    <div style="width:25%;vertical-align:text-bottom;position:relative;">

                        <div style="position:absolute;left:20px;font-weight:bold;">ဒု-မူရင်း</div>
                        <div style="position:absolute;left:20px;top:40px;">အမှတ် &nbsp; _____________________</div>
                        <div style="position:absolute;left:20px;top:80px;">နေ့စွဲ &nbsp;&nbsp;&nbsp;&nbsp; _____________________</div>
                    </div>
                </div>
                <div class="row">
                    <table class="table1" style="width:100%;margin-top:15px;">
                        <thead>
                            <tr>
                                <td rowspan="2" colspan="3" style="width:1.2in;text-align:center;">ရုံးအမှတ်</td>
                                <td rowspan="2" style="width:1in;text-align:center;">ပေးသွင်းသည့်ကုဒ်</td>
                                <td colspan="2" style="width:3in;text-align:center;">ပစ္စည်းအမှာလွှာ</td>
                                <td colspan="2" style="width:1.5in;text-align:center;">ကုန်ဝယ်ပစ္စည်း လျှပ်စစ်ပုံစံ ၂၅(ခ)</td>
                                <td style="width:1.5in;text-align:left;">ယာဉ်အမျိုအစား</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">အမှတ်</td>
                                <td style="text-align:center;width:0.8in;">နေ့စွဲ</td>
                                <td style="text-align:center;">အမှတ်</td>
                                <td style="text-align:center;width:0.8in;">နေ့စွဲ</td>
                                <td style="text-align:left;">အမည်</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">23</td>
                                <td style="text-align:center;">823</td>
                                <td style="text-align:center;">&nbsp;</td>
                                <td style="text-align:center;">&nbsp;</td>
                                <td style="text-align:left;">{{$po->po_no}}</td>
                                <td style="text-align:center;">{{$po->po_date}}</td>
                                <td style="text-align:left;">{{$po->do_no}}</td>
                                <td style="text-align:center;">{{$po->do_date}}</td>
                                <td style="text-align:left;">နေ့စွဲ</td>
                            </tr>
                        </thead>
                    </table>
                    @endforeach
                    <table class="table2" style="width:100%;border-top:none;">
                        <tbody>
                            <tr>
                                <td style="width:0.44in;text-align:center;">စဉ်</td>
                                <td style="width:1.74in;text-align:center;">ပစ္စည်းကုဒ်</td>
                                <td style="width:2.73in;text-align:center;">ပစ္စည်းအမျိုးအမည်</td>
                                <td style="width:0.96in;text-align:center;">ရေတွက်ပုံ</td>
                                <td style="width:0.6in;text-align:left;">အရေအတွက်</td>
                                <td style="width:1.39in;text-align:center;">နှုန်း(ကျပ်)</td>
                                <td style="width:1.4in;text-align:center;">သင့်ငွေကျပ်</td>
                                <td style="text-align:center;">မှတ်ချက်</td>
                            </tr>

                            <!-- check the report is last report or not -->
                            
                            @if(($i+1) == $number_of_printed_reports && $number_of_items_in_last_report > 0)
                            @for ($j = 1; $j <= $number_of_items_in_last_report; $j++) @php $getIndex=($j-1) + ($i * $number_of_items_per_report); @endphp <tr>
                                <td style="text-align:center;">{{$getIndex+1}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->store_code}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->item_name}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->unit}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->qty}}</td>
                                <td style="text-align:right;">{{$po_items[$getIndex]->price}}</td>
                                <td style="text-align:right;">{{$po_items[$getIndex]->amt}}</td>
                                <td style="text-align:center;"></td>
                                </tr>

                                @endfor
                                @for ($j = 1; $j <= $number_of_items_per_report-$number_of_items_in_last_report; $j++) @php $getIndex=($j-1) + ($i * $number_of_items_per_report); @endphp <tr>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    </tr>
                                    @endfor
                                    @else
                                    @for ($j = 1; $j <= $number_of_items_per_report; $j++) @php $getIndex=($j -1) + ($i * $number_of_items_per_report); @endphp <tr>
                                        <td style="text-align:center;">{{$getIndex+1}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->store_code}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->item_name}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->unit}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->qty}}</td>
                                        <td style="text-align:right;">{{$po_items[$getIndex]->price}}</td>
                                        <td style="text-align:right;">{{$po_items[$getIndex]->amt}}</td>
                                        <td style="text-align:center;"></td>
                                        </tr>

                                        @endfor
                                        @endif

                                        <tr>
                                            <td colspan="2" style="text-align:center;border-right:none;">({{$number_of_po_items}} Items Only)</td>
                                            <td colspan="4" style="text-align:right;padding-right:20px;border-left:none;">Total:</td>
                                            <td style="text-align:right;">{{$tot_amt}}</td>
                                            <td style="text-align:left;"></td>
                                        </tr>

                        </tbody>
                    </table>
                    </div>
                <div style="position:absolute;bottom:0.18in; left:0.3in;display:inline-block;">ဘင့်ကဒ်ရေးသွင်းသူ &nbsp; _______________</div>
                <div style="position:absolute;bottom:0.5in; right:0in;display:inline-block;">လက်ခံသူလက်မှတ် &nbsp; _______________</div>
                <div style="position:absolute;bottom:0.15in; right:0in;display:inline-block;">ရာထူး &nbsp; _______________</div>
            </div> 
            @endfor
    </div>  
    <div>
        @if ($number_of_po_items % $number_of_items_per_report == 0)
        @php
        $number_of_printed_reports = floor($number_of_po_items / $number_of_items_per_report);
        @endphp
        @elseif($number_of_po_items % $number_of_items_per_report < 0) @php $number_of_printed_reports=floor($number_of_po_items / $number_of_items_per_report); $number_of_items_in_last_report=$number_of_po_items; @endphp @elseif($number_of_po_items % $number_of_items_per_report> 0)
            @php
            
            $number_of_printed_reports = floor($number_of_po_items / $number_of_items_per_report);
            $number_of_items_in_last_report = $number_of_po_items - ($number_of_items_per_report * $number_of_printed_reports);
            $number_of_printed_reports++;
            @endphp
            @endif
             
            @for($i = 0; $i < $number_of_printed_reports; $i++) <div class="page">
                @foreach($pos as $po)
                @php
                $number=0;
                   if($po->invoice_no==null)
                   {
                        $number++;
                        $invoice_no=str_pad($number,6,"0",STR_PAD_LEFT);
                   }
                   else{
                       $invoice_no=str_pad($po->invoice_no+1,6,"0",STR_PAD_LEFT);
                   }
                @endphp
                <p>[ပစ္စည်းရရှိလွှာ]</p>
                <p class="do_date">{{$po->do_date}}</p> 
                <p class="warehouse">{{$po_items[0]->warehouse}}</p> 
                <p class="supplier">{{$po->supplier}}</p>
                <p class="invoice_no">{{$invoice_no}}</p>  
                <div class="row">
                    <div style="width:25%;position:relative;">
                        <div style="width:100px;height:100px;border:1px solid black;display:inline-block;">
                        </div>
                        <div style="position:absolute;top:10px;left:140px;">လျှပ်စစ်ပုံစံ ၁၅၉</div>
                    </div>
                    <div style="width:50%;">
                        <div>
                            <div style="width:auto;margin:auto;text-align:center;font-weight:bolder;font-size:20px;">
                                လျှပ်စစ်ဓါတ်အားဖြန့်ဖြူးရေးလုပ်ငန်း
                            </div>
                            <div style="width:230px;margin:auto;text-align:right;padding-top:10px;">
                                _____________________ဂိုဒေါင်
                            </div>
          
                                
                 
                            <div style="width:auto;margin:auto;text-align:center;padding-top:15px">
                                <br>ပေးသွင်းသည့်ဌာန &nbsp;&nbsp;&nbsp;&nbsp; _____________________________________
                            </div>
                        </div>
                    </div>
                    <div style="width:25%;vertical-align:text-bottom;position:relative;">

                        <div style="position:absolute;left:20px;font-weight:bold;">ဒု-မူရင်း</div>
                        <div style="position:absolute;left:20px;top:40px;">အမှတ် &nbsp; _____________________</div>
                        <div style="position:absolute;left:20px;top:80px;">နေ့စွဲ &nbsp;&nbsp;&nbsp;&nbsp; _____________________</div>
                    </div>
                </div>
                <div class="row">
                    <table class="table1" style="width:100%;margin-top:15px;">
                        <thead>
                            <tr>
                                <td rowspan="2" colspan="3" style="width:1.2in;text-align:center;">ရုံးအမှတ်</td>
                                <td rowspan="2" style="width:1in;text-align:center;">ပေးသွင်းသည့်ကုဒ်</td>
                                <td colspan="2" style="width:3in;text-align:center;">ပစ္စည်းအမှာလွှာ</td>
                                <td colspan="2" style="width:1.5in;text-align:center;">ကုန်ဝယ်ပစ္စည်း လျှပ်စစ်ပုံစံ ၂၅(ခ)</td>
                                <td style="width:1.5in;text-align:left;">ယာဉ်အမျိုအစား</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">အမှတ်</td>
                                <td style="text-align:center;width:0.8in;">နေ့စွဲ</td>
                                <td style="text-align:center;">အမှတ်</td>
                                <td style="text-align:center;width:0.8in;">နေ့စွဲ</td>
                                <td style="text-align:left;">အမည်</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">23</td>
                                <td style="text-align:center;">823</td>
                                <td style="text-align:center;">&nbsp;</td>
                                <td style="text-align:center;">&nbsp;</td>
                                <td style="text-align:left;">{{$po->po_no}}</td>
                                <td style="text-align:center;">{{$po->po_date}}</td>
                                <td style="text-align:left;">{{$po->do_no}}</td>
                                <td style="text-align:center;">{{$po->do_date}}</td>
                                <td style="text-align:left;">နေ့စွဲ</td>
                            </tr>
                        </thead>
                    </table>
                    @endforeach
                    <table class="table2" style="width:100%;border-top:none;">
                        <tbody>
                            <tr>
                                <td style="width:0.44in;text-align:center;">စဉ်</td>
                                <td style="width:1.74in;text-align:center;">ပစ္စည်းကုဒ်</td>
                                <td style="width:2.73in;text-align:center;">ပစ္စည်းအမျိုးအမည်</td>
                                <td style="width:0.96in;text-align:center;">ရေတွက်ပုံ</td>
                                <td style="width:0.6in;text-align:left;">အရေအတွက်</td>
                                <td style="width:1.39in;text-align:center;">နှုန်း(ကျပ်)</td>
                                <td style="width:1.4in;text-align:center;">သင့်ငွေကျပ်</td>
                                <td style="text-align:center;">မှတ်ချက်</td>
                            </tr>

                            <!-- check the report is last report or not -->
                            
                            @if(($i+1) == $number_of_printed_reports && $number_of_items_in_last_report > 0)
                            @for ($j = 1; $j <= $number_of_items_in_last_report; $j++) @php $getIndex=($j-1) + ($i * $number_of_items_per_report); @endphp <tr>
                                <td style="text-align:center;">{{$getIndex+1}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->store_code}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->item_name}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->unit}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->qty}}</td>
                                <td style="text-align:right;">{{$po_items[$getIndex]->price}}</td>
                                <td style="text-align:right;">{{$po_items[$getIndex]->amt}}</td>
                                <td style="text-align:center;"></td>
                                </tr>

                                @endfor
                                @for ($j = 1; $j <= $number_of_items_per_report-$number_of_items_in_last_report; $j++) @php $getIndex=($j-1) + ($i * $number_of_items_per_report); @endphp <tr>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    </tr>
                                    @endfor
                                    @else
                                    @for ($j = 1; $j <= $number_of_items_per_report; $j++) @php $getIndex=($j -1) + ($i * $number_of_items_per_report); @endphp <tr>
                                        <td style="text-align:center;">{{$getIndex+1}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->store_code}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->item_name}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->unit}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->qty}}</td>
                                        <td style="text-align:right;">{{$po_items[$getIndex]->price}}</td>
                                        <td style="text-align:right;">{{$po_items[$getIndex]->amt}}</td>
                                        <td style="text-align:center;"></td>
                                        </tr>

                                        @endfor
                                        @endif

                                        <tr>
                                            <td colspan="2" style="text-align:center;border-right:none;">({{$number_of_po_items}} Items Only)</td>
                                            <td colspan="4" style="text-align:right;padding-right:20px;border-left:none;">Total:</td>
                                            <td style="text-align:right;">{{$tot_amt}}</td>
                                            <td style="text-align:left;"></td>
                                        </tr>

                        </tbody>
                    </table>
                    </div>
                <div style="position:absolute;bottom:0.18in; left:0.3in;display:inline-block;">ဘင့်ကဒ်ရေးသွင်းသူ &nbsp; _______________</div>
                <div style="position:absolute;bottom:0.5in; right:0in;display:inline-block;">လက်ခံသူလက်မှတ် &nbsp; _______________</div>
                <div style="position:absolute;bottom:0.15in; right:0in;display:inline-block;">ရာထူး &nbsp; _______________</div>
            </div> 
            @endfor
    </div> 
    <div>
        @if ($number_of_po_items % $number_of_items_per_report == 0)
        @php
        $number_of_printed_reports = floor($number_of_po_items / $number_of_items_per_report);
        @endphp
        @elseif($number_of_po_items % $number_of_items_per_report < 0) @php $number_of_printed_reports=floor($number_of_po_items / $number_of_items_per_report); $number_of_items_in_last_report=$number_of_po_items; @endphp @elseif($number_of_po_items % $number_of_items_per_report> 0)
            @php
            
            $number_of_printed_reports = floor($number_of_po_items / $number_of_items_per_report);
            $number_of_items_in_last_report = $number_of_po_items - ($number_of_items_per_report * $number_of_printed_reports);
            $number_of_printed_reports++;
            @endphp
            @endif
             
            @for($i = 0; $i < $number_of_printed_reports; $i++) <div class="page">
                @foreach($pos as $po)
                @php
                $number=0;
                   if($po->invoice_no==null)
                   {
                        $number++;
                        $invoice_no=str_pad($number,6,"0",STR_PAD_LEFT);
                   }
                   else{
                       $invoice_no=str_pad($po->invoice_no+1,6,"0",STR_PAD_LEFT);
                   }
                @endphp
                <p>[ပစ္စည်းရရှိလွှာ]</p>
                <p class="do_date">{{$po->do_date}}</p> 
                <p class="warehouse">{{$po_items[0]->warehouse}}</p> 
                <p class="supplier">{{$po->supplier}}</p>
                <p class="invoice_no">{{$invoice_no}}</p>  
                <div class="row">
                    <div style="width:25%;position:relative;">
                        <div style="width:100px;height:100px;border:1px solid black;display:inline-block;">
                        </div>
                        <div style="position:absolute;top:10px;left:140px;">လျှပ်စစ်ပုံစံ ၁၅၉</div>
                    </div>
                    <div style="width:50%;">
                        <div>
                            <div style="width:auto;margin:auto;text-align:center;font-weight:bolder;font-size:20px;">
                                လျှပ်စစ်ဓါတ်အားဖြန့်ဖြူးရေးလုပ်ငန်း
                            </div>
                            <div style="width:230px;margin:auto;text-align:right;padding-top:10px;">
                                _____________________ဂိုဒေါင်
                            </div>
          
                                
                 
                            <div style="width:auto;margin:auto;text-align:center;padding-top:15px">
                                <br>ပေးသွင်းသည့်ဌာန &nbsp;&nbsp;&nbsp;&nbsp; _____________________________________
                            </div>
                        </div>
                    </div>
                    <div style="width:25%;vertical-align:text-bottom;position:relative;">

                        <div style="position:absolute;left:20px;font-weight:bold;">ဒု-မူရင်း</div>
                        <div style="position:absolute;left:20px;top:40px;">အမှတ် &nbsp; _____________________</div>
                        <div style="position:absolute;left:20px;top:80px;">နေ့စွဲ &nbsp;&nbsp;&nbsp;&nbsp; _____________________</div>
                    </div>
                </div>
                <div class="row">
                    <table class="table1" style="width:100%;margin-top:15px;">
                        <thead>
                            <tr>
                                <td rowspan="2" colspan="3" style="width:1.2in;text-align:center;">ရုံးအမှတ်</td>
                                <td rowspan="2" style="width:1in;text-align:center;">ပေးသွင်းသည့်ကုဒ်</td>
                                <td colspan="2" style="width:3in;text-align:center;">ပစ္စည်းအမှာလွှာ</td>
                                <td colspan="2" style="width:1.5in;text-align:center;">ကုန်ဝယ်ပစ္စည်း လျှပ်စစ်ပုံစံ ၂၅(ခ)</td>
                                <td style="width:1.5in;text-align:left;">ယာဉ်အမျိုအစား</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">အမှတ်</td>
                                <td style="text-align:center;width:0.8in;">နေ့စွဲ</td>
                                <td style="text-align:center;">အမှတ်</td>
                                <td style="text-align:center;width:0.8in;">နေ့စွဲ</td>
                                <td style="text-align:left;">အမည်</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">23</td>
                                <td style="text-align:center;">823</td>
                                <td style="text-align:center;">&nbsp;</td>
                                <td style="text-align:center;">&nbsp;</td>
                                <td style="text-align:left;">{{$po->po_no}}</td>
                                <td style="text-align:center;">{{$po->po_date}}</td>
                                <td style="text-align:left;">{{$po->do_no}}</td>
                                <td style="text-align:center;">{{$po->do_date}}</td>
                                <td style="text-align:left;">နေ့စွဲ</td>
                            </tr>
                        </thead>
                    </table>
                    @endforeach
                    <table class="table2" style="width:100%;border-top:none;">
                        <tbody>
                            <tr>
                                <td style="width:0.44in;text-align:center;">စဉ်</td>
                                <td style="width:1.74in;text-align:center;">ပစ္စည်းကုဒ်</td>
                                <td style="width:2.73in;text-align:center;">ပစ္စည်းအမျိုးအမည်</td>
                                <td style="width:0.96in;text-align:center;">ရေတွက်ပုံ</td>
                                <td style="width:0.6in;text-align:left;">အရေအတွက်</td>
                                <td style="width:1.39in;text-align:center;">နှုန်း(ကျပ်)</td>
                                <td style="width:1.4in;text-align:center;">သင့်ငွေကျပ်</td>
                                <td style="text-align:center;">မှတ်ချက်</td>
                            </tr>

                            <!-- check the report is last report or not -->
                            
                            @if(($i+1) == $number_of_printed_reports && $number_of_items_in_last_report > 0)
                            @for ($j = 1; $j <= $number_of_items_in_last_report; $j++) @php $getIndex=($j-1) + ($i * $number_of_items_per_report); @endphp <tr>
                                <td style="text-align:center;">{{$getIndex+1}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->store_code}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->item_name}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->unit}}</td>
                                <td style="text-align:center;">{{$po_items[$getIndex]->qty}}</td>
                                <td style="text-align:right;">{{$po_items[$getIndex]->price}}</td>
                                <td style="text-align:right;">{{$po_items[$getIndex]->amt}}</td>
                                <td style="text-align:center;"></td>
                                </tr>

                                @endfor
                                @for ($j = 1; $j <= $number_of_items_per_report-$number_of_items_in_last_report; $j++) @php $getIndex=($j-1) + ($i * $number_of_items_per_report); @endphp <tr>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    <td style="text-align:center;">&nbsp;</td>
                                    </tr>
                                    @endfor
                                    @else
                                    @for ($j = 1; $j <= $number_of_items_per_report; $j++) @php $getIndex=($j -1) + ($i * $number_of_items_per_report); @endphp <tr>
                                        <td style="text-align:center;">{{$getIndex+1}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->store_code}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->item_name}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->unit}}</td>
                                        <td style="text-align:center;">{{$po_items[$getIndex]->qty}}</td>
                                        <td style="text-align:right;">{{$po_items[$getIndex]->price}}</td>
                                        <td style="text-align:right;">{{$po_items[$getIndex]->amt}}</td>
                                        <td style="text-align:center;"></td>
                                        </tr>

                                        @endfor
                                        @endif

                                        <tr>
                                            <td colspan="2" style="text-align:center;border-right:none;">({{$number_of_po_items}} Items Only)</td>
                                            <td colspan="4" style="text-align:right;padding-right:20px;border-left:none;">Total:</td>
                                            <td style="text-align:right;">{{$tot_amt}}</td>
                                            <td style="text-align:left;"></td>
                                        </tr>

                        </tbody>
                    </table>
                    </div>
                <div style="position:absolute;bottom:0.18in; left:0.3in;display:inline-block;">ဘင့်ကဒ်ရေးသွင်းသူ &nbsp; _______________</div>
                <div style="position:absolute;bottom:0.5in; right:0in;display:inline-block;">လက်ခံသူလက်မှတ် &nbsp; _______________</div>
                <div style="position:absolute;bottom:0.15in; right:0in;display:inline-block;">ရာထူး &nbsp; _______________</div>
            </div> 
            @endfor
    </div>             
</body>

</html>
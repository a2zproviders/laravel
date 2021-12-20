<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        .invoice_detail>table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice_detail>table,
        .invoice_detail table tr {
            /* border: 1px solid #000; */
            /* padding: 5px; */
        }

        .invoice_detail table tr td {
            border: 1px solid #000;
            padding: 5px;
        }

        .invoice_detail table tr td:first-child {
            border-left: 0;
            padding: 5px;
        }

        .invoice_detail table tr td:last-child {
            border-right: 0;
            padding: 5px;
        }

        td .service_detail tr .service_detail_td {
            border-left: 1px solid #000;
            border-left: 1px solid #000;
            border-bottom: none;
            border-top: none;
        }

        td table {
            margin: 0;
        }

        td .service_detail {
            border-collapse: collapse;
            border: none;
        }

        td .service_detail tr {
            border: none;
        }

        .service_detail tr th {
            border: 1px solid #000;
            border-top: 0;
        }

        .service_detail tr th:first-child {
            border-left: 0;
        }

        .service_detail tr th:last-child {
            border-right: 0;
        }

        .font-w {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div style="max-width: 800px; margin: auto; border: 1px solid #000;">
        <!-- <div style="float: left;background: #ebebeb; text-align: center; font-size: 48px; padding: 30px 15px;">
                
            </div> -->
        <div style="border-bottom: 1px solid #000;position: relative;">
            <div style="padding: 0 5px; border-bottom: 1px solid;">
                <div style="font-size: 30px;font-weight: bold; font-family:Verdana, Geneva, Tahoma, sans-serif;width: 100%;text-transform: uppercase; text-align:center;">{{ $setting->title }}</div>
            </div>
            <!-- <div style="background: #00afef;padding: 5px 5px;">
                <div style="width: 80%;font-size: 20px;color: #fff;font-family: sans-serif;">{{ $setting->tagline }}</div>
            </div> -->
            <div style="padding: 5px;font-family: sans-serif;">
                <div style="width: 50%;float: left;">
                    <div style="padding-right: 25px;">
                        {{$setting->address}}
                    </div>
                </div>
                <div style="width: 50%;float: left;">
                    <ul style="list-style: none;text-align: right;padding: 0;margin: 0;">
                        <li>
                            Tel : {{$setting->mobile}}
                        </li>
                        <li>
                            Email : {{$setting->email}}
                        </li>
                    </ul>
                </div>
                <div style="clear: both;"></div>
            </div>
            <!-- <div style="padding: 5px;position:absolute;top:0;bottom:0%;right:2%;left:85%;">
                <div style="justify-content: center;align-items: center;width:100%;margin-top:29px">

                    <img style="vertical-align: middle;" src="{{url('images/setting/logo/'.$setting->logo)}}" alt="" width="100%">
                </div>
            </div> -->
            <div style="clear: both;"></div>

        </div>
        <div style="border-bottom: 1px solid #000;position: relative;font-family: sans-serif;">
            <div style="padding: 5px">
                <div style="width: 33.33%;float: left;">
                    <span class="font-w">GSTIN : </span>
                    <span style="text-transform: uppercase;">{{$setting->GST}}</span>
                </div>
                <div style="width: 33.33%;text-align: center;float: left;">
                    <div style="text-transform: uppercase;font-size: 20px;font-weight: bold;">tax invoice</div>
                </div>
                <div style="width: 33.33%;text-align: right;font-weight: bold;float: right;">
                    <div>
                        Original for Recipient
                    </div>
                </div>
                <div style="clear: both;"></div>
            </div>
            <div class="invoice_detail" style="font-size: 13px;">

                <table>
                    <tr>
                        <td class="invoice_detail_td">
                            <div style="margin-bottom: 5px;">
                                <div style="width: 20%;font-weight: bold;float: left;">Name</div>
                                <div style="width: 80%;float: right;">{{ $list->user->name }}</div>
                            </div>
                            <div style="clear: both;"></div>
                            <div style="margin-bottom: 5px;">
                                <div style="width: 20%;font-weight: bold;float: left;">Phone</div>
                                <div style="width: 80%;float: right;">{{ $list->user->mobile }}</div>
                            </div>
                            <div style="clear: both;"></div>
                            <div style="margin-bottom: 5px;">
                                <div style="width: 20%;font-weight: bold;float: left;">Email</div>
                                <div style="width: 80%;float: right;">{{ $list->user->email }}</div>
                            </div>

                            <div style="clear: both;"></div>
                        </td>
                        <td class="invoice_detail_td" style="width: 50%!important; vertical-align: baseline;padding: 0;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="border:none;width:30%;font-weight: bold;">Invoice No</td>
                                    <td style="border:none;width:70%;text-transform: uppercase;font-weight: bold;">{{ sprintf("%s/%04d", $setting->invoice_pre, $list->invoice_no) }}</td>
                                </tr>
                                <tr>
                                    <td style="border:none;width:30%;font-weight: bold;">Invoice Date</td>
                                    <td style="border:none;width:70%">{{ date("d F, Y h:i A", strtotime($list->created_at)) }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td class="invoice_detail_td" colspan="2"></td>
                    </tr>
                    <tr>
                        <td class="invoice_detail_td" colspan="2" style="padding: 0;border: none;">
                            <table style="width: 100%;border-left-color: red;" class="service_detail">
                                <tr>
                                    <th rowspan="2">Sr. No.</th>
                                    <th rowspan="2">Title</th>
                                    <th rowspan="2">Category</th>
                                    <th rowspan="2">Size</th>
                                    <th rowspan="2">Color</th>
                                    <!-- <th rowspan="2">HSN/SAC</th> -->
                                    <th rowspan="2">Price</th>
                                    <th rowspan="2">GST (18%) </th>
                                    <!-- <th colspan="2">SGST</th> -->
                                    <!-- <th colspan="2">CGST</th> -->
                                    <th rowspan="2">Total</th>
                                </tr>
                                <tr>
                                    <!-- <th>%</th>
                                    <th>Amount</th>
                                    <th>%</th>
                                    <th>Amount</th> -->
                                </tr>
                                <tr>
                                    <td class="service_detail_td" style="padding-bottom:100px">1.</td>
                                    <td class="service_detail_td" style="padding-bottom:100px">{{ $list->title ? $list->title : NA }}</td>
                                    <td class="service_detail_td" style="padding-bottom:100px">{{ $list->category_id ? $list->category->name : NA }}</td>
                                    <td class="service_detail_td" style="padding-bottom:100px">{{ $list->size_id ? $list->size->name : NA }}</td>
                                    <td class="service_detail_td" style="padding-bottom:100px">{{ $list->color_id ? $list->color->name : NA }}</td>
                                    <!-- <td class="service_detail_td" style="padding-bottom:100px">995411</td> -->
                                    <td class="service_detail_td" style="padding-bottom:100px">{{ number_format((float)$list->price, 2, '.', '')}}</td>
                                    <td class="service_detail_td" style="padding-bottom:100px">{{ number_format((float)$list->gst_price, 2, '.', '')}}</td>
                                    <!-- <td class="service_detail_td" style="padding-bottom:100px">9</td> -->
                                    <td class="service_detail_td" style="padding-bottom:100px">{{ number_format((float)$list->total_price, 2, '.', '')}}</td>
                                    <!-- <td class="service_detail_td" style="padding-bottom:100px">9</td>
                                    <td class="service_detail_td" style="padding-bottom:100px">{{ number_format((float)$gst_price, 2, '.', '')}}</td>
                                    <td class="service_detail_td" style="padding-bottom:100px">{{ $list->payment }}</td> -->
                                </tr>
                                <!-- <tr style="height: 130px;">
                                        <td class="service_detail_td"></td>
                                        <td class="service_detail_td"></td>
                                        <td class="service_detail_td"></td>
                                        <td class="service_detail_td"></td>
                                        <td class="service_detail_td"></td>
                                        <td class="service_detail_td"></td>
                                        <td class="service_detail_td"></td>
                                        <td class="service_detail_td"></td>
                                    </tr> -->
                                <tr class="font-w">
                                    <td style="border-bottom: 0;" colspan="7">Total</td>
                                    <td style="border-bottom: 0;" class="">{{ number_format((float)$list->total_price, 2, '.', '')}}</td>
                                    <!-- <td style="border-bottom: 0;" class=""></td>
                                    <td style="border-bottom: 0;" class="">{{ number_format((float)$gst_price, 2, '.', '')}}</td>
                                    <td style="border-bottom: 0;" class=""></td>
                                    <td style="border-bottom: 0;" class="">{{ number_format((float)$gst_price, 2, '.', '')}}</td>
                                    <td style="border-bottom: 0;" class="">{{ $list->payment }}</td> -->
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td class="font-w text-center">Total in words</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="3" style="border-right: 1px solid;">
                            <div style="text-transform: uppercase;" id='inWord'>{{ $inword_price }} Rupees</div>
                        </td>
                        <td class="font-w">
                            <div style="float: left;">Price</div>
                            <div style="float: right;">{{ number_format((float)$list->price, 2, '.', '') }}</div>
                            <div style="clear:both"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-w">
                            <div style="float: left;">GST (18%)</div>
                            <div style="float: right;">{{ number_format((float)$list->gst_price, 2, '.', '') }}</div>
                            <div style="clear:both"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-w">
                            <div style="float: left;">Total Amount After Tax</div>
                            <div style="float: right;">Rs {{ number_format((float)$list->total_price, 2, '.', '') }}</div>
                            <div style="clear:both"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-w text-center">Terms & Conditions</td>
                        <td class="text-center">
                            <div style="font-size: 10px;margin-bottom: 5px;">Certified that the particulars given above are true and correct</div>
                            <div style="font-size: 17px;" class="font-w">For {{ $setting->title }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 0;" rowspan="2">
                            <div></div>
                        </td>
                        <td style="height: 45px;"></td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 0;text-align: center;height: 20px;" class="font-w">
                            Authorised Signatory
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


</body>

</html>
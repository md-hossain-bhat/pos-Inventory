<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>
<body>

    <div class="container">
    <div class="row">
    <div class="col-md-12">
            <table width="100%">
              
                    <tbody>
                        <tr>
                            <td width="40%"><strong>Invoice No. #{{$payment['invoice']['invoice_no']}}</strong></td>
                            <td width="40%"><span style="font-size:20px;">Glass & Dore</span><br><span>Baburhat,Chandpur</span></td>
                            <td width="20%"><small>Showrom :+88638793008 <br> Owner No. +0987654</small></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <div class="row">
        <div class="col-md-12">
            <table width="100%">
                <tbody>
                    <tr>
                        <td width="40%"></td>
                        <td width="50%"><u style ="font-size:20px;"><strong>Invoice Details</strong></u></td>
                        <td width="10%"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

        <table border="1" width="100%" style="margin-botton:10px;">
                    <thead>
                        <tr class="text-center">
                            <th>Sl.</th>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $total_sum = '0';
                            $invoice_details = App\InvoiceDetail::where('invoice_id',$payment['invoice_id'])->get();
                        @endphp
                        @foreach($invoice_details as $key => $detail)
                        <tr class="text-center">
                            <td>{{$key+1}}</td>
                            <td>{{$detail['category']['name']}}</td>
                            <td>{{$detail['product']['product_name']}}</td>
                            <td>{{$detail['selling_qty']}}</td>
                            <td>{{$detail['unit_price']}}</td>
                            <td>{{$detail['selling_price']}}</td>
                        </tr>
                        @php
                            $total_sum += $detail['selling_price'];

                        @endphp
                        @endforeach
                        <tr>
                            <td colspan="5" class="text-right"><strong>Sub Total</strong></td>
                            <td class="text-center"><strong>{{$total_sum}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right">Discount</td>
                            <td class="text-center">{{$payment['discount_amount']}}</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right">Paid Amount</td>
                            <td class="text-center">{{$payment['paid_amount']}}</td>
                        </tr>
                        @php 
                            $total_due = $total_sum - $payment['paid_amount'];
                            $total_due = $total_due - $payment['discount_amount']
                        @endphp
                        <tr>
                            <td colspan="5" class="text-right">Due Amount</td>
                            <td class="text-center">{{$total_due}}</td>
                            <input type="hidden" name="new_paid_amount" value="{{$payment['due_amount']}}">
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right"><strong>Grand Total</strong></td>
                            <td class="text-center"><strong>{{$payment['total']}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align:center; font-weight:bold;">Paid Summery</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:right;"><strong>Date</strong></td>
                            <td colspan="3"><strong>Amount</strong></td>
                        </tr>
                        @php 
                            $payment_details = App\PaymentDetail::where('invoice_id',$payment['invoice_id'])->get();
                        @endphp
                        @foreach($payment_details as $detail)
                        <tr>
                            <td colspan="3" style="text-align:right;">{{ date('d-m-Y',strtotime($detail['date']))}}</td>
                            <td colspan="3">{{$detail['current_paid_amount']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <hr style="margin-bottom:0px;">
                        <table border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td width="40%">
                                        <p style="text-align:center; margin-left:20px;"></p>
                                    </td>
                                    <td width="20%"></td>
                                    <td width="40%">
                                        <p style="text-align:center;">Seller Signature</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @php 
                    $date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                @endphp
                <small><i>Printing Time : {{$date->format('F j, Y, g:i a')}}</i></small>
            </div>
        </div>
    </div>

</body>
</html>
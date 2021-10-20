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
                            <td width="30%"></td>
                            <td width="50%"><span style="font-size:30px;">Glass & Dore</span><br><small>Baburhat,Chandpur</small></td>
                            <td width="20%"><small>Showrom :+88638793008</small></td>
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
                        <td width="35%"></td>
                        <td width="35%"><small style ="font-size:14px;"><strong>Paid Customer List</strong></small></td>
                        <td width="30%"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
        <table width="100%" border="1px">
                  <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Customer Name</th>
                    <th>Invoice No.</th>
                    <th width="16%">Date</th>
                    <th>Amount</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php 
                    $total_paid = '0';
                  @endphp
                    @foreach($payments as $key => $payment)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{$payment['customer']['name']}} ({{$payment['customer']['mobile']}}-{{$payment['customer']['address']}})</td>
                    <td>Invoice No #{{$payment['invoice']['invoice_no']}}</td>
                    <td>{{date('d-M-Y',strtotime($payment['invoice']['date']))}}</td>
                    <td>{{$payment['paid_amount']}}</td>
                    @php
                    $total_paid += $payment['paid_amount'];
                    @endphp
                  </tr>
                   @endforeach
                   <tr>
                    <td style="text-align:right;" colspan="4"><strong>Grand Totual</strong></td>
                    <td>{{$total_paid}}</td>
                   </tr>
                  </tbody>
                </table>
       </div>
    </div>

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
                                        <p style="text-align:center;"><u>Owner Signature</u></p>
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

</body>
</html>
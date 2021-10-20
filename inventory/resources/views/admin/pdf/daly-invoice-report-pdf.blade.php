<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daly Invoice Report</title>
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
                            <td width="35%"></td>
                            <td width="40%"><span style="font-size:30px;">Glass & Dore</span><br><small>Baburhat,Chandpur</small></td>
                            <td width="25%"><small>Showrom :+88638793008</small></td>
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
                        <td width="20%"></td>
                        <td width="60%"><small style ="font-size:14px;"><strong>Daly Invoice Report({{date('d-m-Y',strtotime($fast_date))}}-{{date('d-m-Y',strtotime($last_date))}})</strong></small></td>
                        <td width="20%"></td>
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
                    <th width="18%">Date</th>
                    <th>Description</th>
                    <th>Due Amount</th>
                    <th>Paid Amount</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $key=>$invoice)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$invoice['payment']['customer']['name']}}</td>
                    <td>#{{$invoice->invoice_no}}</td>
                    <td>{{date('d-m-Y',strtotime($invoice->date))}}</td>
                    <td>{{$invoice['description']}}</td>
                    <td>{{$invoice['payment']['due_amount']}}</td>
                    <td>{{$invoice['payment']['paid_amount']}}</td>
                    <td>{{$invoice['payment']['total']}}</td>
                </tr>
                @endforeach
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
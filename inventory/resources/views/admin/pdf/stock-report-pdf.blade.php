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
                        <td width="45%"></td>
                        <td width="25%"><small style ="font-size:14px;"><strong>Stock Report</strong></small></td>
                        <td width="30%"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
        <table width="100%" border="1px;">
                  <thead>
                  <tr>
                    <th width="10%">Id</th>
                    <th>Supplier</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>In.Qty</th>
                    <th>Out.Qty</th>
                    <th>Stock</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($products as $key => $product)
                    @php 
                      $buying_total = App\Purchase::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status',1)->sum('buying_qty');
                      $selling_total = App\InvoiceDetail::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status',1)->sum('selling_qty');

                    @endphp
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{$product['supplier']['name']}}</td>
                    <td>{{$product['category']['name']}}</td>
                    <td>{{$product['product_name']}}</td>
                    <td>{{$buying_total}}</td>
                    <td>{{$selling_total}}</td>
                    <td>{{$product['quantity']}} {{$product['unit']['name']}}</td>
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
@extends("layouts.admin_layout.admin_layout")
  @section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menage Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Purchase</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Invoice No #{{$invoice['invoice_no']}}({{date('d-m-Y',strtotime($invoice['invoice_no']))}})</h3>
                <a href="{{url('admin/pandding-invoice')}}" style="float: right;"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-list"></i> Pandding Invoice List</button></a>
              </div>
              <!-- /.card-header -->
              @if(Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                {{Session::get('error_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
              <div class="card-body">
                <table width="100%">
                @php
                    $payment = App\Payment::where('invoice_id',$invoice->id)->first();
                @endphp
                    <tbody>
                        <tr>
                            <td width="15%"><p><strong>Customer Info</strong></p></td>
                            <td width="25%"><p><strong>Name :</strong> {{$payment['customer']['name']}}</p></td>
                            <td width="25%"><p><strong>Mobile :</strong> {{$payment['customer']['mobile']}}</p></td>
                            <td width="35%"><p><strong>Address :</strong> {{$payment['customer']['address']}}</p></td>
                        </tr>
                            <td width="15%"></td>
                            <td width="85%" colspan="3"><p><strong>Description :</strong>{{$invoice['description']}}</p></td>
                        <tr>
                        </tr>
                    </tbody>
                </table>
                <form action="{{url('admin/aprpoval-store/'.$invoice['id'])}}" method="post">
                    @csrf 
                    <table border="1" width="100%" style="margin-botton:10px;">
                    <thead>
                        <tr class="text-center">
                            <th>Sl.</th>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th style="background:#ddd;">Current Stock</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $total_sum = '0';
                        @endphp
                        @foreach($invoice['Invoice_details'] as $key => $detail)
                        <tr class="text-center">
                            <input type="hidden" name="category_id[]" value="{{$detail['category_id']}}">
                            <input type="hidden" name="product_id[]" value="{{$detail['product_id']}}">
                            <input type="hidden" name="selling_qty[{{$detail->id}}]" value="{{$detail['selling_qty']}}">
                            <td>{{$key+1}}</td>
                            <td>{{$detail['category']['name']}}</td>
                            <td>{{$detail['product']['product_name']}}</td>
                            <td style="background:#ddd;">{{$detail['product']['quantity']}}</td>
                            <td>{{$detail['selling_qty']}}</td>
                            <td>{{$detail['unit_price']}}</td>
                            <td>{{$detail['selling_price']}}</td>
                        </tr>
                        @php
                            $total_sum += $detail['selling_price'];
                        @endphp
                        @endforeach
                        <tr>
                            <td colspan="6" class="text-right"><strong>Sub Total</strong></td>
                            <td class="text-center"><strong>{{$total_sum}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right">Discount</td>
                            <td class="text-center">{{$payment['discount_amount']}}</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right">Paid Amount</td>
                            <td class="text-center">{{$payment['paid_amount']}}</td>
                        </tr>
                        @php 
                        $total_due = $total_sum - $payment['paid_amount'];
                        $total_due = $total_due - $payment['discount_amount'];
                        @endphp
                        <tr>
                            <td colspan="6" class="text-right">Due Amount</td>
                            <td class="text-center">{{$total_due}}</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right"><strong>Grand Total</strong></td>
                            <td class="text-center"><strong>{{$payment['total']}}</strong></td>
                        </tr>
                    </tbody>
                    
                </table>
                <br>
                <button type="submit" class="btn btn-success btn-sm">Invoice Approve</button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
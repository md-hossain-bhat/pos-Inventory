@extends("layouts.admin_layout.admin_layout")
@section('title','Edit Cadit Customer')
  @section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menage Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customer</li>
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
                <h3 class="card-title">Edit Cradit Customer (Invoice No.#{{$payment['invoice']['invoice_no']}})</h3>
                <a href="{{url('admin/cradit')}}" style="float: right;"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-list"></i> Cradit Customer List</button></a>
              </div>
              @if(Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                {{Session::get('error_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
              <!-- /.card-header -->
              <div class="card-body">
              <table width="100%">

                <tbody>
                    <tr>
                        <td colspan="3"><strong>Customer Info</strong></td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Name :</strong> {{$payment['customer']['name']}}</td>
                        <td width="40%"><strong>Mobile :</strong> {{$payment['customer']['mobile']}}</td>
                        <td width="30%"><strong>Address :</strong> {{$payment['customer']['address']}}</td>
                    </tr>
                </tbody>
                </table>
                <form action="{{url('admin/invoice-update/'.$payment['invoice_id'])}}" method="post" form="invoiceUpdareForm">
               @csrf
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
                        <tr>
                            <td colspan="5" class="text-right">Due Amount</td>
                            <td class="text-center">{{$payment['due_amount']}}</td>
                            <input type="hidden" name="new_paid_amount" value="{{$payment['due_amount']}}">
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right"><strong>Grand Total</strong></td>
                            <td class="text-center"><strong>{{$payment['total']}}</strong></td>
                        </tr>
                    </tbody>
                    
                </table>

                 <div class="row">
                    <div class="form-group col-md-3">
                        <label>Paid Status</label>
                        <select name="paid_status" id="paid_status" required class="form-control form-control-md">
                            <option value="">Setect Status</option>
                            <option value="full_paid">Full Paid</option>
                            <option value="partial_paid">Partial Paid</option>
                        </select>
                        <input type="text" name="paid_amount" id="paid_amount" class="form-control form-control-sm paid_amount" placeholder="Enter paid amount" style="display:none;">
                    </div>
                    <div class="col-md-2">
                    <div class="form-group">
	                    <label>Date</label>
	                    <input type="text" name="date" class="form-control" readonly id="craditDate" required placeholder="MM/DD/YYYY">
	                </div>
                  </div>
                  <div class="form-group col-md-3" style="padding-top:34px;">
                    <button type="submit" class="btn btn-success btn-sm">Invoice Update</button>
                  </div>
                </div>
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
@extends("layouts.admin_layout.admin_layout")
@section('title','Paid Customer Wise Report List')
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
                <h3 class="card-title">Paid Customer</h3>
                <a href="{{url('admin/paid-pdf')}}" target="_blanck" style="float: right;"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-download"></i> Download Pdf</button></a>
              </div>
              @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                {{Session::get('success_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
              <!-- /.card-header -->
              <div class="card-body">
              <table id="customers" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Customer Name</th>
                    <th>Invoice No.</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php 
                    $total_paid = '0';
                  @endphp
                    @foreach($payments as $key => $payment)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ucfirst($payment['customer']['name'])}} ({{$payment['customer']['mobile']}}-{{$payment['customer']['address']}})</td>
                    <td>Invoice No #{{$payment['invoice']['invoice_no']}}</td>
                    <td>{{date('d-M-Y',strtotime($payment['invoice']['date']))}}</td>
                    <td>{{$payment['paid_amount']}}</td>
                    <td>
                     <a title="vie details" target="_blanck" href="{{url('admin/invoice-details/pdf/'.$payment['invoice_id'])}}"><i style="color:green;" class="fa fa-eye"></i></a></td>
                     @php
                    $total_paid += $payment['paid_amount'];
                    @endphp
                  </tr>
                  
                   @endforeach
                  </tbody>
                </table>
                <table class="table table-bordered table-striped">
                  <tbody>
                  <tr>
                  <td style="text-align:right;" colspan="6"><strong>Grand Totual</strong></td>
                    <td>{{$total_paid}}</td>
                  </tr>
                  </tbody>
                </table>
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
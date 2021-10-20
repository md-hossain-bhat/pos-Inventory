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
              <li class="breadcrumb-item active">Invoice</li>
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
                <h3 class="card-title"> Invoices</h3>
               
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
                <table id="invoices" class="table table-bordered table-striped table-responsive">
                  <thead>
                  <tr>
                    <th width="10%">SL.</th>
                    <th>Customer Name</th>
                    <th>Invoice No.</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th width="6%">Amount</th>
                    <th>Print</th>
                  </tr>
                  </thead>
                  <tbody>
                   @foreach($invoices as $key=>$invoice)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$invoice['payment']['customer']['name']}} ({{$invoice['payment']['customer']['mobile']}}-{{$invoice['payment']['customer']['address']}})</td>
                    <td>Invoice No #{{$invoice->invoice_no}}</td>
                    <td>{{date('d-m-Y',strtotime($invoice->date))}}</td>
                    <td>{{$invoice['description']}}</td>
                    <td>{{$invoice['payment']['total']}}</td>
                    <td><a title="print invoice" class="btn btn-success btn-sm" target="_blanck" href="{{url('admin/print-invoice/'.$invoice['id'])}}"><i class="fa fa-print"></i></a></td>
                  </tr>
                  @endforeach
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
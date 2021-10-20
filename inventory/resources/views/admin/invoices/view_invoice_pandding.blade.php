@extends("layouts.admin_layout.admin_layout")
  @section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Invoice</h1>
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
                <h3 class="card-title">Invoices Pandding List</h3>
                <!-- <a href="{{url('admin/add-invoice')}}" style="float: right;"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add Invoice</button></a> -->
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
                    <th>Amount</th>
                    <th>Status</th>
                    <th width="10%">Action</th>
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
                    <td>
                    @if($invoice['status']==1)
                      <button class="btn btn-success btn-sm">Approved</button>
                    @else
                    <button class="btn btn-warning btn-sm">Pandding</button>
                    @endif
                    </td>
                    <td>
                    @if($invoice['status']==0)
                     <a title="Approve"   href="{{url('admin/approve-invoice/'.$invoice['id'])}}"><i class="fa fa-check-circle btn btn-success btn-sm"></i></a>
                     @endif
                     / <a class="confirmDelete btn btn-danger btn-sm" record="invoice" recoedid="{{$invoice['id']}}" href="javascript:void('0')"><i class="fa fa-trash"></i></a>
                     </td>
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
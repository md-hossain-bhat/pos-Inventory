@extends("layouts.admin_layout.admin_layout")
  @section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menage Purchase</h1>
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
                <h3 class="card-title"> Purchases</h3>
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
                <table id="purchases" class="table table-bordered table-striped table-responsive">
                  <thead>
                  <tr>
                    <th width="10%">SL.</th>
                    <th>Purchase No</th>
                    <th>Date</th>
                    <th>Supplier Name</th>
                    <th>Category name</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Buying Price</th>
                    <th>Status</th>
                    <th width="5%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($purchases as $key => $purchase)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{$purchase['purchase_no']}}</td>
                    <td>{{date('d-M-Y',strtotime($purchase['date']))}}</td>
                    <td>{{$purchase['supplier']['name']}}</td>
                    <td>{{$purchase['category']['name']}}</td>
                    <td>{{$purchase['product']['product_name']}}</td>
                    <td>{{$purchase['description']}}</td>
                    <td>{{$purchase['buying_qty']}}{{$purchase['product']['unit']['name']}}</td>
                    <td>{{$purchase['unit_price']}}</td>
                    <td>{{$purchase['buying_price']}}</td>
                    <td>
                    @if($purchase['status']==1)
                      <button class="btn btn-success btn-sm">Approved</button>
                    @else
                    <button class="btn btn-warning btn-sm">Pandding</button>
                    @endif
                    </td>
                    <td>
                    @if($purchase['status']==0)
                     <a title="Approve" class="confirmApprove" record="purchase" recoedid="{{$purchase['id']}}" href="javascript:void('0')"><i class="fa fa-check-circle btn btn-success"></i></a>
                     @endif
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
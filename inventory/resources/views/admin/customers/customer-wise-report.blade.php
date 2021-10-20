@extends("layouts.admin_layout.admin_layout")
@section('title','Customer Wise Report List')
  @section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Manage Customer</h1>
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
                <h3 class="card-title">Select Criteria</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-6" style="margin-left:260px">
                        <strong>Cradit wise Report</strong>
                        <input type="radio" name="customer_wise_report" value="cadit_wise" class="serch_value">
                        &nbsp;&nbsp;
                        <strong>Paid wise Report</strong>
                        <input type="radio" name="customer_wise_report" value="paid_wise" class="serch_value">
                        
                    </div>
                </div>
                <br>
                <div class="show_cradit" style="display:none;">
                    <form method="get" target="_blanck" action="{{url('admin/cradit/report/pdf')}}" id="craditWiseForm">
                        <div class="form-row">
                            <div class="col-sm-8">
                                <label>Customer Name</label>
                                <select name="customer_id" required class="form-control suppliers">
                                    <option value="">select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer['id']}}">{{$customer['name']}}({{$customer['mobile']}}-{{$customer['address']}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4" style="padding-top:30px;">
                                <button Type="submit" class="btn btn-success">Serch</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="show_paid" style="display:none;">
                    <form method="get" target="_blanck" action="{{url('admin/paid/report/pdf')}}" id="paidWiseForm">
                        <div class="form-row">
                        <div class="col-sm-8">
                                <label>Customer Name</label>
                                <select name="customer_id" required class="form-control suppliers">
                                    <option value="">select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer['id']}}">{{$customer['name']}}({{$customer['mobile']}}-{{$customer['address']}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2" style="padding-top:30px;">
                                <button Type="submit" class="btn btn-success">Serch</button>
                            </div>
                        </div>
                    </form>
                </div>
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
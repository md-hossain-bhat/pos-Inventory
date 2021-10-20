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
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Select Criteria</h3>
          </div>
            <div class="card-body">
            <form role="form"  action="{{url('admin/daly-report-invoice-pdf')}}" method="get" target="_blanck" id="dalyReportForm"> 
                <div class="card-body">
                <div class="form-row">
                <div class="col-sm-5">
                  <div class="form-group">
                    <label>Fast Date</label>
                    <input type="text" name="fast_date"  class="form-control" id="fast_date" readonly placeholder="select date">
                  </div>
                </div>
                <div class="col-sm-5">
                  <div class="form-group">
                    <label>Last Date</label>
                    <input type="text" name="last_date" class="form-control" id="last_date" readonly placeholder="select date">
                  </div>
                </div>
                <div class="col-sm-2">
                <div class="card-footer" style="padding-top:30px;">
                  <button type="submit" class="btn btn-primary">Serch</button>
                </div>
                </div>
                </div>
                <!-- /.card-body -->

                </div>
              </form> 
	        </div>
            <!-- /.row -->
          </div>
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


  @endsection

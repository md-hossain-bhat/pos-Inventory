@extends("layouts.admin_layout.admin_layout")
  @section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menage Stock</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Stock</li>
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
                <h3 class="card-title">Stocks</h3>
                <a href="{{url('admin/stock-report-pdf')}}" target="_black" style="float: right;"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-download"></i> Download Pdf</button></a>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="stocks" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="10%">Id</th>
                    <th>Supplier</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>In.Qty</th>
                    <th>Out.Qty</th>
                    <th>Stock</th>
                    <th>Unit</th>
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
                    <td>{{$product['quantity']}}</td>
                    <td>{{$product['unit']['name']}}</td>
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
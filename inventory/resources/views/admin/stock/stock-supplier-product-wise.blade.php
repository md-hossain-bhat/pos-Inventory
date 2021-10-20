@extends("layouts.admin_layout.admin_layout")
  @section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menage Products</h1>
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
                <h3 class="card-title">Select Criteria</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-6" style="margin-left:260px">
                        <strong>Suppler wise Report</strong>
                        <input type="radio" name="supplier_product_wise" value="Supplier_wise" class="serch_value">
                        &nbsp;&nbsp;
                        <strong>Product wise Report</strong>
                        <input type="radio" name="supplier_product_wise" value="Product_wise" class="serch_value">
                        
                    </div>
                </div>
                <br>
                <div class="show_supplier" style="display:none;">
                    <form method="get" target="_blanck" action="{{url('admin/stock-supplier-wise-pdf')}}" id="supplierWiseForm">
                        <div class="form-row">
                            <div class="col-sm-8">
                                <label>Supplier Name</label>
                                <select name="supplier_id" required class="form-control suppliers">
                                    <option value="">select supplier</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{$supplier['id']}}">{{$supplier['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4" style="padding-top:30px;">
                                <button Type="submit" class="btn btn-success">Serch</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="show_product" style="display:none;">
                    <form method="get" target="_blanck" action="{{url('admin/stock-product-wise-pdf')}}" id="productWiseForm">
                        <div class="form-row">
                        <div class="col-sm-4">
                            <label>Category Name</label>
                            <select name="category_id" id="category_id" required class="form-control category" style="width: 100%;">
                              <option value="">Select</option>
                              @foreach($categories as $category)
                                  <option value="{{$category['id']}}">{{$category['name']}}</option>
                              @endforeach
                            </select>
                          </div>
                            <div class="col-sm-6">
                                <label>Product Name</label>
                                <select name="product_id" required id="product_id" class="form-control products" style="width: 100%;">
                                  <option value="">Select</option>
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
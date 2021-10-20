@extends("layouts.admin_layout.admin_layout")
@section('title',$title)
  @section("content")
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
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
            <h3 class="card-title">{{ $title }}</h3>
            <a href="{{url('admin/products')}}" style="float:right;"><button class="btn btn-success btn-sm"><i class="fas fa-list"></i> Product List</button></a>
          </div>
          <div class="card-body">
              @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 10px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
          	<form name="productForm" id="productForm" @if(empty($productdata['id'])) action="{{url('admin/add-edit-product')}}" @else   action="{{url('admin/add-edit-product/'.$productdata['id'] )}}" @endif method="post">
          		@csrf
	            <div class="row">
	              <div class="col-md-6">

                  <div class="form-group">
	                  <label>Select Category</label>
	                  <select name="category_id" id="category_id1" class="form-control category" style="width: 100%;">
	                    <option value="0">Select</option>
	                     @foreach($categories as $category)
							   <option value="{{$category['id']}}" @if(!empty($productdata['category_id']) && $productdata['category_id'] == $category['id']) selected="" @endif>{{$category['name']}}</option>
	                    @endforeach
	                  </select>
	                </div>

                  <div class="form-group">
	                  <label>Select Unit</label>
	                  <select name="unit_id" id="unit_id" required class="form-control units" style="width: 100%;">
	                    <option value="0">Select</option>
	                     @foreach($units as $unit)
							            <option value="{{$unit['id']}}" @if(!empty($productdata['unit_id']) && $productdata['unit_id'] == $unit['id']) selected="" @endif>{{$unit['name']}}</option>
	                    @endforeach
	                  </select>
	                </div>
                  <div class="form-group">
	                  <label>Select Supplier</label>
	                  <select name="supplier_id" id="supplier_id1" class="form-control suppliers" style="width: 100%;">
	                    <option value="0">Select</option>
	                     @foreach($suppliers as $supplier)
							            <option value="{{$supplier['id']}}" @if(!empty($productdata['supplier_id']) && $productdata['supplier_id'] == $supplier['id']) selected="" @endif>{{$supplier['name']}}</option>
	                    @endforeach
	                  </select>
	                </div>
	              	<div class="form-group">
	                    <label for="product_name">Product Name</label>
	                    <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter  Name" @if(!empty($productdata['product_name'])) value="{{$productdata['product_name']}}" @else value="{{ old('product_name')}}" @endif>
	                 </div>
	                 <div class="card-footer">
                   @if(empty($productdata['id'])) 
                    <button type="submit" class="btn btn-primary">Create</button>
                    @else   
                    <button type="submit" class="btn btn-primary">Update</button>
                    @endif
	                </div>
	              </div>

	              <!-- /.col -->
	            </div>
            </form>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection

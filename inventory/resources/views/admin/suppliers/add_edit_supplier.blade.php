@extends("layouts.admin_layout.admin_layout")
  @section('title',$title)
  @section("content")
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Supplier</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Supplier</li>
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
            <a href="{{url('admin/suppliers')}}" style="float:right;"><button class="btn btn-success btn-sm"><i class="fas fa-list"></i> Supplier List</button></a>

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

          	<form name="supplierForm" id="supplierForm" @if(empty($supplierdata['id'])) action="{{url('admin/add-edit-supplier')}}" @else   action="{{url('admin/add-edit-supplier/'.$supplierdata['id'] )}}" @endif method="post">
          		@csrf
	            <div class="row">
	              <div class="col-md-6">
	              	<div class="form-group">
	                    <label for="name">Supplier Name</label>
	                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter  Name" @if(!empty($supplierdata['name'])) value="{{$supplierdata['name']}}" @else value="{{ old('name')}}" @endif>
	                 </div>
                     <div class="form-group">
	                    <label for="email">Email</label>
	                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter  email" @if(!empty($supplierdata['email'])) value="{{$supplierdata['email']}}" @else value="{{ old('email')}}" @endif>
	                 </div>
                     <div class="form-group">
	                    <label for="mobile">Mobile</label>
	                    <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter mobile" @if(!empty($supplierdata['mobile'])) value="{{$supplierdata['mobile']}}" @else value="{{ old('mobile')}}" @endif>
	                 </div>
                     <div class="form-group">
	                    <label for="address">Address</label>
	                    <input type="text" name="address" class="form-control" id="address" placeholder="Enter  address" @if(!empty($supplierdata['address'])) value="{{$supplierdata['address']}}" @else value="{{ old('address')}}" @endif>
	                 </div> 
	                 <div class="card-footer">
                    @if(empty($supplierdata['id'])) 
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

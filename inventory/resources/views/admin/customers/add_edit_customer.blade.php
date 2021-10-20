@extends("layouts.admin_layout.admin_layout")
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
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <a href="{{url('admin/customers')}}" style="float:right;"><button class="btn btn-success btn-sm"><i class="fas fa-list"></i> Customer List</button></a>
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
              @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                {{Session::get('success_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
          	<form name="customerForm" id="customerForm" @if(empty($customerdata['id'])) action="{{url('admin/add-edit-customer')}}" @else   action="{{url('admin/add-edit-customer/'.$customerdata['id'] )}}" @endif method="post">
          		@csrf
	            <div class="row">
	              <div class="col-md-6">
	              	<div class="form-group">
	                    <label for="name">Customer Name</label>
	                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter  Name" @if(!empty($customerdata['name'])) value="{{$customerdata['name']}}" @else value="{{ old('name')}}" @endif>
	                 </div>
                     <div class="form-group">
	                    <label for="email">Email</label>
	                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter  email" @if(!empty($customerdata['email'])) value="{{$customerdata['email']}}" @else value="{{ old('email')}}" @endif>
	                 </div>
                     <div class="form-group">
	                    <label for="mobile">Mobile</label>
	                    <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter mobile" @if(!empty($customerdata['mobile'])) value="{{$customerdata['mobile']}}" @else value="{{ old('mobile')}}" @endif>
	                 </div>
                     <div class="form-group">
	                    <label for="address">Address</label>
	                    <input type="text" name="address" class="form-control" id="address" placeholder="Enter  address" @if(!empty($customerdata['address'])) value="{{$customerdata['address']}}" @else value="{{ old('address')}}" @endif>
	                 </div> 
	                 <div class="card-footer">
                   @if(empty($customerdata['id'])) 
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

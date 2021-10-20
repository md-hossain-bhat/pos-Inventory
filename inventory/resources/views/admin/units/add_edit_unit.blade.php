@extends("layouts.admin_layout.admin_layout")
  @section('title',$title)
  @section("content")
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Unit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Unit</li>
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
            <a href="{{url('admin/units')}}" style="float:right;"><button class="btn btn-success btn-sm"><i class="fas fa-list"></i> Unit List</button></a>

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

          	<form name="unitForm" id="unitForm" @if(empty($unitdata['id'])) action="{{url('admin/add-edit-unit')}}" @else   action="{{url('admin/add-edit-unit/'.$unitdata['id'] )}}" @endif method="post">
          		@csrf
	            <div class="row">
	              <div class="col-md-6">
	              	<div class="form-group">
	                    <label for="name">Unit Name</label>
	                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter  Name" @if(!empty($unitdata['name'])) value="{{$unitdata['name']}}" @else value="{{ old('name')}}" @endif>
	                 </div>
	                 <div class="card-footer">
                   @if(empty($unitdata['id'])) 
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

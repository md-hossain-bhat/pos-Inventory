  @extends("layouts.admin_layout.admin_layout")
  @section('title','Edit User')
  @section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edit User</h3>
                <a href="{{url('admin/admins')}}" style="float:right;"><button class="btn btn-success btn-sm"><i class="fas fa-list"></i> User List</button></a>
              </div>
              @if(Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                {{Session::get('error_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif


              @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 10px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
              <!-- form start -->
              <form role="form" action="{{url('admin/edit-admin/'.$adminDetails->id)}}" method="post" name="admin-user" id="admin-user">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">User Name</label>
                    <input type="text" name="name"  class="form-control" id="name" placeholder="user name" value="{{$adminDetails->name}}">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email"  class="form-control" id="email" placeholder="use email" value="{{$adminDetails->email}}">
                  </div>
                  <div class="form-group">
                    <label for="name">Password</label>
                    <input type="password" name="password"  class="form-control" id="password" placeholder="current password or new Pssaword">
                  </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select name="type" id="type" required class="form-control">
                          @if(Session::get('admiDetails')['type'] == "Super Admin")
                          <option {{ ($adminDetails->type) == 'Super Admin' ? 'selected' : '' }}  value="Super Admin">Super Admin</option>
                          @endif
                          <option {{ ($adminDetails->type) == 'Admin' ? 'selected' : '' }}  value="Admin">Admin</option>
                          <option {{ ($adminDetails->type) == 'Sub Admin' ? 'selected' : '' }}  value="Sub Admin">Sub Admin</option>
                        </select>
                      </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->


          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
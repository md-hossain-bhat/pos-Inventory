  @extends("layouts.admin_layout.admin_layout")
  @section('title','Users')
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users</h3>
                <a href="{{url('admin/add-admin')}}" style="float: right;"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add User</button></a>
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
                <table id="users" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($admins as $admin)
                  <tr>
                    <td>{{$admin['id']}}</td>
                    <td>{{ucfirst($admin['name'])}}</td>
                    <td>{{$admin['email']}}</td>
                    <td>{{ucfirst($admin['type'])}}</td>
                    <td>
                      <?php $admin_image_path = "images/admin_img/admin_photo/".$admin['image']; ?>
                      @if(!empty($admin['image']) && file_exists($admin_image_path))
                        <img src="{{asset($admin_image_path)}}" width="50" alt="profile">
                      @else
                        <img src="{{asset('images/admin_img/admin_photo/no-image.png')}}" width="50" alt="no-image">
                      @endif
                    </td>
                    @php
                      $count = App\Product::where('user_id',$admin['id'])->count();
                    @endphp
                    <td>
                      @if($admin['type'] !=='Super Admin' || Session::get('admiDetails')['type'] == "Super Admin")
                      
                      @if($admin['status'] ==1)
                        <a class="updateAdminStatus" id="admin-{{$admin['id']}}" admin_id="{{$admin['id']}}" href="javascript:void(0)"><i class="fa fa-toggle-on" aria-hidden="true" Status="Active"></i></a>
                      @else
                        <a class="updateAdminStatus" id="admin-{{$admin['id']}}" admin_id="{{$admin['id']}}" href="javascript:void(0)"><i class="fa fa-toggle-off" aria-hidden="true" Status="Inactive"></i></a>
                      @endif
                      &nbsp;/&nbsp;
                      
                      <a href="{{url('admin/edit-admin/'.$admin['id'])}}" title="admin edit"><i class="fas fa-edit"></i></a> 

                      @if($count < 1) /  <a
                     class="confirmDelete" record="admin" recoedid="{{$admin['id']}}" href="javascript:void('0')"><i style="color:red;" class="fa fa-trash"></i></a>
                     @endif
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
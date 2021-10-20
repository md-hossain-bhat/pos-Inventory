  @extends("layouts.admin_layout.admin_layout")
  @section('title','Profile')
  @section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            @if(Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                {{Session::get('error_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
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

              @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 10px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                <?php $image_path = "images/admin_img/admin_photo/".Auth::guard('admin')->user()->image;?>
                  @if(!empty(Auth::guard('admin')->user()->image) && file_exists($image_path))
                  <img class="profile-user-img img-fluid img-circle"
                              src="{{asset('images/admin_img/admin_photo/'.Auth::guard('admin')->user()->image)}}"
                              alt="User profile picture">
                  @else
                      <img class="img-circle" width="60px" src="{{asset('images/admin_img/admin_photo/no-image.png')}}">
                  @endif
                  
                </div>

                <h3 class="profile-username text-center">{{ Auth::guard('admin')->user()->name }}</h3>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>{{ ucfirst(Auth::guard('admin')->user()->type) }}</b> <a class="float-right"></a>
                  </li>
                  <li class="list-group-item">
                    <b>{{ Auth::guard('admin')->user()->email }}</b> <a class="float-right"></a>
                  </li>
                  <li class="list-group-item">
                    <b>{{ Auth::guard('admin')->user()->mobile }}</b> <a class="float-right"></a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Edit User</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Change Password</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                 
                    <form class="form-horizontal" action="{{ url('/admin/admin-details') }}" method="post" id="admin-details" name="admin-details" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="name" class="form-control" id="name" value="{{ Auth::guard('admin')->user()->name }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" name="email" readonly class="form-control" id="email" value="{{ Auth::guard('admin')->user()->email }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">User Type</label>
                        <div class="col-sm-10">
                          <input type="text" name="type" readonly class="form-control" id="type" value="{{ ucfirst(Auth::guard('admin')->user()->type) }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="mobile" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                          <input type="text" name="mobile" class="form-control" id="mobile" value="{{ Auth::guard('admin')->user()->mobile }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="image" class="col-sm-2 col-form-label">upload photo</label>
                        <div class="col-sm-10">
                          <input type="file" required name="image" class="form-control" id="image" accept="image*/">
                        </div>
                      </div>

                      <div style="float: right;">


                      <?php $image_path = "images/admin_img/admin_photo/".Auth::guard('admin')->user()->image;?>
                      @if(!empty(Auth::guard('admin')->user()->image) && file_exists($image_path))
                        <img width="60" class="img-circle" src="{{ asset('images/admin_img/admin_photo/'.Auth::guard('admin')->user()->image) }}" alt="user photo">
                        @else
                        <img class="img-circle" width="60px" src="{{asset('images/admin_img/admin_photo/no-image.png')}}">
                        @endif
                        
                        @if(!empty(Auth::guard('admin')->user()->image) && file_exists($image_path))
                        | <a title="delete Image" class="confirmDelete" record="image" recoedid="{{Auth::guard('admin')->user()->id}}" href="javascript:void('0')"><i style="color:red;" class="fa fa-trash"></i></a>
                        @endif


                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                    </form>
                  
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" action="{{ url('/admin/update-pwd') }}" method="post" id="settings" name="settings">
                      @csrf
                      <div class="form-group row">
                        <label for="current_pwd" class="col-sm-2 col-form-label">Current Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="current_pwd" id="current_pwd" placeholder="current password">
                          <span id="chkPwd"></span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="new_pwd" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="new_pwd" id="new_pwd" placeholder="new password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="confirm_pwd" class="col-sm-2 col-form-label">Confirm New Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="confirm_pwd" id="confirm_pwd" placeholder="confirm new password">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
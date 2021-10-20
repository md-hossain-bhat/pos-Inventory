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
              <li class="breadcrumb-item active">Setting</li>
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
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Profile Details</h3>
              </div>
              <!-- /.card-header -->
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
              <!-- form start -->
              <form role="form" action="{{ url('/admin/admin-details') }}" method="post" name="admin-details" id="admin-details" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" readonly class="form-control" id="email" value="{{ Auth::guard('admin')->user()->email }}">
                  </div>
                  <div class="form-group">
                    <label for="type">Type</label>
                    <input type="text" name="type" readonly class="form-control" id="type" value="{{ Auth::guard('admin')->user()->type }}">
                  </div>
                  <div class="form-group">
                    <label for="name">User Name</label>
                    <input type="text" name="name"  class="form-control" id="name" value="{{ Auth::guard('admin')->user()->name }}" placeholder="User name">
                  </div>
                  <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" name="mobile"  class="form-control" id="mobile" value="{{ Auth::guard('admin')->user()->mobile }}" placeholder="Enter mobile">
                  </div>
                  <div class="form-group">
                    <label for="image">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="image" accept="image*/">
                        <label class="custom-file-label" for="image">Choose file</label>

                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>
                     @if(!empty(Auth::guard('admin')->user()->image))
                        <a target="_blank" href="{{ url('images/admin_img/admin_photo/'.Auth::guard('admin')->user()->image) }}">View Image</a>
                        <input type="hidden" name="image" value="{{ Auth::guard('admin')->user()->image }}">
                        @endif
                      </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
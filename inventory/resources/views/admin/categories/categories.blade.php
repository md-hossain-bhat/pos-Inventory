@extends("layouts.admin_layout.admin_layout")
@section('title','Categories')
  @section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menage Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
                <h3 class="card-title"> Categories</h3>
                <a href="{{url('admin/add-edit-category')}}" style="float: right;"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add Category</button></a>
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
                <table id="categories" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="10%">Id</th>
                    <th>Name</th>
                    <th width="12%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($categories as $key => $category)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ucfirst($category['name'])}}</td>
                    @php
                      $count = App\Product::where('category_id',$category->id)->count();
                    @endphp
                    <td>
                      <a href="{{url('admin/add-edit-category/'.$category['id'])}}" title="category edit"><i class="fas fa-edit"></i></a> 
                      @if($count < 1) /  <a
                     class="confirmDelete" record="category" recoedid="{{$category['id']}}" href="javascript:void('0')"><i style="color:red;" class="fa fa-trash"></i></a>
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
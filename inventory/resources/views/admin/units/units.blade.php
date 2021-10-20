@extends("layouts.admin_layout.admin_layout")
  @section('title','Units')
  @section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menage Unit</h1>
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
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Units</h3>
                <a href="{{url('admin/add-edit-unit')}}" style="float: right;"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add Unit</button></a>
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
                <table id="units" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="10%">Id</th>
                    <th>Name</th>
                    <th width="12%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($units as $key => $unit)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ucfirst($unit['name'])}}</td>
                    @php
                      $count = App\Product::where('unit_id',$unit->id)->count();
                    @endphp
                    <td>
                      <a href="{{url('admin/add-edit-unit/'.$unit['id'])}}" title="unit edit"><i class="fas fa-edit"></i></a> 
                      @if($count < 1) /  <a
                     class="confirmDelete" record="unit" recoedid="{{$unit['id']}}" href="javascript:void('0')"><i style="color:red;" class="fa fa-trash"></i></a>
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
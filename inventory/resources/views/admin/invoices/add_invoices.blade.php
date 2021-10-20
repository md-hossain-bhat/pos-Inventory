@extends("layouts.admin_layout.admin_layout")
  @section("content")
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
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
            <h3 class="card-title">Invoices</h3>
            <a href="{{url('admin/invoice')}}" style="float:right;"><button class="btn btn-success btn-sm"><i class="fas fa-list"></i> Invoice List</button></a>
          </div>
          <div class="card-body">

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

	            <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
	                    <label>Invoice No</label>
	                    <input type="text" name="invoice_no" class="form-control" id="invoice_no" value={{$invoice_no}} readonly>
	                </div>
                  </div>
	              <div class="col-md-2">
                  <div class="form-group">
	                    <label>Date</label>
	                    <input type="text" name="date"  class="form-control" readonly id="datepicker2" placeholder="MM/DD/YYYY">
	                </div>
                  </div>

                  <div class="col-md-3">
                  <div class="form-group">
	                  <label>Category Name</label>
	                  <select name="category_id" id="category_id" class="form-control category" style="width: 100%;">
	                    <option value="0">Select</option>
                      @foreach($categories as $category)
							<option value="{{$category['id']}}">{{$category['name']}}</option>
	                    @endforeach
	                  </select>
	                </div>
                  </div>
                  <div class="col-md-2">
                  <div class="form-group">
	                  <label>Product Name</label>
	                  <select name="product_id" id="product_id" class="form-control products" style="width: 100%;">
	                    <option value="0">Select</option>
                      
	                  </select>
	                </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
	                    <label>Stock(kg/pcs)</label>
	                    <input type="text" name="current_stock_qty" class="form-control" id="current_stock_qty" readonly>
	                </div>
                  </div>

                <div class="card-footer" style="padding-top:30px;">
	                  <button type="submit" class="btn btn-success btn-sm addeventInvoicemore"><i class="fas fa-plus"></i> Add</button>
	                </div>
	              <!-- /.col -->
	            </div>
            <!-- /.row -->
          </div>
          <div class="card-body">
                <form method="post" action="{{url('admin/store-invoice')}}" id="invoiceStoreForm">
                @csrf
                <table class="table table-bordered table-striped table-responsive">
                  <thead>
                  <tr>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>Pcs/kg</th>
                    <th>Unit Price</th>
                    <th width="18%">Total Price</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="addrow" class="addrow">

                  </tbody>
                  <tbody>
                     <tr>
                        <td colspan="4">Discount</td>
                        <td><input type="text" name="discount_amount" id="discount_amount" class="form-control form-control-sm discount_amount text-right" placeholder="Enter discount amount"></td>
                     </tr>
                    <tr>
                    <td colspan="4"></td>
                    <td>
                      <input type="text" name="estamited_amount" id="estamited_amount" value="0" class="form-control form-control-sm text-right estamited_amount" readonly>
                    </td>
                    <td></td>
                    </tr>
                  </tbody>
                </table>
                <br>
                <td class="form-row">
                    <div class="form-group col-md-12">
                        <textarea name="description" id="description" class="form-control" placeholder="write description here"></textarea>
                    </div>
                </td>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Paid Status</label>
                        <select name="paid_status" id="paid_status" class="form-control form-control-md">
                            <option value="">Setect Status</option>
                            <option value="full_paid">Full Paid</option>
                            <option value="full_due">Full Due</option>
                            <option value="partial_paid">Partial Paid</option>
                        </select>
                        <input type="text" name="paid_amount" id="paid_amount" class="form-control form-control-sm paid_amount" placeholder="Enter paid amount" style="display:none;">
                    </div>
                    <div class="form-group col-md-9">
                        <label>Customer Name</label>
                        <select name="customer_id" id="customer_id" class="form-control form-control-sm customer">
                            <option value="">Setect customer</option>
                            <option value="0">Add New Customer</option>
                            @foreach($customers as $customer)
                            <option value="{{$customer['id']}}">{{$customer['name']}} ({{$customer['mobile']}}-{{$customer['address']}})</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="form-row new_customer" style="display:none;">
                      <div class="form-group col-md-4">
                        <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="write customer name">
                      </div>
                      <div class="form-group col-md-4">
                        <input type="text" name="mobile" id="mobile" class="form-control form-control-sm" placeholder="write customer phone">
                      </div>
                      <div class="form-group col-md-4">
                        <input type="text" name="address" id="address" class="form-control form-control-sm" placeholder="write customer address">
                      </div>
                    </div>
                <div class="card-footer" style="padding-top:30px;">
	                  <button type="submit" class="btn btn-success btn-sm" id="storeButton">Invoice Store</button>
	                </div>
                </form>
              </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script id="document-template" type="text/x-handlebars-template">
      <tr class="delete_add_more_item" id="delete_add_more_item">
        <input type="hidden" name="date"  value="@{{date}}">
        <input type="hidden" name="invoice_no"  value="@{{invoice_no}}">

        <td>
          <input type="hidden" name="category_id[]"  value="@{{category_id}}">
          @{{name}}
        </td>
        <td>
          <input type="hidden" name="product_id[]"  value="@{{product_id}}">
          @{{product_name}}
        </td>

        <td>
          <input type="number" min="1" name="selling_qty[]" class="form-control form-control-sm text-right selling_qty" value="1">
        </td>
        <td>
          <input type="number" min="1" name="unit_price[]" class="form-control form-control-sm text-right unit_price" value="">
        </td>
        <td>
          <input type="number" min="1" name="selling_price[]" class="form-control form-control-sm text-right selling_price" value="0">
        </td>
        <td>
          <i class="fa fa-times-circle btn btn-danger removeeventInvoicemore"></i>
        </td>
      </tr>
    </script>

  @endsection

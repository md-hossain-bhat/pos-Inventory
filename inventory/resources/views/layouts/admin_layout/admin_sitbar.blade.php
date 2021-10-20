<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('admin/dashboard')}}" class="brand-link">
      <img src="{{asset('images/admin_img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SuperShop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php $image_path = "images/admin_img/admin_photo/".Auth::guard('admin')->user()->image;?>
          @if(!empty(Auth::guard('admin')->user()->image) && file_exists($image_path))
            <img src="{{ url('images/admin_img/admin_photo/'.Auth::guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="User Image">
          @else
              <img class="img-circle" width="60px" src="{{asset('images/admin_img/admin_photo/no-image.png')}}">
          @endif
          
        </div>
        <div class="info">
          <a href="{{url('admin/setting')}}" class="d-block">{{ ucfirst(Auth::guard('admin')->user()->name) }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @if(Session::get('admiDetails')['type'] == "Super Admin" || Session::get('admiDetails')['type'] == "Manager")
          @if(Session::get('page') == 'admin')
            <?php $active = "active"; ?>
          @else
            <?php $active = ""; ?>
          @endif
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage User
                <i class="right fas fa-plus"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             @if(Session::get('page') == 'admin')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/admins')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Viue Users</p>
                </a>
              </li>

            </ul>
          </li>
          @if(Session::get('page') == 'suppliers')
            <?php $active = "active"; ?>
          @else
            <?php $active = ""; ?>
          @endif
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Supplier
                <i class="right fas fa-plus"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(Session::get('page') == 'suppliers')
                <?php $active = "active"; ?>
              @else
                <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{url('admin/suppliers')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Suppliers</p>
                </a>
              </li>

            </ul>
          </li>

          @endif

          @if(Session::get('page') == 'customers' || Session::get('page') == 'craditcustomers' || Session::get('page') == 'paidCustomer' || Session::get('page') == 'customerWise')
            <?php $active = "active"; ?>
          @else
            <?php $active = ""; ?>
          @endif

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
              Manage Customers
                <i class="right fas fa-plus"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(Session::get('page') == 'customers')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/customers')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Customers</p>
                </a>
              </li>
            @if(Session::get('page') == 'craditcustomers')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
          <li class="nav-item">
            <a href="{{url('admin/cradit')}}" class="nav-link {{$active}}">
            <i class="far fa-circle nav-icon"></i>
              <p>
              Cradit Customer
              </p>
            </a>
          </li>
          @if(Session::get('admiDetails')['type'] == "Super Admin")

            @if(Session::get('page') == 'paidCustomer')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
            <li class="nav-item">
              <a href="{{url('admin/paid')}}" class="nav-link {{$active}}">
              <i class="far fa-circle nav-icon"></i>
                <p>
                Paid Customer
                </p>
              </a>
            </li>
            @if(Session::get('page') == 'customerWise')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
            <li class="nav-item">
              <a href="{{url('admin/customer/wise/report')}}" class="nav-link {{$active}}">
              <i class="far fa-circle nav-icon"></i>
                <p>
                 Customer Wise Report
                </p>
              </a>
            </li>
            @endif
            </ul>
          </li>

          @if(Session::get('admiDetails')['type'] == "Super Admin" || Session::get('admiDetails')['type'] == "Manager")
           @if(Session::get('page') == 'units')
            <?php $active = "active"; ?>
          @else
            <?php $active = ""; ?>
          @endif
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
              Manage Unit
                <i class="right fas fa-plus"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             @if(Session::get('page') == 'units')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/units')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Units</p>
                </a>
              </li>

            </ul>
          </li>
            @if(Session::get('page') == 'categories')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
              Manage Category
                <i class="right fas fa-plus"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(Session::get('page') == 'categories')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/categories')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Categories</p>
                </a>
              </li>

            </ul>
          </li>
            @if(Session::get('page') == 'products')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif

             <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
              Manage Product
                <i class="right fas fa-plus"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(Session::get('page') == 'products')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/products')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Products</p>
                </a>
              </li>

            </ul>
          </li>

          @endif

          @if(Session::get('page') == 'purchases' || Session::get('page') == 'pandding' || Session::get('page') == 'dalypurchasereport')
          <?php $active = "active"; ?>
        @else
          <?php $active = ""; ?>
        @endif



          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
              Manage purchases
                <i class="right fas fa-plus"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(Session::get('page') == 'purchases')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/purchases')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Purchases</p>
                </a>
              </li>
              @if(Session::get('page') == 'pandding')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/pandding')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approval Purchases</p>
                </a>
              </li>
              @if(Session::get('admiDetails')['type'] == "Super Admin" || Session::get('admiDetails')['type'] == "Manager")

            @if(Session::get('page') == 'dalypurchasereport')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/daly-purchases-report')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daly Purchases Report</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @if(Session::get('page') == 'invoice' || Session::get('page') == 'pandding_invoice' || Session::get('page') == 'print_invoice' || Session::get('page') == 'daly_report')
          <?php $active = "active"; ?>
        @else
          <?php $active = ""; ?>
        @endif
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
              <p>Manage Invoices</p>
                <i class="right fas fa-plus"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(Session::get('page') == 'invoice')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/invoice')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Invoices</p>
                </a>
              </li>
              @if(Session::get('page') == 'pandding_invoice')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/pandding-invoice')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approval Invoice</p>
                </a>
              </li>
              @if(Session::get('page') == 'print_invoice')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/print-invoice-list')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Print Invoice</p>
                </a>
              </li>

              @if(Session::get('admiDetails')['type'] == "Super Admin" || Session::get('admiDetails')['type'] == "Manager")

              @if(Session::get('page') == 'daly_report')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/daly-report-invoice')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daly Report Invoice</p>
                </a>
              </li>

              @endif
            </ul>
          </li>

          @if(Session::get('admiDetails')['type'] == "Super Admin" || Session::get('admiDetails')['type'] == "Manager")

          @if(Session::get('page') == 'stockreport')
            <?php $active = "active"; ?>
          @else
            <?php $active = ""; ?>
          @endif
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
              Manage Stock
                <i class="right fas fa-plus"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(Session::get('page') == 'stockreport')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/stock-report')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Report</p>
                </a>
              </li>
              @if(Session::get('page') == 'stockSupplierProductwise')
              <?php $active = "active"; ?>
            @else
              <?php $active = ""; ?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/stock-supplier-product-wise')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product/Supplier Report</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          <li class="nav-item">
              <a href="{{url('admin/logout')}}" class="nav-link">
                <i class="fas fa-power-off nav-icon"></i>
              <p>Logout</p>
               </a>
            </li>

            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu stock-report-->
    </div>
    <!-- /.sidebar -->
  </aside>
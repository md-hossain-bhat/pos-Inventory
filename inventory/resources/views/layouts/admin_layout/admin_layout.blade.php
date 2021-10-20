<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name') }} | @yield('title') </title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css/admin_css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{asset('/css/style.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
    <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  @include("layouts.admin_layout.admin_header")
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include("layouts.admin_layout.admin_sitbar")

  <!-- Content Wrapper. Contains page content -->
  @yield("content")
  <!-- /.content-wrapper -->
  @include("layouts.admin_layout.admin_footer")

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

<!-- AdminLTE App -->
<script src="{{asset('js/admin_js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('js/admin_js/pages/dashboard.js')}}"></script>
<!-- jquery-validation -->
<script src="{{asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('plugins/jquery-validation/additional-methods.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>
<script src="{{asset('js/admin_js/demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{asset('js/admin_js/admin_script.js')}}"></script>
<script>
$(document).ready(function() {
    $('#datepicker').datepicker();
    $('#datepicker').on("changeDate", function() {
        $('#my_hidden_input').val(
            $('#datepicker').datepicker('getFormattedDate')
        );
    });
});
$(document).ready(function() {
    $('#datepicker2').datepicker();
    $('#datepicker').on("changeDate", function() {
        $('#my_hidden_input').val(
            $('#datepicker').datepicker('getFormattedDate')
        );
    });
});
$(document).ready(function() {
    $('#fast_date').datepicker();
    $('#datepicker').on("changeDate", function() {
        $('#my_hidden_input').val(
            $('#datepicker').datepicker('getFormattedDate')
        );
    });
});

$(document).ready(function() {
    $('#last_date').datepicker();
    $('#datepicker').on("changeDate", function() {
        $('#my_hidden_input').val(
            $('#datepicker').datepicker('getFormattedDate')
        );
    });
});
$(document).ready(function() {
    $('#craditDate').datepicker();
    $('#datepicker').on("changeDate", function() {
        $('#my_hidden_input').val(
            $('#datepicker').datepicker('getFormattedDate')
        );
    });
});

</script>
<script>
  $(function () {

    //Initialize Select2 Elements 
    $('.category_id1').select2({
      theme: 'bootstrap4'
    })
    $('.category').select2({
      theme: 'bootstrap4'
    })
    $('.units').select2({
      theme: 'bootstrap4'
    })
    $('.supplier_id1').select2({
      theme: 'bootstrap4'
    })
    $('.suppliers').select2({
      theme: 'bootstrap4'
    })
    $('.products').select2({
      theme: 'bootstrap4'
    })
    $('.customer').select2({
      theme: 'bootstrap4'
    })
    $('.users').select2({
      theme: 'bootstrap4'
    })

  })
</script>
<script>
      $(document).on('change','#paid_status',function(){
        var paid_status = $(this).val();
        if(paid_status == 'partial_paid'){
          $('.paid_amount').show();
        }else{
          $('.paid_amount').hide();
        }
      });
      $(document).on('change','#customer_id',function(){
        var customer_id = $(this).val();
        if(customer_id == '0'){
          $('.new_customer').show();
        }else{
          $('.new_customer').hide();
        }
      });
    </script>
<script>
  $(document).ready(function (){
        $(document).on('click','.addeventmore',function(){
        var date = $('#datepicker').val();
        var purchase_no = $('#purchase_no').val();
        var supplier_id = $('#supplier_id').val();
        var category_id = $('#category_id').val();
        var name = $('#category_id').find('option:selected').text();
        var product_id = $('#product_id').val();
        var product_name = $('#product_id').find('option:selected').text();


        if(date ==''){
          $.notify("date is require",{globalPosible: 'top right',className: 'error'});
          return false;
        }
        if(purchase_no ==''){
          $.notify("purchase_no is require",{globalPosible: 'top right',className: 'error'});
          return false;
        }
        if(supplier_id ==''){
          $.notify("supplier is require",{globalPosible: 'top right',className: 'error'});
          return false;
        }
        if(category_id ==''){
          $.notify("category is require",{globalPosible: 'top right',className: 'error'});
          return false;
        }
        if(product_id ==''){
          $.notify("product is require",{globalPosible: 'top right',className: 'error'});
          return false;
        }


        var source = $("#document-template").html();
        var template = Handlebars.compile(source);
        var data = {
          date:date,
          purchase_no:purchase_no,
          supplier_id:supplier_id,
          category_id:category_id,
          name:name,
          product_id:product_id,
          product_name:product_name
        };
        var html = template(data);
        $("#addrow").append(html);
        });

        $(document).on("click",".removeeventmore",function(event){
        $(this).closest(".delete_add_more_item").remove();
        totalAmountPrice();
        });

        $(document).on('keyup click','.unit_price,.buying_qty',function(){
          var unit_price = $(this).closest("tr").find("input.unit_price").val();
          var buying_qty = $(this).closest("tr").find("input.buying_qty").val();
          var total = unit_price * buying_qty;
          $(this).closest("tr").find("input.buying_price").val(total);
          totalAmountPrice();
        });

        function totalAmountPrice(){
          var sum =0;
          $(".buying_price").each(function(){
            var value = $(this).val();
            if(!isNaN(value) && value.length !=0){
              sum += parseFloat(value);
            }
          });
          $('#estamited_amount').val(sum);
        }
  });
</script>
<script>
  $(function () {
    $("#users").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $("#products").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $("#suppliers").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $("#customers").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $("#units").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $("#categories").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $("#invoices").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $("#stocks").DataTable({
      "responsive": true,
      "autoWidth": false,
    });

  });
</script>

  <script>
  $(function() {
    $(document).on('change','#supplier_id',function(){
      var supplier_id = $(this).val();
      $.ajax({
        url: "{{route('get-category')}}",
        type: "get",
        data:{supplier_id:supplier_id},
        success:function(data){
          var html ='<option value="">Select category</option>';
          $.each(data,function(key,v){
            html +='<option value="'+v.category_id+'">'+v.category.name+'</option>';
          });
          $('#category_id').html(html);
        }
      });
    });
  });
  </script>


    <script>
  $(function() {
    $(document).on('change','#category_id',function(){
      var category_id = $(this).val();
      $.ajax({
        url: "{{route('get-product')}}",
        type: "get",
        data:{category_id:category_id},
        success:function(data){
          var html ='<option value="">Select Product</option>';
          $.each(data,function(key,v){
            html +='<option value="'+v.id+'">'+v.product_name+'</option>';
          });
          $('#product_id').html(html);
        }
      });
    });
  });
  </script>
    <script>
        $(function(){
            $(document).on('change','#product_id',function(){
                var product_id = $(this).val();
                $.ajax({
                    url:"{{route('check-product-stock')}}",
                    type:"get",
                    data:{product_id:product_id},
                    success:function(data){
                        $('#current_stock_qty').val(data);
                    }
                });
            });
        });
    </script>
    <script>
  $(document).ready(function (){
        $(document).on('click','.addeventInvoicemore',function(){
        var date = $('#datepicker2').val();
        var invoice_no = $('#invoice_no').val();
        var category_id = $('#category_id').val();
        var name = $('#category_id').find('option:selected').text();
        var product_id = $('#product_id').val();
        var product_name = $('#product_id').find('option:selected').text();


        if(date ==''){
          $.notify("date is require",{globalPosible: 'top right',className: 'error'});
          return false;
        }
        if(invoice_no ==''){
          $.notify("invoice_no is require",{globalPosible: 'top right',className: 'error'});
          return false;
        }

        if(category_id ==''){
          $.notify("category is require",{globalPosible: 'top right',className: 'error'});
          return false;
        }
        if(product_id ==''){
          $.notify("product is require",{globalPosible: 'top right',className: 'error'});
          return false;
        }


        var source = $("#document-template").html();
        var template = Handlebars.compile(source);
        var data = {
          date:date,
          invoice_no:invoice_no,
          category_id:category_id,
          name:name,
          product_id:product_id,
          product_name:product_name
        };
        var html = template(data);
        $("#addrow").append(html);
        });

        $(document).on("click",".removeeventInvoicemore",function(event){
        $(this).closest(".delete_add_more_item").remove();
        totalAmountPrice();
        });

        $(document).on('keyup click','.unit_price,.selling_qty',function(){
          var unit_price = $(this).closest("tr").find("input.unit_price").val();
          var selling_qty = $(this).closest("tr").find("input.selling_qty").val();
          var total = unit_price * selling_qty;
          $(this).closest("tr").find("input.selling_price").val(total);
          $('#discount_amount').trigger('keyup');
        });

        $(document).on('keyup','#discount_amount',function(){
          totalAmountPrice();
        });

        function totalAmountPrice(){
          var sum =0;
          $(".selling_price").each(function(){
            var value = $(this).val();
            if(!isNaN(value) && value.length !=0){
              sum += parseFloat(value);
            }
          });
          var discount_amount = parseFloat($('#discount_amount').val());
          if(!isNaN(discount_amount) && discount_amount.length != 0){
            sum -=  parseFloat(discount_amount);
          }
          $('#estamited_amount').val(sum);
        }
  });
</script>
<script type="text/javascript">
$(document).ready(function () {

  $('#dalyReportForm').validate({
    rules: {
      fast_date: {
        required: true,
      },
      last_date: {
        required: true,
      }
    },
    messages: {
      fast_date: {
        required: "Please enter a fast date",
      },
      last_date: {
        required: "Please enter a last date",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
<script type="text/javascript">
$(document).on('change','.serch_value',function(){
  var serch_value = $(this).val();
  if(serch_value == 'Supplier_wise'){
    $('.show_supplier').show();
  }else{
    $('.show_supplier').hide();
  }
  if(serch_value == 'Product_wise'){
    $('.show_product').show();
  }else{
    $('.show_product').hide();
  }
});
</script>
<script type="text/javascript">
$(document).on('change','.serch_value',function(){
  var serch_value = $(this).val();
  if(serch_value == 'cadit_wise'){
    $('.show_cradit').show();
  }else{
    $('.show_cradit').hide();
  }
  if(serch_value == 'paid_wise'){
    $('.show_paid').show();
  }else{
    $('.show_paid').hide();
  }
});
</script>
</body>
</html>

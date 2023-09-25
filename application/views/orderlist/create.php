
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Orderlist</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Orderlist</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>


        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Add Orderlist</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('orders/create') ?>" method="post" class="form-horizontal">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="gross_amount" class="col-sm-12 control-label">Date: <?php echo date('Y-m-d') ?></label>
                </div>
                <div class="form-group">
                <!-- Dito mag display ng date -->
                  <label for="gross_amount" class="col-sm-12 control-label">Time: <?php date_default_timezone_set("Asia/Manila"); echo date('h:i a') ?></label>
                </div>

                
                
                
                <br /> <br/>
                <table class="table table-bordered table-hover" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:50%">Product</th>
                      <th style="width:30%">Qty</th>
                      <th style="width:20%"><button type="button" id="add_row" class="btn btn-info"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                       <td>
                        <select class="form-control select_group product" data-row-id="row_1" id="product_1" name="product[]" style="width:100%;" onchange="getProductData(1)" required>
                            <option value='maincat' disabled selected hidden>--Select Products--</option>
                            <?php foreach ($products as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
                        <td><input type="number" name="qty[]" id="qty_1" class="form-control" min="1" placeholder="Quantity" required onclick="getTotal(1)" onkeyup="getTotal(1)"></td>
                        <td><button type="button" class="btn btn-danger" onclick="removeRow('1')" ><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>
                <br /> <br/>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="button" class="btn btn-success" id="testingmuna">Create Order</button>
                <a href="<?php echo base_url('orderlist/') ?>" class="btn btn-danger">Go Back</a>

              </div>
            </form>

            
          <!-- /.box-body -->
        </div><br><br>

              <?php if(in_array('viewOrderList', $user_permission)): ?>
        <div class="box"> 
        <div class="box-header">
            <h3 class="box-title">Products</h3>
          </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="manageTable1" class="table table-bordered table-hover table-striped">
              <thead>
              <tr>
                <th>Product Name</th>   
                <th>Quantity On Hand</th>
                <th>Reorder Point</th>
                <th>Status</th>
              </tr>
              </thead>

            </table>
            </div>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
     <?php endif; ?>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->






  <!-- /.box-body -->
  <div class="modal fade" tabindex="-1" role="dialog" id="pipindutin">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Do you want to create order?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="testingpindot">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
  // ito yung regex para bawal yung special characters
  $('input').bind('input', function() {
  var c = this.selectionStart,
      r = /[^a-z0-9 .]/gi,
      v = $(this).val();
  if(r.test(v)) {
    $(this).val(v.replace(r, ''));
    c--;
  }
  this.setSelectionRange(c, c);
});

$('#testingmuna').click(function() {
    $('#pipindutin').modal('show');
});
$('#testingpindot').click(function() {
    $('form').submit();
});
  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();
    $("#InventoryMainNav").addClass('active');

    $("#orderlistMainNav").addClass('active');
    $("#createorderlistSubMenu").addClass('active');
    
    // initialize the datatable 
  manageTable = $('#manageTable1').DataTable({
    'ajax': base_url + 'productstock/fetchProductData3',
    'order': []
  });




    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
  
    // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                        '<option selected>--Select Products--</option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.name+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                    '<td><input placeholder="Quantity" type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onclick="getTotal('+row_id+')" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><button type="button" class="btn btn-danger" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
              }
              else {
                $("#product_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });
  }); // /document


  // get the product information from the server
  function getProductData(row_id)
  {
    var product_id = $("#product_"+row_id).val();    
    if(product_id == "") {


      $("#qty_"+row_id).val("");           


    } else {
      $.ajax({
        url: base_url + 'orders/getProductValueById',
        type: 'post',
        data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field

          $("#qty_"+row_id).val(1);
          $("#qty_value_"+row_id).val(1);
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }


  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }


</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Orders</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Orders</li>
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
            <h3 class="box-title">Edit Order</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('stock/create') ?>" method="post" class="form-horizontal">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="date" class="col-sm-12 control-label">Date: <?php echo date('Y-m-d') ?></label>
                </div>
                <div class="form-group">
                  <label for="time" class="col-sm-12 control-label">Time: <?php date_default_timezone_set("Asia/Manila"); echo date('h:i a') ?></label>
                </div>

                <div class="col-md-4 col-xs-12 pull pull-left">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-2 control-label" style="text-align:left;">RO Code</label>
                    <div class="col-sm-7">
                        <input style="margin-left: 3.2em;" type="text" class="form-control" id="ol_code" name="ol_code" disabled autocomplete="off" value="<?php echo $order_data['stock']['ro_code'] ?>"><br>
                    </div>

                  </div>
                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-3 control-label" style="text-align:left;">Expiration Date</label>
                    <div class="col-sm-7">
                        <input type="date" class="form-control" id="exp_date" name="exp_date" autocomplete="off" value="<?php echo date('Y-m-d',$order_data['stock']['st_exp_date']) ?>" required><br>
                    </div>
                  </div>
                </div>

                  
                </div>
                
                <br> <br>
                <table class="table table-bordered table-hover table-responsive" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:50%">Product</th>
                      <th style="width:30%">Qty</th>
                      <th style="width:20%"><button style="display:none;" type="button" id="add_row" class="btn btn-info"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>

                    <?php if(isset($order_data['orderlist_item'])): ?>
                      <?php $x = 1; ?>
                      <?php foreach ($order_data['orderlist_item'] as $key => $val): ?>
                        <?php //print_r($v); ?>
                       <tr id="row_<?php echo $x; ?>">
                         <td>
                         <select
                          class="form-control select_group product" data-row-id="row_<?php echo $x; ?>" id="product_<?php echo $x; ?>" name="product[]" style="width:100%;" onchange="getProductData(<?php echo $x; ?>)" required>
                              <option value=""></option>
                              <?php foreach ($products as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>"  <?php if($val['product_id'] == $v['id']) { echo "selected='selected'"; } ?>><?php echo $v['name'] ?></option>
                              <?php endforeach ?>
                            </select>
                          </td>
                          <!-- disabled -->
                          <td><input readonly type="number" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="qty[]" min="1" id="qty_<?php echo $x; ?>" class="form-control" required onclick="getTotal(<?php echo $x; ?>)" onkeyup="getTotal(<?php echo $x; ?>)" value="<?php echo $val['qty'] ?>" autocomplete="off"></td>
                          <td><button style="display:none;" id="void_show" type="button" class="btn btn-danger" onclick="removeRow('<?php echo $x; ?>')"><i class="fa fa-close"></i></button></td>
                       </tr>
                       <?php $x++; ?>
                     <?php endforeach; ?>
                   <?php endif; ?>
                   </tbody>
                </table>
                <br /> <br/>
                 <div class="row">
                 <div class="form-group col-md-6 col-xs-12 pull pull-right">
                    <label for="status" class="col-sm-5 control-label">Status</label>
                    <div class="col-sm-6">
                      <select type="text" class="form-control" id="status" name="status">
                        <option value="1">Received</option>
                        <option value="2">Not Received</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                 <div class="form-group col-md-6 col-xs-12 pull pull-right">
                    <label for="remarks" class="col-sm-5 control-label">Remarks:</label>
                    <div class="col-sm-6">
                    <textarea type="text" class="form-control" id="remarks" name="remarks" placeholder="Enter remarks"  autocomplete="off"> <?php echo !empty($this->input->post('remarks')) ?:$order_data['stock']['remarks'] ?></textarea>
                    </div>
                  </div>
                </div>
              <!-- /.box-body -->

              <div class="box-footer">

             
                <a id="print" target="__blank" href="<?php echo base_url() . 'stock/printDiv/'.$order_data['stock']['id'] ?>" class="btn btn-default" >Print Receipt</a>
                <button id="save" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Save Changes</button>
                <button id="btnsavec" type="button" hidden="hidden" class="btn btn-success">Save Changes</button>
                <button id="quanti" type="button" class="btn btn-success">Manage Quantity</button>

                 <button id="add_items" type="button" class="btn btn-success">Add items</button>

                <a id="go_back" href="<?php echo base_url('stock/') ?>" class="btn btn-danger">Go Back</a> 
                <button id="btnvoid" type="button"  class="btn btn-danger">Remove Products</button>

              </div>
            </form>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>


  <!-- /.box-body -->
  <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Stock Transfer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Do you want to update stocktransfer?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="testingpindot">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  </div>


<script type="text/javascript">

$('#testingpindot').click(function() {
    $('form').submit();
});
  var base_url = "<?php echo base_url(); ?>";
  $('#btnsavec').hide();


$('#add_items').on('click', function() {
  $('#add_row').show();
  $('#print').hide();
  $('#save').hide();
  $('#go_back').hide();
  $('#quanti').hide();
  $('#add_items').hide();
  $('#btnvoid').hide();
  $('#btnsavec').show();
});

$('#btnvoid').on('click', function() {
  $('*#void_show').show();
  $('#print').hide();
  $('#save').hide();
  $('#go_back').hide();
  $('#quanti').hide();
  $('#add_items').hide();
  $('#btnvoid').hide();
  $('#btnsavec').show();
});
$('#quanti').on('click', function() {
  $('input[id^=qty_]').prop("readonly",false);
  $('#print').hide();
  $('#save').hide();
  $('#go_back').hide();
  $('#quanti').hide();
  $('#add_items').hide();
  $('#btnvoid').hide();
  $('#btnsavec').show();
});
$('#btnsavec').on('click', function() {
  $('#add_row').show();
  $('#print').show();
  $('#save').show();
  $('#go_back').show();
  $('#quanti').show();
  $('#btnsavec').hide();
  $('#add_items').show();
  $('#btnvoid').show();
  $('#add_row').hide();
  $('*#void_show').hide();

  $('input[id^=qty_]').prop("readonly",true);

});
$(document).ready(function() {

    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#InventoryMainNav").addClass('active');

    $("#stocktransferMainNav").addClass('active');
    $("#managestocktransferSubMenu").addClass('active');
    
       // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/stock/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            

              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.name+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                    '<td><input placeholder="Quantity" type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onclick="getTotal('+row_id+')" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><button style="display:none;" type="button" class="btn btn-danger" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
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
  
  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }

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


</script>
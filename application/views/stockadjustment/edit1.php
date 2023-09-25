

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Stock Adjustment</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Stock Adjustment</li>
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
            <h3 class="box-title">Add Stock</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('stockadjustment/create') ?>" method="post" class="form-horizontal">
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
                    <label for="gross_amount" class="col-sm-2 control-label" style="text-align:left;">ST Code</label>
                    <div class="col-sm-7">
                        <input style="margin-left: 3.2em;" type="text" class="form-control" id="st_code" name="st_code" readonly autocomplete="off" value="<?php echo $order_data['stockadjustment']['st_code'] ?>"><br>
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
                          <td><input readonly type="number" name="qty[]" min="1" id="qty_<?php echo $x; ?>" class="form-control" required onclick="getTotal(<?php echo $x; ?>)" onkeyup="getTotal(<?php echo $x; ?>)" value="<?php echo $val['qty'] ?>" autocomplete="off"></td>
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
                    <label for="remarks" class="col-sm-5 control-label">Remarks:</label>
                    <div class="col-sm-6">
                    <textarea type="text" class="form-control" id="remarks" name="remarks" placeholder="Enter remarks"  autocomplete="off"> <?php echo !empty($this->input->post('remarks')) ?:$order_data['stockadjustment']['remarks'] ?></textarea>
                    </div>
                  </div>
                </div>
              <!-- /.box-body -->

              <div class="box-footer">

              <br>

             
                <button id="btnsavec" type="button" hidden="hidden" class="btn btn-success">Save Changes</button>
                <button id="testingmuna" type="button" class="btn btn-success" >Save Changes</button>

                <button id="addquanti" type="button" class="btn btn-success">Remove Quantity</button>
                <a id="go_back" href="<?php echo base_url('stockadjustment/') ?>" class="btn btn-danger">Go Back</a> 

              </div>

              <br><br>

            </form>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <br><hr>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Products Expiration</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <div class="table-responsive">
            <table id="manageTable" class="table table-bordered table-hover table-striped">
              <thead>
              <tr>
                <th>ST CODE</th>
                <th>QTY</th>   
                <th>Product Name</th>   
                <th>Added Date</th>
                <th>Expiration Date</th>
                <th>Status</th>  
              </tr>
              </thead>

            </table>
            </div>
          </div>
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
  <div class="modal fade" tabindex="-1" role="dialog" id="pipindutin">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Remove Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Do you want to remove product stock?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="testingpindot">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
$('#testingmuna').click(function() {
    $('#pipindutin').modal('show');
});
$('#testingpindot').click(function() {
    $('form').submit();
});



  var base_url = "<?php echo base_url(); ?>";
  $('#btnsavec').hide();
  $('#quanti').hide();
   // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'productstock/fetchProductData6',
    'order': []
  });
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
$('#btnsavec').on('click', function() {
  $('#save').show();
  $('#go_back').show();
  $('#quanti').hide();
  $('#btnsavec').hide();
  $('input[id^=qty_]').prop("readonly",true);
  $('#addquanti').show();
  $('#remoquanti').show();
});

$('#addquanti').on('click', function() {
  $('#btnsavec').show();
  $('#quanti').show();
  $('#save').hide();
  $('#addquanti').hide();
  $('#remoquanti').hide();
  $('#go_back').hide();
  $('input[id^=qty_]').prop("readonly",false);
});

$(document).ready(function() {
    $(".select_group").select2();

    $("#InventoryMainNav").addClass('active');

    $("#stockadjustmentMainNav").addClass('active');
    $("#managestockadjustmentSubMenu").addClass('active');
    
  }); 
  

</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Products</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Products</li>
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
            <h3 class="box-title">Add Product</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>
               

                <div class="form-group">
                  <label for="main_category">From Main-Category: <label style="color:red">*</label></label>
                   <?php $sub_category_data = json_decode($product_data['main_category_id']);?>
                  <select class="form-control select_group"  id="main_category_1" name="main_category[]" onchange="getSubCategoryData(1)">
                    <?php foreach ($main_category as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if(in_array($v['id'], $sub_category_data)) { echo 'selected="selected"'; } ?>><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

             

               <div class="form-group">
                  <label for="sub_category">From Sub-Category: <label style="color:red">*</label></label>
                  <?php $sub_category_data = json_decode($product_data['sub_category_id']);?>
                  <select class="form-control select_group" id="sub_category_1" name="sub_category[]" onchange="getSubCategoryData(1)">
                   <?php foreach ($sub_category as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if(in_array($v['id'], $sub_category_data)) { echo 'selected="selected"'; } ?>><?php echo $v['name'] ?></option>
                   <?php endforeach ?>
                  </select>
                </div>



                <div class="form-group">
                  <label for="product_name">Product name: <label style="color:red">*</label></label>
                  <input type="text" class="form-control" pattern=".{3,}" id="product_name" name="product_name" placeholder="Enter product name" autocomplete="off" value="<?php echo !empty($this->input->post('product_name')) ?:$product_data['name'] ?>" />
                </div>

                <div class="form-group" hidden>
                  <label for="description">Description:</label>
                  <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter 
                  description" autocomplete="off">
                  <?php echo !empty($this->input->post('description')) ?:$product_data['description'] ?>
                  </textarea>
                </div>

              

                
                <div class="form-group">
                  <label for="cost">Unit Cost: <label style="color:red">*</label></label>   
                  <input type="number" min="1" class="form-control" id="cost" name="cost" placeholder="Enter cost" autocomplete="off" onclick="getSRP(1)" onkeyup="getSRP(1)" value="<?php echo !empty($this->input->post('cost')) ?:$product_data['cost'] ?>"/>
                </div>
                <div class="form-group">
                    <label for="markup">Markup Value: <label style="color:red">*</label></label>
                      <input type="number" class="form-control" id="markup" name="markup" disabled value="<?php echo !empty($this->input->post('markup_value')) ?:$product_data['markup'] ?>" autocomplete="off" placeholder="Markup">
                      <input type="hidden" class="form-control" id="markup_value" name="markup_value" value="<?php echo !empty($this->input->post('markup_value')) ?:$product_data['markup'] ?>" autocomplete="off">
                </div>

                 <div class="form-group">
                    <label for="srp">Selling Price: <label style="color:red">*</label></label>
                      <input type="number" class="form-control" id="srp" name="srp" disabled value="<?php echo !empty($this->input->post('srp_value')) ?:$product_data['srp'] ?>" autocomplete="off" placeholder="SRP">
                      <input type="hidden" class="form-control" id="srp_value" name="srp_value" value="<?php echo !empty($this->input->post('srp_value')) ?:$product_data['srp'] ?>" autocomplete="off">
                </div>


                <div class="form-group">
                  <label for="lead_time">Lead Time: <label style="color:red">*</label></label>   
                  <input type="number" min="1" class="form-control" id="lead_time" name="lead_time" placeholder="Enter lead time" autocomplete="off" onclick="getROP(1)" onkeyup="getROP(1)" value="<?php echo !empty($this->input->post('lead_time')) ?:$product_data['lead_time'] ?>"/>
                </div>
                <div class="form-group">
                  <label for="daily_use">Daily Average Usage: <label style="color:red">*</label></label>   
                  <input type="number" min="1" class="form-control" id="daily_use" name="daily_use" placeholder="Enter daily use" autocomplete="off" onclick="getSafety(1)" onkeyup="getSafety(1)" value="<?php echo !empty($this->input->post('daily_use')) ?:$product_data['daily_use'] ?>"/>
                </div>
                <div class="form-group">
                    <label for="srp">Safety Stock: <label style="color:red">*</label></label>
                      <input type="number" class="form-control" id="safety_stock" name="safety_stock" disabled value="<?php echo !empty($this->input->post('safety_stock_value')) ?:$product_data['safety_stock'] ?>" autocomplete="off" placeholder="Safety Stock">
                      <input type="hidden" class="form-control" id="safety_stock_value" name="safety_stock_value" value="<?php echo !empty($this->input->post('safety_stock_value')) ?:$product_data['safety_stock'] ?>" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="srp">Reoder Point: <label style="color:red">*</label></label>
                      <input type="number" class="form-control" id="reorderpoint" name="reorderpoint" disabled value="<?php echo !empty($this->input->post('reorderpoint_value')) ?:$product_data['rop'] ?>" autocomplete="off" placeholder="Reorder Point">
                      <input type="hidden" class="form-control" id="reorderpoint_value" name="reorderpoint_value" value="<?php echo !empty($this->input->post('srp_value')) ?:$product_data['rop'] ?>" autocomplete="off">
                </div>






                <div class="form-group">
                  <label for="store">Active: <label style="color:red">*</label></label>
                  <select class="form-control" id="active" name="active"> 
                    <option value="1" <?php if($product_data['active'] == 1) { echo 'selected="selected"'; } ?>>Yes</option>
                    <option value="2" <?php if($product_data['active'] == 2) { echo 'selected="selected"'; } ?>>No</option>
                  </select>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="button" class="btn btn-success" id="testingmuna">Save Changes</button>
                <a href="<?php echo base_url('products/') ?>" class="btn btn-danger">Back</a>
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
<!-- /.content-wrapper -->





  <!-- /.box-body -->
  <div class="modal fade" tabindex="-1" role="dialog" id="pipindutin">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Do you want to update product?.</p>
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

  $(document).ready(function() {
    $(".select_group").select2();
    $("#description").wysihtml5();
    $("#FileMainNav").addClass('active');
    $("#productMainNav").addClass('active');
    $("#createProductSubMenu").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
   

  });





  


  $('select[name="main_category[]"]').on('change', function() {
            var stateID = $(this).val();

            if(stateID) {
                $.ajax({
                    url: base_url + 'subcat/myformAjax/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="sub_category[]"]').empty();
                        $.each(data, function(key, value) {

                            $('select[name="sub_category[]"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            getSubCategoryData(1);
                        });
                    }
                });
            }else{
                $('select[name="sub_category[]"]').empty();
            }
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
   function getSRP(row = null){
    if(row) {
      var total = Number($("#markup_value").val()) + Number($("#cost").val());
      total = total.toFixed(2);
      $("#srp").val(total);
      $("#srp_value").val(total);
      

    } else {
      alert('no row !! please refresh the page');
    }
  }
  function getSafety(row=null){
    if(row) {
          var total1 = (Number($("#daily_use").val()) * 7);
          total1 = total1.toFixed(0);
      
          $("#safety_stock").val(total1);
          $("#safety_stock_value").val(total1);

          getROP(1);
    }
    else {
      alert('no row !! please refresh the page');
    }
  }
  function getROP(row = null){
    if(row) {
    
      var total = (Number($("#daily_use").val()) * Number($("#lead_time").val())) + Number($("#safety_stock").val());
      total = total.toFixed(0);


      $("#reorderpoint").val(total);
      $("#reorderpoint_value").val(total);
      

    } else {
      alert('no row !! please refresh the page');
    }
  }
  

  function getSubCategoryData(row_id)
  {
    var sub_category_id = $("#sub_category_"+row_id).val();    
    if(sub_category_id == "") {
      $("#markup").val("");
      $("#markup_value").val("");

    } else {
      $.ajax({
        url: "<?php echo base_url(); ?>products/getSubcatById",
        type: 'post',
        data: {sub_category_id : sub_category_id},
        dataType: 'json',
        success:function(response) {
          
          $("#markup").val(response.markup);
          $("#markup_value").val(response.markup);
          getSRP(1);
        } 
      }); 

    }
  }

</script>
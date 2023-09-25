

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Main Category</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Main Category</li>
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
            <h3 class="box-title">Add Main Category</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

              <div class="form-group">
                  <label for="sub_category">Main-Category: <label style="color:red">*</label></label>
                  <?php $main_category_data = json_decode($category_data['main_category_id']); ?>
                  <select class="form-control select_group" id="category" name="category">
                    <?php foreach ($category as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if(in_array($v['id'], $category_data)) { echo 'selected="selected"'; } ?>><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="category_name">Sub-Category name: <label style="color:red">*</label></label>
                  <input type="text" class="form-control" pattern=".{3,}" id="category_name" name="category_name" placeholder="Enter category name" autocomplete="off" value="<?php echo !empty($this->input->post('category_name')) ?:$category_data['name'] ?>" />
                </div>

                <!-- dito ako natapos -->

               




                <div class="form-group">
                  <label for="markup">Markup Value: <label style="color:red">*</label></label>
                  <input type="number" min="1" class="form-control" id="markup" name="markup" placeholder="Enter markup" autocomplete="off" value="<?php echo !empty($this->input->post('markup')) ?:$category_data['markup'] ?>"/>
                </div>

                

                <div class="form-group">
                  <label for="store">Active: <label style="color:red">*</label></label>
                  <select class="form-control" id="active" name="active"> 
                    <option value="1" <?php if($category_data['active'] == 1) { echo 'selected="selected"'; } ?>>Yes</option>
                    <option value="2" <?php if($category_data['active'] == 2) { echo 'selected="selected"'; } ?>>No</option>
                  </select>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="button" class="btn btn-success" id="testingmuna">Save Changes</button>
                <a href="<?php echo base_url('subcat/') ?>" class="btn btn-danger">Back</a>
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
        <h5 class="modal-title">Update Sub Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Do you want to update sub category?.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="testingpindot">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


  <!-- /.box-body -->
  <div class="modal fade" tabindex="-1" role="dialog" id="pipindutin1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Please select main category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Please select a main category</p>
      </div>
      <div class="modal-footer">
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
    var test = $('#category').val();
    if(test==null){
        $('#pipindutin1').modal('show');
        $('#pipindutin').modal('hide');
    }else{
        $('form').submit();
    }
    
});
  $(document).ready(function() {
    $(".select_group").select2();
    $("#description").wysihtml5();
    $("#FileMainNav").addClass('active');
    $("#subcatMainNav").addClass('active');
    $("#createSubCatSubMenu").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
   

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
</script>
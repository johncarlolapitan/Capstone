

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Backup And Restore
      <small>Database</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> System Utility</a></li>
      <li class="active">Backup and Restore</li>
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
       
        <br /> <br />

        <div class="box">
          <div class="row">
        <div class="col-sm-5" style="margin-left:50px;"><br>
            <span class="help-block">Press the button to backup your data</span>
            <button class="btn btn-primary" id="testingmuna">Download Data</button>

        </div>
        <div class="col-sm-6"><br>
           <form action="<?=base_url()?>backup/restore" method="POST" enctype='multipart/form-data'>
             <span class="help-block">File must be of type .sql</span>
                <input  class="btn btn-info" type="file" name="datafile"  accept=".sql"><br>
                <input class="btn btn-primary" type="button" value="Click to Restore" data-toggle="modal" data-target="#pipindutin1">
            </form>
            <span class="help-block" id="dbFileMsg"></span>
        </div>
        
        </div>


        <br>
        <br>
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
        <h5 class="modal-title">Create Backup</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Do you want to create a backup database?</p>
      </div>
      <div class="modal-footer">
        <a id="testingmuna1" class="btn btn-success" href="<?php echo base_url();?>backup2">Save changes</a>
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
        <h5 class="modal-title">Restore Database</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Do you want to restore database?</p>
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
$('#testingmuna1').click(function() {
    $('#pipindutin').modal('hide');
});
$('#testingpindot').click(function() {
    $('form').submit();
});


  $(document).ready(function() {
    $("#SystemUtilityMainNav").addClass('active');
    $("#BackupMainNav").addClass('active');

});
</script>
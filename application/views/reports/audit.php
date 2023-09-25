

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Audit 
      <small> Trail</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Audit Trail</li>
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
             <a href="<?php echo base_url('reports/printDiv100') ?>" class="btn btn-success">Generate Report <i class="fa fa-print"></i> </a>
        <br /> <br />
    
        

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Audit Trail</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <div class="table-responsive">
            <table id="manageTable" class="table table-bordered table-hover table-striped">
              <thead>
              <tr>
                <th>Date Time</th>
                <th>Username</th>   
                <th>Action Made</th>   
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
<!-- /.content-wrapper -->


<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {
  $("#ReportMainNav").addClass('active');
  $("#auditHistorySubMenu").addClass('active');
  
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'reports/fetchAuditData',
    'order': []
  });

});


</script>

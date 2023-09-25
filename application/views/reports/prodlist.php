

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Product 
      <small>Master List</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Product Master List</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <a href="<?php echo base_url('products/viewproduct1') ?>" class="btn btn-warning">View Product </a>
        <a href="<?php echo base_url('reports/printDiv10') ?>" class="btn btn-success">Generate Report <i class="fa fa-print"></i> </a>
        <br /> <br />

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Product Master List</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <div class="table-responsive">
            <table id="manageTable" class="table table-bordered table-hover table-striped">
              <thead>
              <tr>
                <th>Product Name</th>   
                <th>Quantity on Hand</th>
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
<!-- /.content-wrapper -->
<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {
  $("#ReportMainNav").addClass('active');
  $("#prodlistSubMenu").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'products/fetchProductData10',
    'order': []
  });

});


</script>

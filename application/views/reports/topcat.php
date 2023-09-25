  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style>
hr { 
    display: block;
    margin-end: auto;
    margin-start: auto;
    border: 3px inset;
    overflow: hidden;
    margin-before: 0.5em;
    margin-after: 0.5em;
}
#piechart2{
    margin: auto; 
    width: 900px; 
    height: 500px;
}
@media screen and (min-width: 400px) {
  #piechart2 {
    display: none;
  }
}
@media screen and (min-width: 250px) {
  #piechart2 {
    display: none;
  }
}
@media screen and (min-width: 800px) {
  #piechart2 {
    display: block;
  }
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Top
      <small>Categories</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Reports</a></li>
      <li class="active">Top Categories</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">
      <div id="piechart2"></div>       
      <br><br>

      <hr></hr>
        <h4> TOP Fast Moving Categories </h4>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">TOP 5 Fast Moving Categories</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <div class="table-responsive">
            <table id="manageTable" class="table table-bordered table-hover table-striped">
              <thead>
              <tr>
                <th>Category Name</th>
                <th>Item Sold</th>
              </tr>
              </thead>

            </table>
            </div>
          </div>

          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <br>
        <hr>
        <br>
        <h4> TOP Slow Moving Categories </h4>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">TOP 5 Slow Moving Categories</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <div class="table-responsive">
            <table id="manageTable1" class="table table-bordered table-hover table-striped">
              <thead>
              <tr>
                <th>Category Name</th>
                <th>Item Sold</th>
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
  $("#topcatSubMenu").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'reports/fetchOrdersData4',
    'order': []
  });

  
  // initialize the datatable 
  manageTable = $('#manageTable1').DataTable({
    'ajax': base_url + 'reports/fetchOrdersData5',
    'order': []
  });
});

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
         <?php 
         foreach($piechartcaloy as $value){
         echo "['".trim(
              $value['subcat_name']).
              "',".
              trim($value['TEST'])."],";
         }
         ?>

        ]);
        var options = {
          title: 'Categories Item Pie chart'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart.draw(data, options);
      }
     

</script>

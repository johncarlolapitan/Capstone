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
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <?php if($is_admin == true){ ?>

        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $total_products ?></h3>

                <p>Food Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-restaurant"></i>
              </div>
              <a href="<?php echo base_url('products/') ?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $total_paid_orders ?></h3>

                <p>Total Paid Orders</p>
              </div>
              <div class="icon">
                <span>&#8369;</span>
              </div>
              <a href="<?php echo base_url('orders/') ?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $total_users; ?></h3>

                <p>System Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-people"></i>
              </div>
              <a href="<?php echo base_url('users/') ?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $total_tables ?></h3>

                <p>Available Tables</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-grid-view"></i>
              </div>
              <a href="<?php echo base_url('tables/') ?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">
         
           
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $total_unpaid_orders ?></h3>

                <p>UnPaid Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-close-circled" style="color:rgb(177, 169, 169)"></i>
              </div>
              <a href="<?php echo base_url('orders/') ?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $total_orders ?></h3>

                <p>Total Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
              <a href="<?php echo base_url('orders/') ?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><span>&#8369;</span><?php $query = $this->db->query('SELECT SUM( net_amount)as total FROM orders WHERE paid_status = 1;')->row(); echo floatval($query->total);?></h3>

                <p>Total Earnings</p>
              </div>
              <div class="icon">
                  <span>&#8369;</span>
              </div>
              <a href="<?php echo base_url('reports/') ?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3 style="color: #E41B17;"><?php $query = $this->db->query('SELECT COUNT(product_id)as total FROM product_inventory WHERE date_added > expiration_date;')->row(); echo floatval($query->total);?></h3>

                <p style="color: #E41B17;">Expired Products</p>
              </div>
              <div class="icon">
                  <i class="ion ion-alert"></i>
              </div>
              <a  href="<?php echo base_url('productstock/index2') ?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3 style="color: #E41B17;"><?php $query = $this->db->query('SELECT COUNT(name)as total FROM products WHERE rop > qty;')->row(); echo floatval($query->total);?></h3>

                <p style="color: #E41B17;">Low Stocks Product</p>
              </div>
              <div class="icon">
                  <i class="ion ion-alert-circled"></i>
              </div>
              <a href="<?php echo base_url('productstock/index1') ?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>



          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3 ><?php $query = $this->db->query('SELECT COUNT(status)as total FROM orderlist WHERE status > 0;')->row(); echo floatval($query->total);?></h3>

                <p>Pending Request Order</p>
              </div>
              <div class="icon">
                  <i class="ion ion-compose"></i>
              </div>
              <a href="<?php echo base_url('requestorder/') ?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3 ><span>&#8369;</span><?php $query = $this->db->query('SELECT SUM(net_amount) AS total FROM orders WHERE DATE(datetoday) = CURRENT_DATE')->row(); echo floatval($query->total);?></h3>

                <p>Daily Profit</p>
              </div>
              <div class="icon">
                  <i class="ion ion-compose"></i>
              </div>
              <a href="<?php echo base_url('orders/') ?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->



      <?php } else { ?>

        <!-- other side if hindi admin eto yung dashboard na makikita nila -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo $total_products ?></h3>

                <p>Food Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-restaurant"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php echo $total_tables ?></h3>

                <p>Available Tables</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-grid-view"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
         
         
        </div>
        <!-- /.row -->
      
      <?php }?>
      
     









      <?php if(in_array('viewReport', $user_permission)): ?>


       <div class="row">

        <div class="col-md-12 col-xs-12">
          <form class="form-inline" action="<?php echo base_url('reports/') ?>" method="POST">
            <div class="form-group">
              <label for="date">Year</label>
              <select class="form-control" name="select_year" id="select_year">
                <?php foreach ($report_years as $key => $value): ?>
                  <option value="<?php echo $value ?>" <?php if($value == $selected_year) { echo "selected"; } ?>><?php echo $value; ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
        </div>

        <br /> <br />


        <div class="col-md-12 col-xs-12">

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
              <h3 class="box-title">Total Paid Orders - Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart1" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Total Paid Orders - Report Data</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="datatables" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>Month - Year</th>
                  <th>Amount</th>
                </tr>
                </thead>
                <tbody>

                  <?php foreach ($results as $k => $v): ?>
                    <tr>
                      <td><?php echo $k; ?></td>
                      <td><?php 
                      
                        echo $company_currency .' ' . $v;
                        //echo $v;
                      
                      ?></td>
                    </tr>
                  <?php endforeach ?>
                  
                </tbody>
                <tbody>
                  <tr>
                    <th>Total Amount</th>
                    <th>
                      <?php echo $company_currency . ' ' . array_sum($results); ?>
                      <?php //echo array_sum($results); ?>
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
      <div class="col-sm">
        <div class="box">
           <div id="piechart2"></div>
        </div>
        </div>
        
       </div>

       <?php endif; ?>


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php if(in_array('deleteOrder', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Order</h4>
      </div>

      <form role="form" action="<?php echo base_url('orders/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Save changes</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>




<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";
 google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
         <?php 
         foreach($piechartcaloy as $value){
         echo "['".trim(
              $value['product_name']).
              "',".
              trim($value['TEST'])."],";
         }
         ?>

        ]);
        var options = {
          title: 'Top 10 High In Demand Products  Pie chart'
        };

        var data1 = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
         <?php 
         foreach($piechartcaloy1 as $value){
         echo "['".trim(
              $value['subcat_name']).
              "',".
              trim($value['TEST'])."],";
         }
         ?>

        ]);

        var options1 = {
          title: 'Categories Item Pie chart'
        };  
        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart.draw(data, options);
         var chart1 = new google.visualization.PieChart(document.getElementById('piechart3'));
        chart1.draw(data1, options1);
      }

     
$(document).ready(function() {

  // initialize the datatable 
  
    var report_data = <?php echo '[' . implode(',', $results) . ']'; ?>;
    

    $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
     var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : report_data
        }
      ]
    }

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart1').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[0].fillColor   = '#00a65a';
    barChartData.datasets[0].strokeColor = '#00a65a';
    barChartData.datasets[0].pointColor  = '#00a65a';
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })

});

// remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { order_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}


</script>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    $(document).ready(function() {
      $("#dashboardMainMenu").addClass('active');
    });
  </script>

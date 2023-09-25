<style>
body{
    font-size: 15px;
}
.form-control{
    height: 50px;   
}
#product_1{
 height:150px !important;
}
</style>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
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
            <h3 class="box-title">Add Order</h3>
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

                <div class="col-md-4 col-xs-12 pull pull-left">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Table: <label style="color:red">*</label></label>
                    <div class="col-sm-7">
                      <select class="form-control" id="table_name" name="table_name" required>
                        <?php foreach ($table_data as $key => $value): ?>
                          <option value="<?php echo $value['id'] ?>"><?php echo $value['table_name'] ?></option>  
                        <?php endforeach ?>
                        
                      </select>
                    </div>
                  </div>

                </div>
                
                
                <br /> <br/>
                <table class="table table-bordered table-hover table-responsive" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:40%">Product: <label style="color:red">*</label></th>
                      <th style="width:10%">Available Qty: </th>
                      <th style="width:10%">Qty: <label style="color:red">*</label></th>
                      <th style="width:10%">Rate: <?php echo $this->currency_code ?></th>
                      <th style="width:10%">Amount: <?php echo $this->currency_code ?></th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-info"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                       <td>
                        <select class="form-control select_group update-select" data-row-id="row_1" id="product_1" name="product[]" style="width:100%;" onchange="getProductData(1)" required>
                            <option disabled selected hidden value=''>--Select Products--</option>
                            <?php foreach ($products1 as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
                         <td>
                          <input type="text" name="availqty[]" id="availqty_1" class="form-control" disabled autocomplete="off" placeholder="Available Qty">
                          <input type="hidden" name="availqty[]" id="availqty_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td><input type="number" name="qty[]" id="qty_1" class="form-control" min="1" placeholder="Quantity" required onclick="getTotal(1)" onkeyup="getTotal(1)"></td>
                        <td>
                          <input type="text" name="rate[]" id="rate_1" class="form-control" disabled autocomplete="off" placeholder="Rate">
                          <input type="hidden" name="rate_value[]" id="rate_value_1" class="form-control" autocomplete="off">
                        </td>



                        <td>
                          <input type="text" name="amount[]" id="amount_1" class="form-control" disabled autocomplete="off" placeholder="Amount">
                          <input type="hidden" name="amount_value[]" id="amount_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td><button type="button" class="btn btn-danger" onclick="removeRow('1')" ><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>
                <br /> <br/>

                <div class="col-md-6 col-xs-12 pull pull-right">

                <div class="modules" hidden="hidden">
                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Gross Amount <?php echo $this->currency_code ?></label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled autocomplete="off" placeholder="Gross Amount">
                      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" autocomplete="off">
                    </div>
                  </div>
                  <?php if($is_service_enabled == true): ?>
                  <div class="form-group">
                    <label for="service_charge" class="col-sm-5 control-label">S-Charge: <?php echo $company_data['service_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="service_charge" name="service_charge" disabled autocomplete="off" placeholder="Service Charge">
                      <input type="hidden" class="form-control" id="service_charge_value" name="service_charge_value" autocomplete=" off">
                    </div>
                  </div>
                  <?php endif; ?>
                  <?php if($is_vat_enabled == true): ?>
                  <div class="form-group">
                    <label for="vat_charge" class="col-sm-5 control-label">Vat <?php echo $company_data['vat_charge_value'] ?> %</label>
                    <div class="col-sm-7">

                      <input type="text" class="form-control" id="vat_charge" name="vat_charge" disabled autocomplete="off" placeholder="VAT">
                      <input type="hidden" class="form-control" id="vat_charge_value" name="vat_charge_value" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>




                   <div class="form-group">
                    <label for="vattable" class="col-sm-5 control-label">Vattable Amount: </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="vattable" name="vattable" disabled autocomplete="off" placeholder="Vattable Amount">
                      <input type="hidden" class="form-control" id="vattable_value" name="vattable_value" autocomplete="off" >
                    </div>
                  </div>




                  <div class="form-group">
                    <label for="total_amount" class="col-sm-5 control-label">Total Amount <?php echo $this->currency_code ?></label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="total_amount" name="total_amount" disabled autocomplete="off" placeholder="Total Amount">
                      <input type="hidden" class="form-control" id="total_amount_value" name="total_amount_value" autocomplete="off">
                  </div>
                  </div>
                  <div class="form-group">
                   <label for="sub_category" class="col-sm-5 control-label">Discount:</label>
                   <div class="col-sm-7">
                  <select class="form-control select_group" id="discount_1" name="discount[]" onchange="getDisc(1)">
                      <option hidden value='discount' selected>--Select Discount--</option>
                    <?php foreach ($discount as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                  </div>
                  </div>


                  <div class="form-group">
                    <label for="discount_perct" class="col-sm-5 control-label">Discount Percentage %</label>
                    <div class="col-sm-7">
                      <input type="number" class="form-control" min="0" max="100" id="discount_perct" name="discount_perct" autocomplete="off" placeholder="Discount Percent" onkeyup="custom()" onclick="custom()">
                      <input type="hidden" class="form-control" min="0" max="100" id="discount_perct_value" name="discount_perct_value" autocomplete="off">
                  </div>
                  </div>
                  <div class="form-group">
                    <label for="discount" class="col-sm-5 control-label">Discount Amount <?php echo $this->currency_code ?></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="discount_amount" name="discount_amount" disabled autocomplete="off" placeholder="Discount Amount">
                      <input type="hidden" class="form-control" id="discount_amount_value" name="discount_amount_value" autocomplete="off">
                    </div>
                  </div>



                   <div class="form-group">
                   <label for="sub_category" class="col-sm-5 control-label">Payment Method:</label>
                   <div class="col-sm-7">
                  <select class="form-control select_group" id="payment_1" name="payment[]">
                      <option selected>--Select Payment Method--</option>
                    <?php foreach ($payment as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                  </div>
                  </div>



                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount <?php echo $this->currency_code ?></label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off" placeholder="Net Amount">
                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" autocomplete="off">
                  </div>
                </div>
                
              </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">
                <button type="button" class="btn btn-success" onclick="testingnanaman()">Create Order</button>
                <a href="<?php echo base_url('orders/') ?>" class="btn btn-danger">Go Back</a>

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
        <h5 class="modal-title">Create Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Do you want to create orderlist?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="testingpindot">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




  <!-- /.box-body -->
  <div class="modal fade" tabindex="-1" role="dialog" id="pipindutin100">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Quantity Is Out of Stock Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>The selected quantity is currently out of stock</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">



  var base_url = "<?php echo base_url(); ?>";
  
  

function testingnanaman() {
    row = 2; row1 = 3; row2 = 4; row3 = 5;

    var test = Number($('#availqty_'+row).val());
    var test1 = Number($('#qty_'+row).val());

    var test2 = Number($('#availqty_'+row1).val());
    var test3 = Number($('#qty_'+row1).val());

    var test4 = Number($('#availqty_'+row2).val());
    var test5 = Number($('#qty_'+row2).val());

    var test6 = Number($('#availqty_'+row3).val());
    var test7 = Number($('#qty_'+row3).val());
    
    if(test < test1){
        $('#pipindutin100').modal('show');
    }
    else if(test2 < test3){
        $('#pipindutin100').modal('show');
    }
    else if(test4 < test5){
        $('#pipindutin100').modal('show');
    }
    else if(test6 < test7){
        $('#pipindutin100').modal('show');
    }
    else{
        $('#pipindutin').modal('show');
    }
    
}
$('#testingpindot').click(function() {
    $('form').submit();
});

   // ito yung regex para bawal yung special characters
  $('input').bind('input', function() 
{
  var c = this.selectionStart,
      r = /[^a-z0-9 .]/gi,
      v = $(this).val();
  if(r.test(v)) {
    $(this).val(v.replace(r, ''));
    c--;
  }
  this.setSelectionRange(c, c);
});
 

  

  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#OrderMainNav").addClass('active');
    $("#createOrderSubMenu").addClass('active');



    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
  
    // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {


     // var savedIndex = $("#product_"+row_id).prop('selectedIndex');
      //var index = $("#product_"+row_id).get(0).selectedIndex;
      //var index = document.getElementById("dropDownListId").selectedIndex;
      //console.log(savedIndex);
      //var value = document.getElementById("product_"+row_id).value;
      //

       //var product_id = $("#product_"+row_id).val();   
     
     // var index = $("#product_"+row_id).get(0).selectedIndex;
      $.ajax({
          url: base_url + '/orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
              var table = $("#product_info_table");
              var count_table_tbody_tr = $("#product_info_table tbody tr").length;
              var row_id = count_table_tbody_tr + 1;    
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product update-select" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')" required>'+
                        '<option  disabled selected hidden>--Select Products--</option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.name+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                     '<td><input placeholder="Available Qty" type="text" name="availqty[]" id="availqty_'+row_id+'" class="form-control" disabled><input type="hidden" name="availqty_value[]" id="availqty_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input placeholder="Quantity" type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onclick="getTotal('+row_id+')" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input placeholder="Rate" type="text" name="rate[]" id="rate_'+row_id+'" class="form-control" disabled><input type="hidden" name="rate_value[]" id="rate_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input placeholder="Amount" type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" disabled><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"></td>'+
                    '<td><button type="button" class="btn btn-danger" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

               

                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  

              }
              else {
                $("#product_info_table tbody").html(html);

              }
              aceobenario(row_id);
              $(".product").select2();
              //console.log(info);
              //console.log(index);

        //  var index = document.getElementById("#product_"+row_id).selectedIndex;
              //var index = $("#product_"+row_id).get(0).selectedIndex;
              //var product_id = $("#product_"+row_id).val(); 
             // var value = $('.update-select').selectedIndex;
              //console.log(value);
        //      console.log(index);
              // checkpoint yung index nalang //
              

          }
        });

      return false;
    });
  }); // /document

  function aceobenario(row_id){
       var index = $("select[name='product[]'] option:selected").index();
       $('#product_'+row_id+' option:eq(' + index + ')').remove();

  }


  function getTotal(row = null) {
    if(row) {
      var total = Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val());
      total = total.toFixed(2);
      $("#amount_"+row).val(total);
      $("#amount_value_"+row).val(total);
      
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }

  // get the product information from the server
  function getProductData(row_id)
  {
    var product_id = $("#product_"+row_id).val();    
    if(product_id == "") {
      $("#rate_"+row_id).val("");
      $("#rate_value_"+row_id).val("");

      $("#availqty_"+row_id).val("");   
      $("#availqty_value_"+row_id).val("");   

      $("#qty_"+row_id).val("");           

      $("#amount_"+row_id).val("");
      $("#amount_value_"+row_id).val("");

    } else {
      $.ajax({
        url: base_url + 'orders/getProductValueById',
        type: 'post',
        data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
         
          $("#rate_"+row_id).val(response.srp);
          $("#rate_value_"+row_id).val(response.srp);

          $("#availqty_"+row_id).val(response.qty);   
          $("#availqty_value_"+row_id).val(response.qty);   

          $("#qty_"+row_id).val(1);
          $("#qty_value_"+row_id).val(1);

          var total = Number(response.srp) * 1;
          total = total.toFixed(2);
          $("#amount_"+row_id).val(total);
          $("#amount_value_"+row_id).val(total);

          var info = $("#product_"+row_id).val();    
          //var index = $("#product_"+row_id).get(0).selectedIndex;
         //$('#product_'+row_id+' option:eq(' + 1 + ')').remove();

          subAmount();
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }
   function subAmount1() {
    var service_charge = <?php echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value']:0; ?>;
    var vat_charge = <?php echo ($company_data['vat_charge_value'] > 0) ? $company_data['vat_charge_value']:0; ?>;

    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);

    // sub total
    $("#gross_amount").val(totalSubAmount);
    $("#gross_amount_value").val(totalSubAmount);

    // vat
    var vat = (Number($("#gross_amount").val())/100) * vat_charge;
    vat = vat.toFixed(2);
    $("#vat_charge").val(vat);
    $("#vat_charge_value").val(vat);

    
    var vattable = Number($("#gross_amount").val()) - Number($("#vat_charge_value").val());
    vattable = vattable.toFixed(2);
    $("#vattable").val(vattable);
    $("#vattable_value").val(vattable);


    // service
    var service = (Number($("#gross_amount").val())/100) * service_charge;
    service = service.toFixed(2);
    $("#service_charge").val(service);
    $("#service_charge_value").val(service);
        
    // total amount
    var totalAmount = (Number(totalSubAmount) - Number(vat) + Number(service));
    totalAmount = totalAmount.toFixed(2);
    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);
    $("#total_amount").val(totalAmount);
    $("#total_amount_value").val(totalAmount);

    var discount = $("#discount_amount_value").val();
    if(discount) {
      var grandTotal = Number(totalAmount) - Number(discount);
      grandTotal = grandTotal.toFixed(2);
      $("#net_amount").val(grandTotal);
      $("#net_amount_value").val(grandTotal);
    } else {
      $("#net_amount").val(totalAmount);
      $("#net_amount_value").val(totalAmount);
      
    } // /else discount 

  } // /sub total amount
  // calculate the total amount of the order
  function subAmount() {
    var service_charge = <?php echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value']:0; ?>;
    var vat_charge = <?php echo ($company_data['vat_charge_value'] > 0) ? $company_data['vat_charge_value']:0; ?>;

    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);

    // sub total
    $("#gross_amount").val(totalSubAmount);
    $("#gross_amount_value").val(totalSubAmount);

    // vat
    var vat = (Number($("#gross_amount").val())/100) * vat_charge;
    vat = vat.toFixed(2);
    $("#vat_charge").val(vat);
    $("#vat_charge_value").val(vat);

    var vattable = Number($("#gross_amount").val()) + Number($("#vat_charge_value").val());
    vattable = vattable.toFixed(2);
    $("#vattable").val(vattable);
    $("#vattable_value").val(vattable);

    // service
    var service = (Number($("#gross_amount").val())/100) * service_charge;
    service = service.toFixed(2);
    $("#service_charge").val(service);
    $("#service_charge_value").val(service);
        
    // total amount
    var totalAmount = (Number(totalSubAmount) + Number(vat) + Number(service));
    totalAmount = totalAmount.toFixed(2);
    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);
    $("#total_amount").val(totalAmount);
    $("#total_amount_value").val(totalAmount);

    var discount = $("#discount_amount_value").val();
    if(discount) {
      var grandTotal = Number(totalAmount) - Number(discount);
      grandTotal = grandTotal.toFixed(2);
      $("#net_amount").val(grandTotal);
      $("#net_amount_value").val(grandTotal);
    } else {
      $("#net_amount").val(totalAmount);
      $("#net_amount_value").val(totalAmount);
      
    } // /else discount 

  } // /sub total amount

  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }

  function custom(){
      var custom_disc = (Number($("#total_amount_value").val())/100) * Number($("#discount_perct").val());
      custom_disc = custom_disc.toFixed(2);
      $("#discount_amount").val(custom_disc);
      $("#discount_amount_value").val(custom_disc);
      subAmount();
  }
  function disc(){
    var disc_price =  (Number($("#total_amount_value").val())/100) * Number($("#discount_perct_value").val());
    disc_price = disc_price.toFixed(2);
    $("#discount_amount").val(disc_price);  
    $("#discount_amount_value").val(disc_price);
  }

  function getDisc(row_id)
  {

    var discount_id = $("#discount_"+row_id).val();    
    if(discount_id == "") {
      $("#discount_perct").val("");
      $("#discount_perct_value").val("");

    }
  
    else {
      $.ajax({
        url: base_url + 'discount/getDiscById',
        type: 'post',
        data: {discount_id : discount_id},
        dataType: 'json',
        success:function(response) {
          
          $("#discount_perct").val(response.discount_percent);
          $("#discount_perct_value").val(response.discount_percent);
           disc();
           subAmount();
          
        } 
      }); 
    
    }

  }

</script>

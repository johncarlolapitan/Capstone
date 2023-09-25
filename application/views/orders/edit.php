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
            <h3 class="box-title">Edit Order</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('orders/create') ?>" method="post" class="form-horizontal">
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
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Table: <label style="color:red">*</label></label>
                    <div class="col-sm-7">
                      <select class="form-control" id="table_name" name="table_name">
                        <?php if($order_data['order_table']['id']): ?>
                          <option value="<?php echo $order_data['order_table']['id']; ?>" <?php if($order_data['order_table']['id'] == $order_data['order']['table_id']) { echo "selected='selected'"; } ?> ><?php echo $order_data['order_table']['table_name']; ?></option>
                        <?php endif; ?>

                        <?php foreach ($table_data as $key => $value): ?>
                          <option value="<?php echo $value['id'] ?>" <?php if($order_data['order']['table_id'] == $value['id']) { echo 'selected="selected"'; } ?> ><?php echo $value['table_name'] ?></option>  
                        <?php endforeach; ?>
                        
                      </select>
                    </div>
                  </div>

                  
                </div>
                
                <br /> <br/>
                <table class="table table-bordered table-hover table-responsive" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:50%">Product: <label style="color:red">*</label></th>
                      <th style="width:10%">Qty: <label style="color:red">*</label></th>
                      <th style="width:10%">Rate: </th>
                      <th style="width:20%">Amount: </th>
                      <th style="width:10%"><button style="display:none;" type="button" id="add_row" class="btn btn-info"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>

                    <?php if(isset($order_data['order_item'])): ?>
                      <?php $x = 1; ?>
                      <?php foreach ($order_data['order_item'] as $key => $val): ?>
                        <?php //print_r($v); ?>
                       <tr id="row_<?php echo $x; ?>">
                         <td>
                          <select
                          class="form-control select_group product" data-row-id="row_<?php echo $x; ?>" id="product_<?php echo $x; ?>" name="product[]" style="width:100%;" onchange="getProductData(<?php echo $x; ?>)" required>
                              <option value=""  disabled selected hidden></option>
                              <?php foreach ($products1 as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>"  <?php if($val['product_id'] == $v['id']) { echo "selected='selected'"; } ?>><?php echo $v['name'] ?></option>
                              <?php endforeach ?>
                            </select>
                          </td>

                          
                          <!-- disabled -->
                          <td><input type="number" name="qty[]" min="1" id="qty_<?php echo $x; ?>" class="form-control" required onclick="getTotal(<?php echo $x; ?>)" onkeyup="getTotal(<?php echo $x; ?>)" value="<?php echo $val['qty'] ?>" autocomplete="off"></td>
                          <td>
                            <input type="text" name="rate[]" id="rate_<?php echo $x; ?>" class="form-control" disabled value="<?php echo $val['rate'] ?>" autocomplete="off">
                            <input type="hidden" name="rate_value[]" id="rate_value_<?php echo $x; ?>" class="form-control" value="<?php echo $val['rate'] ?>" autocomplete="off">
                          </td>
                          <td>
                            <input type="text" name="amount[]" id="amount_<?php echo $x; ?>" class="form-control" disabled value="<?php echo $val['amount'] ?>" autocomplete="off">
                            <input type="hidden" name="amount_value[]" id="amount_value_<?php echo $x; ?>" class="form-control" value="<?php echo $val['amount'] ?>" autocomplete="off">
                          </td>
                          <td><button id="void_show" style="display:none;" type="button" class="btn btn-danger" onclick="removeRow('<?php echo $x; ?>')"><i class="fa fa-close"></i></button></td>
                       </tr>
                       <?php $x++; ?>
                     <?php endforeach; ?>
                   <?php endif; ?>
                   </tbody>
                </table>
                <br /> <br/>

                <div class="col-md-6 col-xs-12 pull pull-right">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Gross Amount <?php echo $this->currency_code ?></label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled value="<?php echo $order_data['order']['gross_amount'] ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" value="<?php echo $order_data['order']['gross_amount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <?php if($is_service_enabled == true): ?>
                  <div class="form-group">
                    <label for="service_charge" class="col-sm-5 control-label">S-Charge <?php echo $company_data['service_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="service_charge" name="service_charge" disabled value="<?php echo $order_data['order']['service_charge_amount'] ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="service_charge_value" name="service_charge_value" value="<?php echo $order_data['order']['service_charge_amount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>
                  <?php if($is_vat_enabled == true): ?>
                  <div class="form-group">
                    <label for="vat_charge" class="col-sm-5 control-label">Vat <?php echo $company_data['vat_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="vat_charge" name="vat_charge" disabled value="<?php echo $order_data['order']['vat_charge_amount'] ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="vat_charge_value" name="vat_charge_value" value="<?php echo $order_data['order']['vat_charge_amount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>



                  <div class="form-group">
                    <label for="vattable" class="col-sm-5 control-label">Vattable Amount: </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="vattable" name="vattable" disabled autocomplete="off" placeholder="Vattable Amount" value="<?php echo $order_data['order']['vattable_amount'] ?>" >
                      <input type="hidden" class="form-control" id="vattable_value" name="vattable_value" autocomplete="off" value="<?php echo $order_data['order']['vattable_amount'] ?>">
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
                   <?php $discount_data = json_decode($order_data['order']['discount_id']); ?>
                  <select class="form-control select_group" id="discount_1" name="discount[]" onchange="getDisc(1)" required>
                      <option selected>--Select Discount--</option>
                    <?php foreach ($discount as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if(in_array($v['id'], $discount_data)) { echo 'selected="selected"'; } ?>><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                  </div>
                  </div>

                   <div class="form-group">
                    <label for="discount_perct" class="col-sm-5 control-label">Discount Percentage %</label>
                    <div class="col-sm-7">
                      <input readonly type="number" class="form-control" min="0" max="100" id="discount_perct" name="discount_perct" autocomplete="off" onclick="custom()" onkeyup="custom()" onchange="custom()" placeholder="Discount Percent" value="<?php echo $order_data['order']['discount_percent'] ?>">
                      <input type="hidden" class="form-control" min="0" max="100" id="discount_perct_value" name="discount_perct_value" autocomplete="off" value="<?php echo $order_data['order']['discount_percent'] ?>">
                  </div>
                  </div>
                  <div class="form-group">
                    <label for="discount" class="col-sm-5 control-label">Discount Amount <?php echo $this->currency_code ?></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="discount_amount" name="discount_amount" disabled autocomplete="off" placeholder="Discount Amount" value="<?php echo $order_data['order']['discount'] ?>">
                      <input type="hidden" class="form-control" id="discount_amount_value" name="discount_amount_value" autocomplete="off" value="<?php echo $order_data['order']['discount'] ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount <?php echo $this->currency_code ?></label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled value="<?php echo $order_data['order']['net_amount'] ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" value="<?php echo $order_data['order']['net_amount'] ?>" autocomplete="off">
                    </div>
                  </div>

                  <div class="SeniorID" hidden="hidden">
                  <div class="form-group">
                    <label for="id_number" class="col-sm-5 control-label">Identification Card Number:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="id_number" name="id_number" autocomplete="off" value="<?php echo $order_data['order']['senior_id'] ?>">
                    </div>
                  </div>
                  </div>

                  <br>
                  <div class="form-group">
                   <label for="sub_category" class="col-sm-5 control-label">Payment Method:</label>
                   <div class="col-sm-7">
                   <?php $payment_data = json_decode($order_data['order']['payment_id']); ?>
                  <select class="form-control select_group" id="payment_1" name="payment[]" onchange="getPayment(1)" required> 
                      <option value='payment' selected>--Payment Method--</option>
                    <?php foreach ($payment as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>" <?php if(in_array($v['id'], $payment_data)) { echo 'selected="selected"'; } ?>><?php echo $v['name'] ?></option>                    <?php endforeach ?>
                  </select>
                  </div>
                  </div>




                  <br>



                 <div class="digitalpayment" hidden="hidden">
                  <div class="form-group">
                        <label for="ref_num" class="col-sm-5 control-label">Reference ID:</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" minlength="9" maxlength="14" id="ref_num" placeholder="Reference ID" name="ref_num" autocomplete="off" value="<?php echo $order_data['order']['reference_no'] ?>">
                        </div>
                      </div>
                 </div>
                  <div class="cashpayment" hidden="hidden"> 
                       <div class="form-group">
                        <label for="cash_tendered" class="col-sm-5 control-label">Cash Tendered <?php echo $this->currency_code ?></label>
                        <div class="col-sm-7">
                          <input type="number" class="form-control" min="0" id="cash_tendered" placeholder="Cash Tendered" name="cash_tendered" autocomplete="off" onclick="finaltotal()" onkeyup="finaltotal()" value="<?php echo $order_data['order']['cash_tendered'] ?>">
                          <input type="hidden" class="form-control" min="0" id="cash_tendered_value" name="cash_tendered_value" autocomplete="off" value="<?php echo $order_data['order']['cash_tendered'] ?>">
                        </div>
                      </div>
                       <div class="form-group">
                        <label for="change" class="col-sm-5 control-label">Change <?php echo $this->currency_code ?></label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="change" placeholder="Change" name="change" disabled autocomplete="off" value="<?php echo $order_data['order']['total_change'] ?>">
                          <input type="hidden" class="form-control" id="change_value" name="change_value" autocomplete="off" value="<?php echo $order_data['order']['total_change'] ?>">
                        </div>
                      </div>
                 </div>
                 



                   <div class="form-group">
                  <label for="remarks" class="col-sm-5 control-label">Remarks:</label>
                  <div class="col-sm-7">
                  <textarea type="text" class="form-control" id="remarks" name="remarks" placeholder="Enter remarks"  autocomplete="off"> <?php echo !empty($this->input->post('remarks')) ?:$order_data['order']['remarks'] ?></textarea>
                </div>


                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">

                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">

                <a id="print" target="__blank" href="<?php echo base_url() . 'orders/printDiv/'.$order_data['order']['id'] ?>" class="btn btn-default" >Print Receipt</a>
                <button id="testingmuna" type="button" class="btn btn-success">Save Changes</button>

                <button id="add_items" type="button" class="btn btn-success">Add items</button>
               
                <a id="go_back" href="<?php echo base_url('orders/') ?>" class="btn btn-danger">Go Back</a>


                <button id="btnvoid" type="button"  class="btn btn-danger" data-toggle="modal" data-target="#loginModal">Void Products</button>

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
 <div id="loginModal" class="modal fade" role="dialog">  
      <div class="modal-dialog">  
   <!-- Modal content-->  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Login</h4>  
                </div>  
                <div class="modal-body">  
                     <label>Username</label>  
                     <input type="text" name="username" id="username" class="form-control" />  
                     <br />  
                     <label>Password</label>  
                     <input type="password" name="password" id="password" class="form-control" />  
                     <br />  
                     <button type="button" name="login_button" id="login_button" class="btn btn-warning">Login</button>  
                </div>  
           </div>  
      </div>  
 </div>  








 
  <!-- /.box-body -->
  <div class="modal fade" tabindex="-1" role="dialog" id="pipindutin">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Do you want to update order?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="testingpindot">Save Changes</button>
        <button type="button" class="btn btn-danger" idata-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


  <!-- /.box-body -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modalpayment">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select Payment Method</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Please select payment method to proceed...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




  <!-- /.box-body -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modalnotenough">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cash Tendered not enough</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Cash Tendered is not enough please try again...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


  <!-- /.box-body -->
  <div class="modal fade" tabindex="-1" role="dialog" id="digimoneynotenough">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reference Number not enough</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Reference number is not enough please try again...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";

$('#add_items').on('click', function() {
  $('#add_row').show();

});
getPayment(1);
getDisc(1);
$('#testingmuna').click(function() {
     var finaltotal =  Number($("#change_value").val());
     var digimoney =  $("#ref_num").val().length;
      if(finaltotal >= 0.01){
        $('#pipindutin').modal('show');
     }
     else if(digimoney == 9){
         $('#pipindutin').modal('show');
          var total = Number($("#net_amount_value").val());
          total = total.toFixed(2);
          $("#cash_tendered").val(total);
          $("#cash_tendered_value").val(total);

     }
     else if(digimoney == 8){
         $('#digimoneynotenough').modal('show');
     }
      else if(finaltotal < 0){
        $('#modalnotenough').modal('show');
     }
     else{
        $('#modalpayment').modal('show');
     }
   
});
$('#testingpindot').click(function() {
    $('form').submit();
});
  function getPayment(row_id)
  {
    var payment_id = $("#payment_"+row_id).val();    

    // dito yung senior
     var paytext = $("#payment_"+row_id).children("option:selected").text();  
     


    if(payment_id == "") {


    } else {
      $.ajax({
        url: base_url + 'payment/getPaymentById',
        type: 'post',
        data: {payment_id : payment_id},
        dataType: 'json',
        success:function(response) {
         if(paytext == 'Cash'){
            $(".cashpayment").show();
             $(".digitalpayment").hide();
         }
         else if(paytext == "Gcash" || paytext == "Paymaya"){
             $(".digitalpayment").show();
             $(".cashpayment").hide();
         }
         else{
            $(".cashpayment").hide();
            $(".digitalpayment").hide();
           
         }
        } 
      }); 
    
    }
  }

  $(document).ready(function() {


  /* CHECKKKKKKKKPOINTTTTTTTTT */
  
     $('#login_button').click(function(){  
           var username = $('#username').val();  
           var password = $('#password').val();  

           var usern = "admin@gmail.com";
           var passw = "123456789";
           if(username === usern || password === passw)
           {  
               $('*#void_show').show();
               $('#loginModal').modal('hide');
           }
           else if(username !== usern || password !== passw)
           {  
               alert("Invalid Username and Password \nPlease try again....");
               location.reload();
           }
           else {
               alert("Both fields are required");
           }
     });



    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#OrderMainNav").addClass('active');
    $("#manageOrderSubMenu").addClass('active');
    
    subAmount();
    // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            

              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')" >'+
                        '<option value=""  disabled selected hidden></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.name+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                    '<td><input  type="number" min="1" name="qty[]" id="qty_'+row_id+'" class="form-control" onclick="getTotal('+row_id+')" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'" class="form-control" disabled><input type="hidden" name="rate_value[]" id="rate_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" disabled><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"></td>'+
                    '<td><button id="void_show" style="display:none;" type="button" class="btn btn-danger" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
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
    var totalAmount = (Number(totalSubAmount) + Number(service)) - Number(vat);
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

  } 
  //sub total amount
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
          
          subAmount();
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }

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

    var paid_amount = Number($("#paid_amount").val());
    if(paid_amount) {
      var net_amount_value = Number($("#net_amount_value").val());
      var remaning = net_amount_value - paid_amount;
      $("#remaining").val(remaning.toFixed(2));
      $("#remaining_value").val(remaning.toFixed(2));
    }

  } // /sub total amount

  function paidAmount() {
    var grandTotal = $("#net_amount_value").val();

    if(grandTotal) {
      var dueAmount = Number($("#net_amount_value").val()) - Number($("#paid_amount").val());
      dueAmount = dueAmount.toFixed(2);
      $("#remaining").val(dueAmount);
      $("#remaining_value").val(dueAmount);
    } // /if
  } // /paid amoutn function

  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }


  function finaltotal(){
      var finaltotal =  Number($("#cash_tendered").val()) - Number($("#net_amount_value").val());
      finaltotal = finaltotal.toFixed(2);
      $("#change").val(finaltotal);
      $("#change_value").val(finaltotal);
  }
  function custom(){
    var disc_price =  (Number($("#total_amount_value").val())) * Number($("#discount_perct").val()/100);
    disc_price = disc_price.toFixed(2);
    $("#discount_amount").val(disc_price);  
    $("#discount_amount_value").val(disc_price);   
    subAmount();
  }
  function disc(){
    var disc_price =  (Number($("#total_amount_value").val())) * Number($("#discount_perct_value").val()/100);
    disc_price = disc_price.toFixed(2);
    $("#discount_amount").val(disc_price);  
    $("#discount_amount_value").val(disc_price);
  }
  function getDisc(row_id)
  {
    var discount_id = $("#discount_"+row_id).val();    

    // dito yung senior
     var disctext = $("#discount_"+row_id).children("option:selected").text();  
     


    if(discount_id == "") {
      $("#discount_perct").val("");
      $("#discount_perct_value").val("");

    } else {
      $.ajax({
        url: base_url + 'discount/getDiscById',
        type: 'post',
        data: {discount_id : discount_id},
        dataType: 'json',
        success:function(response) {
         if(disctext == 'Senior'){
             $("#discount_perct").val(response.discount_percent);
             $("#discount_perct_value").val(response.discount_percent);
             $(".SeniorID").show();
             subAmount1();
             disc();
             subAmount1();
         }
         else if(disctext == 'Custom'){
            $("#discount_perct").prop('readonly', false);
            $(".SeniorID").hide();
            subAmount();
            disc();
            subAmount();
         }
         else{
            
             $("#discount_perct").val(response.discount_percent);
             $("#discount_perct_value").val(response.discount_percent); 
             $(".SeniorID").hide();
             subAmount();
             disc();
             subAmount();
         }
        } 
      }); 
    
    }
  }

</script>
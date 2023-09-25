

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Groups</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">groups</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
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
              <h3 class="box-title">Add Group</h3>
            </div>
            <form role="form" action="<?php base_url('groups/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="group_name">Group Name</label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter group name" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="permission">Permission</label>

                  <table class="table table-responsive table-hover">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>View</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td style="font-weight:bold">File Maintainance</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewMainte"></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Products</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createProd"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateProd"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProd"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteProd"></td>
                      </tr>
                      <tr>
                        <td>Main Category</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createMaincat"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateMaincat"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewMaincat"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteMaincat"></td>
                      </tr>
                      <tr>
                        <td>Sub Category</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createSubcat"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSubcat"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewSubcat"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteSubcat"></td>
                      </tr>
                      <tr>
                        <td>Discount</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createDisc"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateDisc"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewDisc"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteDisc"></td>
                      </tr>
                      <tr>
                        <td>Tables</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createTable"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateTable"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewTable"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteTable"></td>
                      </tr>
                      <tr>
                        <td  style="font-weight:bold">Point of Sales</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createOrder"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateOrder"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewOrder"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteOrder"></td>
                      </tr>
                      <tr>
                        <td  style="font-weight:bold">Inventory Management</td>
                         <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewInven"></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Order List</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createOrderList"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateOrderList"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewOrderList"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteOrderList"></td>
                      </tr>
                      <tr>
                        <td>Request Order</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createReqorder"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateReqorder"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewReqorder"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteReqorder"></td>
                      </tr>
                      <tr>
                        <td>Stock Transfer</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createStocktransfer"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateStocktransfer"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewStocktransfer"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteStocktransfer"></td>
                      </tr>
                      <tr>
                        <td>Stock Adjustment</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createStockadjustment"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateStockadjustment"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewStockadjustment"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteStockadjustment"></td>
                      </tr>
                       <tr>
                        <td>Stock</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewStock"></td>
                        <td> - </td>
                      </tr>

                      <tr>
                        <td  style="font-weight:bold">Report</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewReport"></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td  style="font-weight:bold">System Utility</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewSystem"></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Users</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createUser"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateUser"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewUser"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteUser"></td>
                      </tr>
                      <tr>
                        <td>Groups</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createGroup"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateGroup"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewGroup"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteGroup"></td>
                      </tr>
                      <tr>
                        <td>Company</td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCompany"></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Profile</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProfile"></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Setting</td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSetting"></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Backup Database</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createBackup"></td>
                        <td> - </td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                    </tbody>
                  </table>
                  
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="button" class="btn btn-success" id="testingmuna">Save Changes</button>
                <a href="<?php echo base_url('groups/') ?>" class="btn btn-danger">Back</a>
              </div>
            </form>
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
        <h5 class="modal-title">Create Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Do you want to create product?.</p>
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
      $("#SystemUtilityMainNav").addClass('active');
      $('#groupMainNav').addClass('active');
      $('#createGroupSubMenu').addClass('active');
    });
  </script>


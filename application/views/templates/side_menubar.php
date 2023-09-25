<style>
body{
    font-size: 15px;
}
.form-control{
    height: 50px;   
}
select.form-control:not([size]):not([multiple]) {
    height: 50px!important;
}

</style>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li id="dashboardMainMenu">
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
            <?php if($user_permission): ?>
            <?php if(in_array('viewMainte', $user_permission)): ?>
            <li class="treeview" id="FileMainNav">
              <a href="#">
                <i class="fa fa-file"></i>
                <span>File Maintainance</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
               <ul class="treeview-menu">

                 <!--Product-->
                  <?php if(in_array('createProd', $user_permission) || in_array('updateProd', $user_permission) || in_array('viewProd', $user_permission) || in_array('deleteProd', $user_permission)): ?>
                  <li class="treeview" id="productMainNav">
                      <a href="#">
                          <i class="fa fa-cutlery"></i>
                          <span>Products</span>
                          <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                          </span>
                      </a>
                      <ul class="treeview-menu">
                          <?php if(in_array('createProd', $user_permission)): ?>
                          <li id="createProductSubMenu">
                              <a href="<?php echo base_url('products/create') ?>">
                                  <i class="fa fa-circle-o"></i> Add product
                              </a>
                          </li>
                          <?php endif; ?>
                          <?php if(in_array('updateProd', $user_permission) || in_array('viewProd', $user_permission) || in_array('deleteProd', $user_permission)): ?>
                          <li id="manageProductSubMenu">
                              <a href="<?php echo base_url('products') ?>">
                                  <i class="fa fa-circle-o"></i> Manage Products
                              </a>
                          </li>
                          <?php endif; ?>
                      </ul>
                  </li>

                  <!--Main category-->
                  <?php if(in_array('createMaincat', $user_permission) || in_array('updateMaincat', $user_permission) || in_array('viewMaincat', $user_permission) || in_array('deleteMaincat', $user_permission)): ?>
                  <li class="treeview" id="maincatMainNav">
                      <a href="#">
                          <i class="fa fa-tag"></i>
                          <span>Main Category</span>
                          <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                          </span>
                      </a>
                      <ul class="treeview-menu">
                          <?php if(in_array('createMaincat', $user_permission)): ?>
                          <li id="createMainCatSubMenu">
                              <a href="<?php echo base_url('maincat/create') ?>">
                                  <i class="fa fa-circle-o"></i> Add Main Category
                              </a>
                          </li>
                          <?php endif; ?>
                          <?php if(in_array('updateMaincat', $user_permission) || in_array('viewMaincat', $user_permission) || in_array('deleteMaincat', $user_permission)): ?>
                          <li id="manageMainCatSubMenu">
                              <a href="<?php echo base_url('maincat') ?>">
                                  <i class="fa fa-circle-o"></i> Manage Main Category
                              </a>
                          </li>
                          <?php endif; ?>
                      </ul>
                  </li>
                  <?php endif; ?>


                   <!--Sub category-->
                  <?php if(in_array('createSubcat', $user_permission) || in_array('updateSubcat', $user_permission) || in_array('viewSubcat', $user_permission) || in_array('deleteSubcat', $user_permission)): ?>
                  <li class="treeview" id="subcatMainNav">
                      <a href="#">
                          <i class="fa fa-tags"></i>
                          <span>Sub Category</span>
                          <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                          </span>
                      </a>
                      <ul class="treeview-menu">
                          <?php if(in_array('createSubcat', $user_permission)): ?>
                          <li id="createSubCatSubMenu">
                              <a href="<?php echo base_url('subcat/create') ?>">
                                  <i class="fa fa-circle-o"></i> Add Sub Category
                              </a>
                          </li>
                          <?php endif; ?>
                          <?php if(in_array('updateSubcat', $user_permission) || in_array('viewSubcat', $user_permission) || in_array('deleteSubcat', $user_permission)): ?>
                          <li id="manageSubCatSubMenu">
                              <a href="<?php echo base_url('subcat') ?>">
                                  <i class="fa fa-circle-o"></i> Manage Sub Category
                              </a>
                          </li>
                          <?php endif; ?>
                      </ul>
                  </li>
                  <?php endif; ?>
                 <?php if(in_array('createDisc', $user_permission) || in_array('updateDisc', $user_permission) || in_array('viewDisc', $user_permission) || in_array('deleteDisc', $user_permission)): ?>
                  <li id="discountMainNav">
                      <a href="<?php echo base_url('discount/') ?>">
                          <i class="fa fa-users"></i><span>Discount</span>
                      </a>
                  </li>
                  <?php endif; ?>
                   <?php if(in_array('createDisc', $user_permission) || in_array('updateDisc', $user_permission) || in_array('viewDisc', $user_permission) || in_array('deleteDisc', $user_permission)): ?>
                  <li id="paymentMainNav">
                      <a href="<?php echo base_url('payment/') ?>">
                          <i class="fa fa-money"></i><span>Payment Methods</span>
                      </a>
                  </li>
                  <?php endif; ?>
                  <?php if(in_array('createTable', $user_permission) || in_array('updateTable', $user_permission) || in_array('viewTable', $user_permission) || in_array('deleteTable', $user_permission)): ?>
                  <li id="tablesMainNav">
                      <a href="<?php echo base_url('tables/') ?>">
                          <i class="fa fa-braille"></i><span>Tables</span>
                      </a>
                  </li>
                  <?php endif; ?>
                  <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
          <?php endif; ?>

          <?php if(in_array('createOrder', $user_permission) || in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
            <li class="treeview" id="OrderMainNav">
              <a href="#">
                <i class="fa fa-clipboard"></i>
                <span>Point Of Sales</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createOrder', $user_permission)): ?>
                  <li id="createOrderSubMenu"><a href="<?php echo base_url('orders/create') ?>"><i class="fa fa-circle-o"></i> Add order</a></li>
                <?php endif; ?>
                <?php if(in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                <li id="manageOrderSubMenu"><a href="<?php echo base_url('orders') ?>"><i class="fa fa-circle-o"></i> Manage Orders</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

            <?php if(in_array('viewInven', $user_permission)): ?>
            <li class="treeview" id="InventoryMainNav">
              <a href="#">
                <i class="fa fa-archive"></i>
                <span>Inventory Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">

               <!--Main category-->
                <?php if(in_array('createOrderList', $user_permission) || in_array('updateOrderList', $user_permission) || in_array('viewOrderList', $user_permission) || in_array('deleteOrderList', $user_permission)): ?>
                  <li class="treeview" id="orderlistMainNav">
                      <a href="#">
                          <i class="fa fa-file-text"></i>
                          <span>Order List</span>
                          <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                          </span>
                      </a>
                      <ul class="treeview-menu">
                          <?php if(in_array('createOrderList', $user_permission)): ?>
                          <li id="createorderlistSubMenu">
                              <a href="<?php echo base_url('orderlist/create') ?>">
                                  <i class="fa fa-circle-o"></i> Add Order List
                              </a>
                          </li>
                          <?php endif; ?>
                          <?php if(in_array('updateOrderList', $user_permission) || in_array('viewOrderList', $user_permission) || in_array('deleteOrderList', $user_permission)): ?>
                          <li id="manageorderlistSubMenu">
                              <a href="<?php echo base_url('orderlist/') ?>">
                                  <i class="fa fa-circle-o"></i> Manage Order List
                              </a>
                          </li>
                          <?php endif; ?>
                      </ul>
                  </li>
                  <?php endif; ?>

              <?php if(in_array('createReqorder', $user_permission) || in_array('updateReqorder', $user_permission) || in_array('viewReqorder', $user_permission) || in_array('deleteReqorder', $user_permission)): ?>
                   <li class="treeview" id="requestorderlistMainNav">
                      <a href="#">
                          <i class="fa fa-shopping-cart"></i>
                          <span>Request Order</span>
                          <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                          </span>
                      </a>
                      <ul class="treeview-menu">
                          
                          <?php if(in_array('updateReqorder', $user_permission) || in_array('viewReqorder', $user_permission) || in_array('deleteReqorder', $user_permission)): ?>
                          <li id="managerequestorderSubMenu">
                              <a href="<?php echo base_url('requestorder/') ?>">
                                  <i class="fa fa-circle-o"></i> Manage Request Order
                              </a>
                          </li>
                          <?php endif; ?>
                      </ul>
                  </li>
              <?php endif; ?>
              <?php if(in_array('createStocktransfer', $user_permission) || in_array('updateStocktransfer', $user_permission) || in_array('viewStocktransfer', $user_permission) || in_array('deleteStocktransfer', $user_permission)): ?>
                   <li class="treeview" id="stocktransferMainNav">
                      <a href="#">
                          <i class="fa fa-archive"></i>
                          <span>Stock Transfer</span>
                          <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                          </span>
                      </a>
                      <ul class="treeview-menu">
                          
                          <?php if(in_array('updateStocktransfer', $user_permission) || in_array('viewStocktransfer', $user_permission) || in_array('deleteStocktransfer', $user_permission)): ?>
                          <li id="managestocktransferSubMenu">
                              <a href="<?php echo base_url('stock/') ?>">
                                  <i class="fa fa-circle-o"></i> Manage Stock Transfer
                              </a>
                          </li>
                          <?php endif; ?>
                      </ul>
                  </li>
              <?php endif; ?>


              <?php if(in_array('createStockadjustment', $user_permission) || in_array('updateStockadjustment', $user_permission) || in_array('viewStockadjustment', $user_permission) || in_array('deleteStockadjustment', $user_permission)): ?>
                  <li class="treeview" id="stockadjustmentMainNav">
                     <a href="#">
                          <i class="fa fa-line-chart"></i>
                          <span>Stock Adjustment</span>
                          <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                          </span>
                      </a>
                      <ul class="treeview-menu">
                          
                          <?php if(in_array('updateStockadjustment', $user_permission) || in_array('viewStockadjustment', $user_permission) || in_array('deleteStockadjustment', $user_permission)): ?>
                          <li id="managestockadjustmentSubMenu">
                              <a href="<?php echo base_url('stockadjustment/') ?>">
                                  <i class="fa fa-circle-o"></i> Manage Stock Adjustment
                              </a>
                          </li>
                          <?php endif; ?>
                          <?php if(in_array('viewStockadjustment', $user_permission)): ?>
                          <li id="managestockadjustment1SubMenu">
                              <a href="<?php echo base_url('stockadjustment/index2') ?>">
                                  <i class="fa fa-circle-o"></i> Stock Adjustment History
                              </a>
                          </li>
                          <?php endif; ?>
                      </ul>
                  </li>
              <?php endif; ?>

              <?php if(in_array('viewStock', $user_permission)): ?>
                   <li class="treeview" id="ProdStockMainNav">
                      <a href="#">
                          <i class="fa fa-archive"></i>
                          <span>Stocks</span>
                          <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                          </span>
                      </a>
                      <ul class="treeview-menu">
                          <?php if(in_array('viewStock', $user_permission)): ?>
                          <li id="prodstuckSubMenu">
                              <a href="<?php echo base_url('productstock/') ?>">
                                  <i class="fa fa-circle-o"></i>Stocks History
                              </a>
                          </li>
                          <?php endif; ?>
                         <?php if(in_array('viewStock', $user_permission)): ?>
                          <li id="prodstuck1SubMenu">
                              <a href="<?php echo base_url('productstock/index1') ?>">
                                  <i class="fa fa-circle-o"></i> Products Stocks
                              </a>
                          </li>
                          <?php endif; ?>
                       <?php if(in_array('viewStock', $user_permission)): ?>
                          <li id="prodstuck2SubMenu">
                              <a href="<?php echo base_url('productstock/index2') ?>">
                                  <i class="fa fa-circle-o"></i> Products Expiration
                              </a>
                          </li>
                          <?php endif; ?>
                      </ul>
                  </li>
              <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>





          <?php if(in_array('viewReport', $user_permission)): ?>
            <li class="treeview" id="ReportMainNav">
              <a href="#">
                <i class="fa fa-file-pdf-o"></i>
                <span>Reports</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('viewReport', $user_permission)): ?>
                  <li id="productReportSubMenu"><a href="<?php echo base_url('reports') ?>"><i class="fa fa-circle-o"></i> Product Wise</a></li>
                  <!-- <li id="storeReportSubMenu"><a href="<?php echo base_url('reports/storewise') ?>"><i class="fa fa-circle-o"></i> Total Store wise</a></li> -->
                <?php endif; ?>


                <!-- CHECKPOINT NGAYONG JANUARY -->
                <?php if(in_array('viewReport', $user_permission)): ?>
                  <li id="SalesHistoryMenu"><a href="<?php echo base_url('reports/saleshistory') ?>"><i class="fa fa-circle-o"></i> Sales History</a></li>
                  <!-- <li id="storeReportSubMenu"><a href="<?php echo base_url('reports/storewise') ?>"><i class="fa fa-circle-o"></i> Total Store wise</a></li> -->
                <?php endif; ?>
                <?php if(in_array('viewReport', $user_permission)): ?>
                  <li id="topProdSubMenu"><a href="<?php echo base_url('reports/topprod') ?>"><i class="fa fa-circle-o"></i> Top Products</a></li>
                  <!-- <li id="storeReportSubMenu"><a href="<?php echo base_url('reports/storewise') ?>"><i class="fa fa-circle-o"></i> Total Store wise</a></li> -->
                <?php endif; ?>
   
                <?php if(in_array('viewReport', $user_permission)): ?>
                  <li id="InventoryValuationSubMenu"><a href="<?php echo base_url('reports/valuation') ?>"><i class="fa fa-circle-o"></i> Inventory Valuation</a></li>
                  <!-- <li id="storeReportSubMenu"><a href="<?php echo base_url('reports/storewise') ?>"><i class="fa fa-circle-o"></i> Total Store wise</a></li> -->
                <?php endif; ?>
                <?php if(in_array('viewReport', $user_permission)): ?>
                  <li id="prodlistSubMenu"><a href="<?php echo base_url('reports/prodlist') ?>"><i class="fa fa-circle-o"></i> Product Master List</a></li>
                  <!-- <li id="storeReportSubMenu"><a href="<?php echo base_url('reports/storewise') ?>"><i class="fa fa-circle-o"></i> Total Store wise</a></li> -->
                <?php endif; ?>
                <?php if(in_array('viewReport', $user_permission)): ?>
                  <li id="stockHistorySubMenu"><a href="<?php echo base_url('reports/stockhistory') ?>"><i class="fa fa-circle-o"></i> Stock History</a></li>
                  <!-- <li id="storeReportSubMenu"><a href="<?php echo base_url('reports/storewise') ?>"><i class="fa fa-circle-o"></i> Total Store wise</a></li> -->
                <?php endif; ?>
                <?php if(in_array('viewReport', $user_permission)): ?>
                  <li id="expSubMenu"><a href="<?php echo base_url('reports/exp') ?>"><i class="fa fa-circle-o"></i> Near Expiration Products</a></li>
                  <!-- <li id="storeReportSubMenu"><a href="<?php echo base_url('reports/storewise') ?>"><i class="fa fa-circle-o"></i> Total Store wise</a></li> -->
                <?php endif; ?>
                <?php if(in_array('viewReport', $user_permission)): ?>
                  <li id="stockadjustmentHistorySubMenu"><a href="<?php echo base_url('reports/stock') ?>"><i class="fa fa-circle-o"></i> Stock Adjustment History</a></li>
                  <!-- <li id="storeReportSubMenu"><a href="<?php echo base_url('reports/storewise') ?>"><i class="fa fa-circle-o"></i> Total Store wise</a></li> -->
                <?php endif; ?>
                 <?php if(in_array('viewReport', $user_permission)): ?>
                  <li id="auditHistorySubMenu"><a href="<?php echo base_url('reports/audit') ?>"><i class="fa fa-circle-o"></i> Audit Trail</a></li>
                  <!-- <li id="storeReportSubMenu"><a href="<?php echo base_url('reports/storewise') ?>"><i class="fa fa-circle-o"></i> Total Store wise</a></li> -->
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>



          <?php if(in_array('viewSystem', $user_permission)): ?>
            <li class="treeview" id="SystemUtilityMainNav">
              <a href="#">
                <i class="fa fa-cog"></i>
                <span>System Utility</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
            <!--User-->
              <?php if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
              
                 <li class="treeview" id="userMainNav">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Users</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <?php if(in_array('createUser', $user_permission)): ?>
                  <li id="createUserSubNav">
                      <a href="<?php echo base_url('users/create') ?>">
                          <i class="fa fa-circle-o"></i> Add User
                      </a>
                  </li>
                  <?php endif; ?>
                  <ul class="treeview-menu">
                      <?php if(in_array('createUser', $user_permission)): ?>
                      <li id="createUserSubNav">
                          <a href="<?php echo base_url('users/create') ?>">
                              <i class="fa fa-circle-o"></i> Add User
                          </a>
                      </li>
                      <?php endif; ?>

                      <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                      <li id="manageUserSubNav">
                          <a href="<?php echo base_url('users') ?>">
                              <i class="fa fa-circle-o"></i> Manage Users
                          </a>
                      </li>
                      <?php endif; ?>
                  </ul>
                  <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                  <li id="manageUserSubNav">
                      <a href="<?php echo base_url('users') ?>">
                          <i class="fa fa-circle-o"></i> Manage Users
                      </a>
                  </li>
                  <?php endif; ?>
                  </ul>
                </li>
                <?php endif; ?>

                  <?php if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                  <li class="treeview" id="groupMainNav">
                      <a href="#">
                          <i class="fa fa-th"></i>
                          <span>Groups</span>
                          <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                          </span>
                      </a>
                      <ul class="treeview-menu">
                          <?php if(in_array('createGroup', $user_permission)): ?>
                          <li id="createGroupSubMenu">
                              <a href="<?php echo base_url('groups/create') ?>">
                                  <i class="fa fa-circle-o"></i> Add Group
                              </a>
                          </li>
                          <?php endif; ?>
                          <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                          <li id="manageGroupSubMenu">
                              <a href="<?php echo base_url('groups') ?>">
                                  <i class="fa fa-circle-o"></i> Manage Groups
                              </a>
                          </li>
                          <?php endif; ?>
                      </ul>
                  </li>
                  <?php if(in_array('updateCompany', $user_permission)): ?>
                    <li id="companyMainNav"><a href="<?php echo base_url('company/') ?>"><i class="fa fa-info-circle"></i> <span>Company Info</span></a></li>
                  <?php endif; ?>

                  <?php if(in_array('viewProfile', $user_permission)): ?>
                    <li id="profileMainNav"><a href="<?php echo base_url('users/profile/') ?>"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                  <?php endif; ?>
                
                  <!--number 1 -->
                  <?php if(in_array('createBackup', $user_permission)): ?>
                    <li id="BackupMainNav"><a href="<?php echo base_url('backup/index') ?>"><i class="fa fa-save"></i> <span>Backup & Restore Database</span></a></li>
                  <?php endif; ?>
                      </ul>
                    </li>
                  <?php endif; ?>
                <?php endif; ?>
        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
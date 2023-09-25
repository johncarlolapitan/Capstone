<?php 

class Model_backup extends CI_Model {
 
   public function droptable(){
	   $q = $this->db->query("SHOW TABLES");
	   if($q->num_rows()>0){
		   $query = $this->db->query('DROP TABLE audit, company, discount, groups, orderlist, orderlist_items, orders, order_items, payment_method, products, product_inventory, stockadjustment, stockadjustment_info, stock_history, tables, tbl_sub_category, tbl_main_category, users, user_group');

		   return $query;
	   }else{
		   return true;
	   }
   }
 
}
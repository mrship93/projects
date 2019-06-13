<?php



class AdminController extends AdminBase
{

		public	function  actionIndex() {

			

				require(ROOT . '/views/admin/index.php');

				return true;
  
			}
			
			

	

}

<?php



class AdminCategoryController extends AdminBase
{

		public	function  actionIndex() {

				
				
				$categoriesList = Category::getCategoryAdminList();
				

				require(ROOT . '/views/admin_category/index.php');

				return true;
  
			}
			
			
					public function actionDelete($id) {
						
						if (isset($_POST['submit'])) {
							header('location: /admin/category');
							Category::deleteCategoryById($id);
							
						}
						
						
				require(ROOT . '/views/admin_category/delete.php');

				return true;
		}
		
		
		public function actionCreate() {
						
		
			
			
			        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];

			
			$errors = false;
			
			if (!isset($options['name']) || empty($options['name'])) {
				$errors[] = 'Заполните поля';
			}
			
			if (!$errors) {
				Category::createCategory($options);
			}
			
		
			

			
			//header('location: /admin/product');
					}
					
					
			
			
				require(ROOT . '/views/admin_category/create.php');

				return true;
		}
	
	
			public function actionUpdate($id) {
						
		$category = Category::getCategoryById($id);
			
			
			        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];

			
			$errors = false;
			
			if (!isset($options['name']) || empty($options['name'])) {
				$errors[] = 'Заполните поля';
			}
			
			if (!$errors) {
				Category::updateCategory($id, $options);
			}
			
		
			

			
			//header('location: /admin/product');
					}
					
					
			
			
				require(ROOT . '/views/admin_category/update.php');

				return true;
		}
	

}

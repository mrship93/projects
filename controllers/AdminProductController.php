<?php



class AdminProductController extends AdminBase
{

		public	function  actionIndex() {

				
				
				$productsList = Product::getProductsList();

				require(ROOT . '/views/admin_product/index.php');

				return true;
  
			}
			
			
					public function actionDelete($id) {
						
						if (isset($_POST['submit'])) {
							header('location: /admin/product');
							Product::deleteProductById($id);
							
						}
						
						
				require(ROOT . '/views/admin_product/delete.php');

				return true;
		}
		
		
		public function actionCreate() {
						
		
			
			$categoriesList = Category::getCategoryList();
			        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];
			
			$errors = false;
			
			if (!isset($options['name']) || empty($options['name'])) {
				$errors[] = 'Заполните поля';
			}
			
			if (!$errors) {
				 $id = Product::createProduct($options);
			}
			
			if ($id) {
				 //Проверим, загружалось ли через форму изображение
				if (is_uploaded_file($_FILES['image']['tmp_name'])) {
					 // Если загружалось, переместим его в нужную папке, дадим новое имя
					 move_uploaded_file($_FILES['image']['tmp_name'], ROOT. "/upload/images/products/{$id}.jpg");
					
				}
			}
			

			
			//header('location: /admin/product');
					}
					
					
			
			
				require(ROOT . '/views/admin_product/create.php');

				return true;
		}
		
		public function actionUpdate($id) {
			
		
				
				$categoriesList = Category::getCategoryList();
				$product = Product::getProductById($id);
				
				if (isset($_POST['submit'])) {
					            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];
			
			            // Сохраняем изменения
            if (Product::updateProductById($id, $options)) {
                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                   move_uploaded_file($_FILES["image"]["tmp_name"], ROOT . "/upload/images/products/{$id}.jpg");
                }
            }
			
			
				}
				
				
				require(ROOT . '/views/admin_product/update.php');

				return true;
		}
	

}

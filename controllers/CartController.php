<?php



class CartController{
		public function actionAdd($id) {
			Cart::addProduct($id);
		//	Cart::IsProductInCart($id);
			$referer = $_SERVER['HTTP_REFERER'];
			header ('location:'.$referer);
		}
		
		
				public function actionAddItem($id) {
			Cart::addItemProduct($id);
		//	Cart::IsProductInCart($id);
			$referer = $_SERVER['HTTP_REFERER'];
			header ('location:'.$referer);
		}
		
		
						public function actionDelItem($id) {
			Cart::delItemProduct($id);
		//	Cart::IsProductInCart($id);
			$referer = $_SERVER['HTTP_REFERER'];
			header ('location:'.$referer);
		}
		
		
				public function actionAjaxAdd($id) {
			echo Cart::addProduct($id);
			return true;
		//	Cart::IsProductInCart($id);

		}
		
		
		public function actionIndex() {
			
		$categories = Category::getCategoryList();
		$products = Product::getLatestProduct();
			
		$productInCart = false;
		
		$productInCart = Product::getProducts();
		
		if ($productInCart) {
			$productsIds = array_keys($productInCart);
			$products = Product::getProductsByIds($productsIds);
			
			$totalPrice = Cart::getTotalPrice($products);
		}
			
			
			
						require_once ROOT.'/views/cart/index.php';
			
			return true;
		}
		
		public function actionDelete($id) {
			Cart::deleteProduct($id);
			
			header ('location: cart/');
		}
		
		
		 // Метод оформления заказа
		public function actionCheckout() {
			
			 
			 
		
			 
			 
			 
			 
			 
			  // Получием данные из корзины      
			$productsInCart = Cart::getProducts();
        // Если товаров нет, отправляем пользователи искать товары на главную
				 if (!$productsInCart) {
				 header('location: /');
			 }
        // Список категорий для левого меню
			$categories = Category::getCategoryList();
        // Находим общую стоимость
			$productsIds = array_keys($productsInCart);
			$products = Product::getProductsByIds($productsIds);
			$totalPrice = Cart::getTotalPrice($products);
			
        // Количество товаров
			$quantity = Cart:: countCart();
        // Поля для формы
		
		$phone = false;
		$message= false;
		$name = false;
		$email = false;
     
        // Статус успешного оформления заказа
		$result = false;
        // Проверяем является ли пользователь гостем
		if (!User::isGuest()) {
            // Если пользователь не гость
            // Получаем информацию о пользователе из БД
			$userId = User::checkLogged();
			$user = User::getUserById($userId);
			$name = $user['name'];
			$email = $user['email'];
		}
		else {
            // Если гость, поля формы останутся пустыми
			$userId = 0;
		}
        // Обработка формы
		if (isset($_POST['submit'])){
 
            // Если форма отправлена
            // Получаем данные из формы
			$email = $_POST['email'];
				$name = $_POST['name'];
				$phone = $_POST['phone'];
				$message = $_POST['message'];
            // Флаг ошибок
				$errors = false;
            // Валидация полей
				if(!User::checkName($name)) {
					$errors[] = 'Имя слишком мало';
				}
				
				if(!User::checkPhone($phone)) {
					$errors[] = 'Телефон мал';
				}
				
					
                // Если ошибок нет
				if (!$errors){
					
					
                // Сохраняем заказ в базе данных
				$result = Order::saveOrder($name, $phone, $message, $userId, $productsInCart);
				
				}
				
					if ($result) {

					}
                    // Если заказ успешно сохранен
                    // Оповещаем администратора о новом заказе по почте                
          						
						$to = $email;
						$subject = 'Заказ с сайта';
						$message = 'Что-то заказали';
						
						
						mail($to, $subject, $message);
                    // Очищаем корзину
				Cart::clear();
      
		}
			 
			
			
			
			
			
			
			
			require_once ROOT.'/views/cart/checkout.php';
			return true;
			
		}
		

		


}

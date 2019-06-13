<?php



class SiteController
{

    public function actionIndex()
    {
	$keys = Cart::IsProducts();
        $categories = Category::getCategoryList();
		$products = Product::getLatestProduct();
		$products_recommend = Product::getRecommProduct();
        require(ROOT . '/views/site/index.php');

        return true;
    }
	
	
	public function actionContacts() {
		
		$email = '';
		
		$message = '';
		
		$result = false;
		
		if (isset($_POST['submit'])) {
			
			$errors = false;
			
			$email = $_POST['email'];
			$message = $_POST['message'];
		
		if (!User::checkEmail($email)) {
			$errors[] = 'Некорректный email';
		}
		
		if (!$errors) {
				$mail = 'kostya.ship@mail.ru';
				$subject = 'Вопрос';
				$message = 'Письмо '.$message.' От '.$email;
		
				$result = mail($mail,$subject,$message);
				
				$result =  true;
		}
		
		}
		
		       require(ROOT . '/views/site/contact.php');

        return true;
		

		
	}

}

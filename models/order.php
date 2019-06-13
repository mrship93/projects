<?php
class Order {
	public static function saveOrder($name, $phone, $message, $userId, $productsInCart) {
		$products = json_encode($productsInCart);
		
		$db = Db::getConnection();
		$sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';
		$result = $db->prepare($sql);
		
		$result->bindParam(':user_name', $name, PDO::PARAM_STR);
		$result->bindParam(':user_phone', $phone, PDO::PARAM_STR);
		$result->bindParam(':user_comment', $message, PDO::PARAM_STR);
		$result->bindParam(':user_id', $userId, PDO::PARAM_STR);
		$result->bindParam(':products', $products, PDO::PARAM_STR);
		
		return $result->execute();

	}
	
	
	

	
	

	
	
}


?>
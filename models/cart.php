<?php
class Cart {
	public static function addProduct($id) {
		$id = intval($id);
		$productInCart = [];
		
		if (isset($_SESSION['products'])) {
			$productInCart = $_SESSION['products'];
		}
		
		if (array_key_exists($id,$productInCart)) {  // если ключи ид уже есть в массиве то ниего не делаем, если нет, добавляем в массив
			$productInCart = $productInCart;
			$items =  $productInCart[$id];
		}

		
		else {
			$productInCart[$id] = 1; // по умолчанию один товар
		}
		$_SESSION['products'] = $productInCart;
		//array_shift($productInCart);

		return self::countCart();
		

	}
	
	
	
		public static function addItemProduct($id) {
		$id = intval($id);
		$productInCart = [];
		
		if (isset($_SESSION['products'])) {
			$productInCart = $_SESSION['products'];
		}
		
		if (array_key_exists($id,$productInCart)) {  // если ключи ид уже есть в массиве то ниего не делаем, если нет, добавляем в массив
			$productInCart[$id]++;
			
		}

		
		else {
			$productInCart[$id] = 1; // по умолчанию один товар
		}
		$_SESSION['products'] = $productInCart;
		//array_shift($productInCart);

	
		

	}
	
	
			public static function delItemProduct($id) {
		$id = intval($id);
		$productInCart = [];
		
		if (isset($_SESSION['products'])) {
			$productInCart = $_SESSION['products'];
		}
		
		if (array_key_exists($id,$productInCart)) {  // если ключи ид уже есть в массиве то ниего не делаем, если нет, добавляем в массив
			$delItem = $productInCart[$id]--;
			
			if ($delItem<=1) {
				unset($productInCart[$id]);
			}
			
		}
		


		
		else {
			$productInCart[$id] = 1; // по умолчанию один товар
		}
		$_SESSION['products'] = $productInCart;
		//array_shift($productInCart);

	
		

	}
	
	
	
				 	  static function IsProducts() {
						 
			if (isset($_SESSION['products'])) {
				
				
		$keys = array_keys($_SESSION['products']);
		$key = implode(',',$keys);
	
		return $key;
				
				
				
			}
			else {
			return false;
			}
			
		 
	  }
	
	
	
	public static function deleteProduct($id) {
				if (isset($_SESSION['products'])) {
			unset($_SESSION['products'][$id]);
		
		}
	}
	
	
	public static function countCart() {
		if (isset($_SESSION['products'])) {
			$count = 0;
			foreach (($_SESSION['products']) as $id=>$quantity) {
				$count+=$quantity;
			}
			return $count;
		}
		
		else {
			return 0;
		}
	}
	
	public static function clear() {
		if (isset($_SESSION['products'])) { 
			unset($_SESSION['products']);
		
		}
	}
	
			 	  static function getProducts() {
						 
			if (isset($_SESSION['products'])) {
				return $_SESSION['products'];
			}
			else {
			return false;
			}
			
		 
	  }
	  
	  
	  	public static function getTotalPrice($products) {
		$productsInCart = self::getProducts();
		
		$total = 0;
		
			if (isset($productsInCart)) {
				foreach($products as $item) {
					$total += $item['price'] * $productsInCart[$item['id']];
				}
			}
		
		
		return $total;
	}
	
	/*
	public static function IsProductInCart() {
		
	
		
		if (isset($_SESSION['products'])) {
				foreach (($_SESSION['products']) as $id=>$quantity) {
				$isProduct = array_key_exists($id,$productInCart);
			}
		}
		
		
				if (array_key_exists($id,$productInCart) ) {
					return true;
		}
		else {
		return false;
		}
		
		
		
	}
	*/

	
	

	
	
}


?>
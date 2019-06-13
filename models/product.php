<?php



 class Product {
	 // константа , сколько продуктов отображать
	 const DEFAULT_PRODUCT = 6;
	 // получаем последние продукты
	 static function getLatestProduct($count = self::DEFAULT_PRODUCT) {
		 //Соединяемся с базой
		 $db = Db::getConnection();
		 
		 $result = $db->query("SELECT * FROM product WHERE status='1' ORDER BY id DESC  LIMIT {$count}  ");
		
		
		 // получаем массив записей и кидаем записи в промежуточный массив, чтобы обработать в котроллере и вывести в вид
		foreach($result as $row){
                $productList[] = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
					 'category_id' => $row['category_id'],
					 'price' => $row['price'],
					  'description' => $row['description'],
					   'is_new' => $row['is_new'],
					    'is_recommended' => $row['is_recommended'],
						 'status' => $row['status'],
                );
		    
		 }
		 return $productList; // возвращаем полученный массив
		
	 }
	 // получаем рекомендуемые продукты
	 static function getRecommProduct(){
		 		 $db = Db::getConnection();
		 
		 $result = $db->query("SELECT * FROM product WHERE status='1' AND is_recommended='1' ORDER BY id DESC");
		
		
		 
		foreach($result as $row){
                $productList[] = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
					 'category_id' => $row['category_id'],
					 'price' => $row['price'],
					  'description' => $row['description'],
					   'is_new' => $row['is_new'],
					    'is_recommended' => $row['is_recommended'],
						 'status' => $row['status'],
                );
		    
		 }
		 return $productList;
	 }
	 // получаем список всех продуктов
	 static function getProductsList() {
		 $db = Db::getConnection();
		 
		 $result = $db->query('SELECT * FROM product WHERE status="1"');
		 
		 foreach ($result as $row) {
			 $productList[] = array (
				                    'id' => $row['id'],
                    'name' => $row['name'],
					
					 'price' => $row['price'],
					 
					  
					   
						 'status' => $row['status'],
			 );
		 }
		 
		 return $productList;
	 }
	 
	 
	 
	 
	 // получаем товар по идентификатору
	 static function getProductById($id) {
		 $id = intval($id);
		 if ($id) {
			 $db = Db::getConnection();
			 $result = $db->query("SELECT * FROM product WHERE id=".$id);
			 $result->setFetchMode(PDO::FETCH_ASSOC);
			 return $result->fetch();
			 
		 }
	 }
	 
	 
	 // получаем Товары по идентификатору категории
	 static function getProductByCategory($id ) {
		 $id = intval($id);
		 		
			 $db = Db::getConnection();
					 $result = $db->query("SELECT * FROM product WHERE category_id= $id LIMIT ".self::DEFAULT_PRODUCT);
		
		 
		foreach($result as $row){
                $productList[] = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
					 'category_id' => $row['category_id'],
					 'price' => $row['price'],
					  'description' => $row['description'],
					   'is_new' => $row['is_new'],
					    'is_recommended' => $row['is_recommended'],
						 'status' => $row['status'],
                );
		    
		 }
		
			 
		 
		  return $productList;
	 }
	 
	 //получаем список товаров категории для пагинации
	 static function getProductListByCategory ($id = false, $page = 1) {
		 if ($id) {
			 $page = intval($page);
			 $offset = ($page - 1) * self::DEFAULT_PRODUCT;
			 $db = Db::getConnection();
			 $productsList = [];
			 $result = $db->query("SELECT * FROM product WHERE category_id= $id LIMIT " .self::DEFAULT_PRODUCT. " OFFSET $offset ");
			 foreach ($result as $row) {
				 $productsList[] = array (
					                    'id' => $row['id'],
                    'name' => $row['name'],
					 'category_id' => $row['category_id'],
					 'price' => $row['price'],
					  'description' => $row['description'],
					   'is_new' => $row['is_new'],
					    'is_recommended' => $row['is_recommended'],
						 'status' => $row['status'],
				 );
			 }
			
			 return $productsList;
			
		 }
	 }
	 
	 // получаем количество товаров из категории по идентификатору
	 static function getTotalProductListByCategory($id) {
		 $db = Db::getConnection();
			 $result = $db->query("SELECT count(id) AS count FROM product WHERE status='1' AND category_id= ".$id);
			 $result->setFetchMode(PDO::FETCH_ASSOC);
			 $row = $result->fetch();
			 return $row['count'];
	 }
	 
	 
	 //получаем товары по массиву идентификаторов
	  static function getProductsByIds($idsArray) {
						 
			
			$products = [];
			 $db = Db::getConnection();
			 $idsString = implode(',',$idsArray); //разбиваем массив в строку
			 $sql = "SELECT * FROM product WHERE id IN ($idsString)";
			 $result = $db->query($sql);
			
			 foreach ($result as $row) {
				 $products[] = array (
					                    'id' => $row['id'],
                    'name' => $row['name'],
					
					 'price' => $row['price'],
					 
					 
					   
				 );
			 }
			 return $products;
		 
	  }
	 
	 
	 // получаем товары из сессии
	 	  static function getProducts() {
						 
			if (isset($_SESSION['products'])) {
				return $_SESSION['products'];
			}
			else {
			return false;
			}
			
		 
	  }
	  
	  
	  static function deleteProductById($id) {
		  $db = Db::getConnection();
		  $sql = 'DELETE FROM product WHERE id = :id';
		  $result=$db->prepare($sql);
		  $result -> bindParam(':id',$id, PDO::PARAM_INT);
		  $result -> execute();
		  return true;
	  }
	  
	  static function createProduct($options) {
		  $db = Db::getConnection();
		$sql = 'INSERT INTO product (name, category_id, code, price, availability,  brand,  description, is_new, is_recommended, status) VALUES (:name, :category_id, :code, :price, :availability,  :brand, :description, :is_new, :is_recommended, :status)';
			$result=$db->prepare($sql);
		$result->bindParam(':name',$options['name'], PDO::PARAM_STR);
		 $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
       
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
		
		if ($result->execute()) {
			return $db->lastInsertId();
		}
		return 0;
	  }
	  
	  
	  static function updateProductById($id, $options) {
		  $db = Db::getConnection();
		  		$sql = 'UPDATE product SET name=:name, category_id=:category_id, code=:code, price=:price, availability=:availability,  brand=:brand,  description=:description, is_new=:is_new, is_recommended=:is_recommended, status=:status WHERE id=:id';
				
				
					$result=$db->prepare($sql);
		$result->bindParam(':name',$options['name'], PDO::PARAM_STR);
		 $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
       
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
		 $result->bindParam(':id', $id, PDO::PARAM_INT);
		return $result->execute();
	  }
	  
	  
	  static function getImage($id) {
		  $noImage = 'no-image.jpg';
		  $path = '/upload/images/products/';
		          // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';
        if (file_exists(ROOT.$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }
        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }
	
	// комментарии к товару
	
	 static function getComment($id) {
		 $comments = [];
		 $db = Db::getConnection();
		 $sql = 'SELECT * FROM comments WHERE tovar_id = :id';
		 $result = $db->prepare($sql);
		 $result->bindParam(':id', $id, PDO::PARAM_INT);
		
		 $result->execute();
		 foreach ($result as $row) {
			 $comments[] = array(
				'comment' => $row['comment'],
				'name' => $row['name'],
				'tovar_id' => $row['tovar_id'],
			 );
		 }
		 return $comments;
	 }
	 
	 static function getListRating($id) {
		 		
		 $db = Db::getConnection();
		 $sql = 'SELECT * FROM rating WHERE tovar_id = :id';
		 $result = $db->prepare($sql);
		 $result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		
		 $result->execute();
		return $result->fetch();
	 }
	 
	 
	 
	 	 static function getRating($id) {
		 		
		 $db = Db::getConnection();
		 $sql = 'SELECT * FROM rating WHERE tovar_id = :id';
		 $result = $db->prepare($sql);
		 $result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		
		 $result->execute();
		 $row = $result->fetch();
		return $row['rating'];
	 }
	 
	 
	 
	 	 static function rating($id, $sumRating) {
			 $ratingList = self::getListRating($id);
			
		if ($ratingList['count']>0) {
		  $count = $ratingList['count']+1;
		  $total = $ratingList['total'] + $sumRating;
		   $rating = round($ratingList['total']/$ratingList['count'],2);
		 $db = Db::getConnection();
		 $sql = 'UPDATE rating SET rating=:rating, count=:count, total=:total WHERE tovar_id = :id';
		 $result = $db->prepare($sql);
		 $result->bindParam(':rating', $rating, PDO::PARAM_INT);
		  $result->bindParam(':count', $count, PDO::PARAM_INT);
		   $result->bindParam(':total', $total, PDO::PARAM_INT);
		  $result->bindParam(':id', $id, PDO::PARAM_INT);

		
		return $result->execute();
		}
		else {
			return false;
		}
	 }
	 

	 

	 
	 
	 	 	 static function addRating($id, $sumRating) {
			
		
		
		  $count = 1;
		  $total = $sumRating;
		   $rating = $sumRating;
		 $db = Db::getConnection();
		 $sql = 'INSERT INTO rating (rating, tovar_id, count, total) VALUES (:rating, :tovar_id, :count, :total)';
		 $result = $db->prepare($sql);
		 $result->bindParam(':rating', $rating, PDO::PARAM_INT);
		  $result->bindParam(':tovar_id', $id, PDO::PARAM_INT);
		  $result->bindParam(':count', $count, PDO::PARAM_INT);
		   $result->bindParam(':total', $total, PDO::PARAM_INT);
		 
		 

		 
		
		
		
		return $result->execute();
		
	 }
	 
	 
	 static function sessionRating($id, $sumRating) {

		 $ratingInfo = [
			'id' => $id,
			'sumRating' =>$sumRating
		 ];
		 
		
		 if (!isset($_SESSION['info'])) {
		$_SESSION['info'] = [];
		 }
		 

		$_SESSION['info'][] = $ratingInfo;
	
		
		
		
		
		 
	 }
	 
	 
	  static function sessionSumRating($id) {
		  if (isset($_SESSION['info'])){
		
			foreach ($_SESSION['info'] as $ratings) {
				
				if (in_array($id, $ratings)) {
								
				
								return $ratings['sumRating'];
				
							
				}
				

			}
		return 0;
		  }
	  }
	 
	 static function sessionId($id) {
		 if (isset($_SESSION['info'])) {
		$sum = serialize($_SESSION['info']);
			 if (strpos($sum, $id)) {
				 return true;
			 }
			 else {
			 
			 return false;
			 }
		 }
	 }
	 

	 
	 

	 
	 
	 
	 static function getTotalCountRating($id) {
		 $ratingList = self::getListRating($id);
		 if ($ratingList['count']>0){
		 return $ratingList['count'];}
		 else {
			 return 0;
		 }
	 }
	 

		  
		  
	  }
	  

	 
 
	
	




?>
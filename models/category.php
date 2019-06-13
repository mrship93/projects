<?php



 class Category {
	 static function getCategoryList() {
		 $db = Db::getConnection();
		 
		 $result = $db->query('SELECT * FROM category WHERE status="1" ORDER BY sort_order DESC');
	
		 
		foreach($result as $row){
                $categoryList[] = array(
                    'id' => $row['id'],
                    'name' => $row['name']
                );
		    
		 }
		 return $categoryList;
		
	 }
	 
	 
	 	 static function getCategoryAdminList() {
		 $db = Db::getConnection();
		 
		 $result = $db->query('SELECT * FROM category');
	
		 
		foreach($result as $row){
                $categoryList[] = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
					'sort_order' => $row['sort_order'],
					'status' => $row['status'],
                );
		    
		 }
		 return $categoryList;
		
	 }
	 
	 static function getStatusText($status) {

				switch ($status) {
					case 1: return 'Опубликован';
					break;
					case 0: return 'не Опубликован';
					break;

				}
					
	 }
	 
	 
	 static function deleteCategoryById($id) {
		 		  $db = Db::getConnection();
		  $sql = 'DELETE FROM category WHERE id = :id';
		  $result=$db->prepare($sql);
		  $result -> bindParam(':id',$id, PDO::PARAM_INT);
		  $result -> execute();
		  return true;
	 }
	 
	 
	 
	 	  static function createCategory($options) {
		  $db = Db::getConnection();
		$sql = 'INSERT INTO category (name, sort_order, status) VALUES (:name, :sort_order, :status)';
			$result=$db->prepare($sql);
		$result->bindParam(':name',$options['name'], PDO::PARAM_STR);
		 $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);

        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
		
		if ($result->execute()) {
			return $db->lastInsertId();
		}
		return 0;
	  }
	  
	  
	  	 	  static function updateCategory($id, $options) {
		  $db = Db::getConnection();
		  		$sql = 'UPDATE category SET name=:name, sort_order=:sort_order, status=:status WHERE id=:id';
				
				
					$result=$db->prepare($sql);
		$result->bindParam(':name',$options['name'], PDO::PARAM_STR);

        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
		 $result->bindParam(':id', $id, PDO::PARAM_INT);
		return $result->execute();
	  }
	  
	  
	  
	  	 static function getCategoryById($id) {
		 		  $db = Db::getConnection();
		  $sql = 'SELECT * FROM category WHERE id = :id';
		  $result=$db->prepare($sql);
		  $result -> bindParam(':id',$id, PDO::PARAM_INT);
		  $result -> setFetchMode(PDO::FETCH_ASSOC);
		  $result->execute();
		 return  $result -> fetch();
		 
	 }
	  
	 
	 
	 
 }
	
	




?>
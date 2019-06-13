<?php
class User {
	public static function register($name, $email, $password) {
		$password = md5($password);
		$db = Db::getConnection();
		$sql = 'INSERT INTO user (name, email, password, role) VALUES (:name, :email, :password, "")';
		$result = $db->prepare($sql);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		
		return $result->execute();
	}
	
	
	
	public static function checkLogged() {
		if (isset($_SESSION['user'])) {
			return $_SESSION['user'];
		}
		else {
		header ('location: /user/login');
		}
	}
	
		public static function auth($userId) {
		
		$_SESSION['user'] = $userId;
	}
	
	
	
	
	
	public static function checkName($name) {
		if (strlen($name)>=2) {
			return true;
		}
		return false;
	}
	
	
		public static function checkEmail($email) {
		if (strlen($email)>=2) {
			return true;
		}
		return false;
	}
	
	
			public static function checkPass($password) {
		if (strlen($password)>=6) {
			return true;
		}
		return false;
	}
	
	public static function checkPhone($phone) {
				if (strlen($phone)>=9) {
			return true;
		}
		return false;
	}
	
	
	
	public static function checkEmailExists($email) {
		$db = Db::getConnection();
		$sql = 'SELECT email FROM user WHERE email=:email';
		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->execute();
		
		if ($result->fetch())
		{return true;}
		return false;
	}
	
	
	public static function checkUserData($email, $password) {
		$db = Db::getConnection();
		
		$sql = 'SELECT * FROM user WHERE email=:email AND password=:password';
		$result = $db->prepare($sql);
		
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		$result->execute();
		$user = $result->fetch();
		if ($user){
		return $user['id'];}
		else {
		return false;}
		
	}
	
	
	public static function isGuest() {
		if (isset($_SESSION['user'])) 
			return false;
		
		return true;
	}
	
	public static function getUserById($userId) {
		$db = Db::getConnection();
		$result = $db->query('SELECT * FROM user WHERE id='.$userId);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		
		return $result->fetch();
	}
	
	public static function edit($userId, $name, $password) {
		$db = Db::getConnection();
		$sql = "UPDATE user SET name = :name, password = :password WHERE id = :id";
		$result = $db->prepare($sql);
		
		$result->bindParam(':id', $userId, PDO::PARAM_STR);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		return $result->execute();
		

	}
	
	

	
	
}


?>
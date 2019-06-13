<?php
	abstract class AdminBase{
		//public static function checkAdmin() {
			//$userId = User::checkLogged();
			//$user = User::getUserById($userId);
			
			//Роль пользователя
			
			//if ($user['role'] == 'admin') {
			//	return true;
			//}
			
			
			//	die('Не админ');
			
			
	//	}
		
		public function __construct() { // создаем конструктор, чтобы при вызове класса проверять админа
						$userId = User::checkLogged();
			$user = User::getUserById($userId);
			
			//Роль пользователя
			
			if ($user['role'] == 'admin') {
				return true;
			}
			
			
				die('Не админ');
		}
		
	}


?>
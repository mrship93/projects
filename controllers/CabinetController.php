<?php
	class CabinetController {
		public function actionIndex() {
			
			$userId = User::checkLogged();
			
			$user = User::getUserById($userId);
			
			
			require_once ROOT.'/views/cabinet/index.php';
			
			return true;
		}
		
		
		 public function actionEdit(){
		
		
				$userId = User::checkLogged();
				$user = User::getUserById($userId);
				$name= $user['name'];
				$password=$user['password'];;
				$result = false;
		
				if (isset($_POST['submit'])) {
				
				$name= $_POST['name'];
				
				$password=$_POST['password'];
				$errors = false;
				
				if (!User::checkName($name)) {
					
				
					$errors[] = "Имя меньше, чем нужно";
				}
				
				
				
				
				
						if (!User::checkPass($password)) {
				
					$errors[] = "Пароль меньше, чем нужно";
				}
				
				if($errors==false) {
					$result = User::edit($userId, $name, $password);
				}
				
				}
				
				require(ROOT . '/views/cabinet/edit.php');

				return true;
    }
		
		
		
	}



?>
<?php



class UserController
{

    public function actionRegister()
	
    {
		
		$name='';
		$email='';
		$password='';
		$result = false;
		
		if (isset($_POST['submit'])) {
		
		$name= $_POST['name'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$errors = false;
		
		if (!User::checkName($name)) {
			
		
			$errors[] = "Имя меньше, чем нужно";
		}
		
		
				if (User::checkEmailExists($email)) {
			$errors[] = "Почта уже есть";
		}
		
		
				if (!User::checkPass($password)) {
		
			$errors[] = "Пароль меньше, чем нужно";
		}
		
		if($errors==false) {
			$result = User::register($name, $email, $password);
		}
		
		}
		
        require(ROOT . '/views/user/register.php');

        return true;
    }
	
	
	
	
	    public function actionLogin()
	
    {
		
		
		$email='';
		$password='';
		$result = false;
		
		if (isset($_POST['submit'])) {
		
		
		$email=$_POST['email'];
		$password=$_POST['password'];
		$errors = false;
		

		
		
				if (!User::checkEmail($email)) {
			$errors[] = "Почта коротка";
		}
		
		
				if (!User::checkPass($password)) {
		
			$errors[] = "Пароль меньше, чем нужно";
		}
		
		$userId = User::checkUserData($email, $password);
		
		if ($userId==false) {
			$errors[] = "неправильные данные для входа на сайта";
		}
		
		else {
			User::auth($userId);
			header ('location: /cabinet/');
			
		}
		
		}
		
        require(ROOT . '/views/user/login.php');

        return true;
    }
	
		public function actionLogout() {
			unset($_SESSION['user']);
			header('location: /');
	}

	

}

<?php
	class Router{
		private $routes;  //массив, в котором хранятся маршруты
		
		public function __construct() {
			$routespath = ROOT.'/config/routes.php';
			$this->routes = include($routespath);
			
		}
		
		
		// Метод getURI возвращает строку из адреса в браузере
		
		private function getURI() {
			if (!empty ($_SERVER['REQUEST_URI'])) {
				return trim ($_SERVER['REQUEST_URI'],'/');
			}
		}
		
		
		public function run() {
			
			$uri = $this->getURI();  //Получаем строку запроса в браузере
			
			
			foreach ($this->routes as $uriPattern => $path) {  // Проверяем наличие такого запроса в routes
				if (preg_match("~$uriPattern~",$uri)) { // Смотримм, есть ли в нашей строке какой-нибудт роут из файла routes
				
				
					$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
				
						
				
					$segments = explode ('/',$internalRoute); // Делим нашу строку на элементы с разделителем /
					
					
					
					$controllerName = array_shift ($segments).'Controller'; // Значение первого элменента из переменной сегментс и удаляем его из массива
					$controllerName = ucfirst($controllerName); //Первое слово с большой буквы
					
					
					$actionName = 'action'.ucfirst(array_shift ($segments));
					
					 $parameters = $segments;
					
				
					
					
					$controllerFile = ROOT.'/controllers/'.   // Подключаем файл контроллера из папки контроллерс
						$controllerName . '.php' ;
						
						
					if (file_exists($controllerFile)) {   // если файл существует, то подключаем
						include($controllerFile);
					}
					
					
					
					$controllerObject = new $controllerName;
					 $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
					
					if ($result !=null) {
						break;
					}
					
					
					
					
				}
			}
		}
		
	}


?>
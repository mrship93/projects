<?php
	//Здесь пишем наши роуты (маршруты , по которым будет идти пользователь на сайте)
	
	
	return array (
	    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
		//'news/([a-z]+)/([0-9]+)' => 'news/view/$1/$2',
		//'news'=>'news/index',    // Actionindex в NewsController
		 'product/rating/([0-9]+)/([0-9]+)' => 'product/rating/$1/$2', // actionAdd в CartController
		 'product/([0-9]+)' => 'product/view/$1', // actionView в ProductController
		
		// Каталог:
    'catalog' => 'catalog/index', // actionIndex в CatalogController
    // Категория товаров:
	'cart/delete/([0-9]+)' => 'cart/delete/$1', // actionDelete в CartController
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory в CatalogController   
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory в CatalogController
	'cart/add/([0-9]+)' => 'cart/add/$1', // actionAdd в CartController
	'cart/addItem/([0-9]+)' => 'cart/addItem/$1', // actionAddItem в CartController
	'cart/delItem/([0-9]+)' => 'cart/delItem/$1', // actionAddItem в CartController
	'cart/ajaxAdd/([0-9]+)' => 'cart/ajaxAdd/$1', // actionAdd в CartController
	'cart/checkout'=>'cart/checkout', //actionCheckout в CartController
	'cart'=>'cart/index',
	
	'contacts'=>'site/contacts',
	'admin/product/create' => 'adminProduct/create',
	'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
	'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
	'admin/product'=>'adminProduct/index',
	'admin/category/create' => 'adminCategory/create',
	'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
	'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
	'admin/category' => 'adminCategory/index',
	
	
	
	
	'admin'=>'admin/index',
	
	
		
		'index.php' => 'site/index', // actionIndex в SiteController
		'' => 'site/index', // actionIndex в SiteController
	);


?>
<?php


class CatalogController
{

	    public function actionIndex()
    {
	
        $categories = Category::getCategoryList();
		$products = Product::getLatestProduct();
        require(ROOT . '/views/catalog/index.php');

        return true;
    }
	
		public function actionCategory($id, $page = 1) {
			 $categories = Category::getCategoryList();
			 $products = Product::getProductListByCategory($id, $page);
			 $total = Product::getTotalProductListByCategory($id);
			 
			 $pagination = new Pagination($total, $page, Product::DEFAULT_PRODUCT, 'page-');
			 
			 
			 
			 
			 require(ROOT . '/views/catalog/category.php');
			 return true;
		}

}

<?php



class ProductController
{
	
	
	
		public function actionRating($id, $sumRating) {
			
			
			
			echo $ratingOneItem = Product::getRating($id);
			
			Product::sessionRating($id, $sumRating);
	
		
	  $getTotalCountRating = Product::getTotalCountRating($id);
			 
	
			
			
				$rating = Product::getListRating($id);
				if (!Product::rating($id, $sumRating)){
					 Product::addRating($id, $sumRating);
					
					
				}
			
		
		
		return true;
	}
	
	
	

    public function actionView($id)
    {	
	
	$summ = Product::sessionSumRating($id);
	$session = Product::sessionId($id);
		
		
		$ratingOneItem = Product::getRating($id);
		$getTotalCountRating = Product::getTotalCountRating($id);
		$rating = Product::getListRating($id);
		$comments = Product::getComment($id);
		$categories = Category::getCategoryList();
        $product = Product::getProductById($id);
		$img = Product::getImage($id);
		

		

        require_once(ROOT . '/views/product/view.php');

        return true;
    }
	


}

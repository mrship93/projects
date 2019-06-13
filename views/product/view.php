<?php require ROOT . '/template/header.php' ?>

<section>
    <div class="container">
        <div class="row">
                        <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $categoryItem): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/category/<?php echo $categoryItem['id'];?>">
                                            <?php echo $categoryItem['name'];?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="<?= Product::getImage($product['id']); ?>" alt="" />
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <img src="<? $img ?>" class="newarrival" alt="" />
                                <h2><?php echo $product['name'];?></h2>
                                <p>Код товара: <?php echo $product['code'];?></p>
                                <span>
                                    <span>US $<?php echo $product['price'];?></span>
                                    <label>Количество:</label>
                                    <input type="text" value="3" />
                                    <button type="button" class="btn btn-fefault cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        В корзину
                                    </button>
                                </span>
                                <p><b>Наличие:</b> На складе</p>
                                <p><b>Состояние:</b> Новое</p>
                                <p><b>Производитель:</b> D&amp;G</p>
								 <p><b>Рейтинг товара:</b><span id="totalRating"> <?= $ratingOneItem ?> </span></p>
								 
						<?if ($session===true): ?>
						<p>Вы уже поставили оценку <?php print_r($summ)  ?> </p>
							

							
							
							
							
					<?else: ?>
						<div class="ratingBlock">
								 <p>Оценить товар:</p>
								 <form action="#" method="post">
								 <input type="submit" value="1" name="rating" data-id="<?=$product['id'] ?>" class="rate">
								 <input type="submit" value="2" name="rating" data-id="<?=$product['id'] ?>" class="rate">
								 <input type="submit" value="3" name="rating" data-id="<?=$product['id'] ?>" class="rate">
								 <input type="submit" value="4" name="rating" data-id="<?=$product['id'] ?>" class="rate">
								 <input type="submit" value="5" name="rating" data-id="<?=$product['id'] ?>" class="rate">
								 </form>
								 </div>
					<?endif; ?>
								 <p>Оценили <span id="totalCount"><?= $getTotalCountRating ?></span> человек(а)</p>
                            </div><!--/product-information-->
                        </div>
                    </div>
                    <div class="row">                                
                        <div class="col-sm-12">
                            <h5>Описание товара</h5>
                            <?php echo $product['description'];?>
                        </div>
                    </div>
					
					                   <div class="row">                                
                        <div class="col-sm-12">
                            <h2>Комментарии</h2>
							<? if($comments): ?>
							<? foreach ($comments as $comment): ?>
							<hr>
							<p><?=$comment['name'] ?></p>
                            <p><?=$comment['comment'] ?></p>
							<? endforeach; ?>
							<? else: ?>
							</p>Комментарии отсутствуют</p>
							<? endif; ?>
                        </div>
                    </div>
					
                </div><!--/product-details-->

            </div>
        </div>
    </div>
</section>

<?php require ROOT.'/template/footer.php' ?>
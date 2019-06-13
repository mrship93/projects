<?php require ROOT.'/template/header.php' ?>

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
                        <div class="features_items"><!--features_items-->
                            <h2 class="title text-center">Последние товары</h2>
							 <?php foreach ($products as $item): ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="<?= Product::getImage($item['id']) ?>" alt="" />
                                            <h2><?= $item['price'] ?>$</h2>
                                            <p><a href="/product/<?= $item['id'] ?>"><?= $item['name'] ?></a></p>
											
											
                                          
											<? if (strpos($keys, $item['id'])!==false): ?>
											
										
											                                           <a href="#" class="btn btn-default is-to-cart"><i class="fa fa-shopping-cart"></i>Уже в корзине</a>
										<?else: ?>
										  <a href="#" data-id="<?=$item['id']?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
										  <? endif; ?>
                                        </div>
										<?php if ($item['is_new']): ?>
										 <img src="/template/images/home/new.png" class="new" alt="" />
										 <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                         <?php endforeach;?>

                        </div><!--features_items-->

                            <div class="recommended_items"><!--recommended_items-->
                            <h2 class="title text-center">Рекомендуемые товары</h2>

                            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
								<? foreach ($products_recommend as $product): ?>
                                    <div class="item active">
										
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img src="<?= Product::getImage($product['id']); ?>" alt="" />
                                                        <h2>$<?= $product['price'] ?></h2>
                                                        <p><?= $product['name'] ?></p>
                                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
									
                                    </div>
									<? endforeach; ?>
                                </div>
                                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>			
                            </div>
                        </div><!--/recommended_items-->

                    </div>
                </div>
            </div>
        </section>

<?php require ROOT.'/template/footer.php' ?>
<?php include ROOT . '/template/header.php'; ?>

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
					<div class="signup-form"><!--sign up form-->
					<?php if ($result): ?>
                        <p>Заказ оформлен. Мы Вам перезвоним.</p>
                    <?php else: ?>
					<? if (!$result): ?>
					<?= 'какая-то ошибка' ?>
					<? if (isset($errors) and is_array($errors)): ?>
					
					<? foreach ($errors as $error): ?>
					
					
					<p><?=$error ?></p>
					<? endforeach; ?>
					
					<? endif;?>
					
					<p>Всего товаров: <?=$quantity ?><br> На сумму: <?= $totalPrice ?>$</p>
						<h2>Введите ваши данные</h2>
						<form action="#" method="post">
						<input type="text" placeholder="email" name="email" value="<?= $email?>"/>
							<input type="text" placeholder="phone" name="phone" value="<?= $phone?>"/>
							<input type="text" placeholder="message" name="message" value="<?= $message?>"/>
							<input type="text" placeholder="name" name="name" value="<?= $name?>"/>
							
							<input type="submit" class="btn btn-default" value="Signup" name="submit">
						</form>
					</div><!--/sign up form-->

					<? endif; ?>
                <? endif;?>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/template/footer.php'; ?>
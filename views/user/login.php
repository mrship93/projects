<?php require ROOT . '/template/header.php' ?>
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">


				<div class="col-sm-4 col-sm-offset-4">
				<?php if($result): ?>
					<p>Вы зарегистрированы!</p>
				<?php else: ?>
				<?php if(isset($errors)&& is_array($errors)): ?>
					<ul>
					<?php foreach($errors as $error): ?>
						<li><?= $error?></li>
					<? endforeach; ?>
					</ul>
				
				<? endif; ?>
				
					<div class="signup-form"><!--sign up form-->
						<h2>Вход</h2>
						<form action="#" method="post">
							
							<input type="email" placeholder="Email Address" name="email" value="<?= $email?>"/>
							<input type="password" placeholder="Password" name="password" value="<?= $password?>"/>
							<input type="submit" class="btn btn-default" value="Signup" name="submit">
						</form>
					</div><!--/sign up form-->
					<? endif; ?>
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
<?php require ROOT . '/template/footer.php' ?>
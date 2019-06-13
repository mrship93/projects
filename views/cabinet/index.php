<?php require ROOT . '/template/header.php' ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
					<h1>Здравствуйте, <?= $user['name'] ?></h1>
                    <h2>Кабинет пользователя</h2>
					<ul>
						<li><a href="/cabinet/edit">Редактировать данные</a></li>
						<li><a href="/cabinet/history">История покупок</a></li>
					</ul>
               
            </div>


        </div>
    </div>
</section>

<?php require ROOT . '/template/footer.php' ?>
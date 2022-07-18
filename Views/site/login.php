<div class="container">
	<?php if($display_error): ?>
		<div class="error">Некорректные данные авторизации</div>
	<?php endif; ?>
	
	<form class="form" action="/login" method="post">
		<div class="form-group">
			<label for="name">Имя</label>
			<input type="text" name="name" class="form-control" id="name"  placeholder="Имя">
		</div>
		
		<div class="form-group">
			<label for="email">Пароль</label>
			<input type="password" name="password" class="form-control" id="password" placeholder="Пароль">
		</div>

		<button type="submit" class="btn btn-primary mt-2">Отправить</button>
	</form>

</div>
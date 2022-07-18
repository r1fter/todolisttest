<div class="container">
	<div>
		<span>Имя: <?= $model['name'] ?></span>
	</div>

	<div>
		<span>Email: <?= $model['email'] ?></span>
	</div>

	<form class="form" method="post" action="/task/edit?id=<?= $model['id'] ?>">
		<div class="form-group">
			<label for="description">Описание</label>
			<textarea name="description" class="form-control" id="description" rows="3" required><?= $model['description'] ?></textarea>
		</div>

		<div class="form-group">
			<label for="is_completed">Задача завершена</label>
			<input type="checkbox" name="is_completed" <?php if($model['is_completed']): ?>checked disabled<?php endif; ?>>
		</div>

		<button type="submit" class="btn btn-primary mt-2">Отправить</button>
	</form>

</div>
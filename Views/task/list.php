<table class="table">
	<thead class="thead-dark">
		<tr>
			<?php foreach($fields as $field): ?>
				<th scope="col">
					<?php if($field['sortable']): ?>
						<a class="thead-link 
							<?php if($sort_by == $field['name']): ?>sorted<?php endif; ?>" 
							data-name="<?= $field['name'] ?>" 
							data-sortorder="<?= $sort_by == $field['name'] ? $sort_order : 'desc' ?>"
						>
					<?php endif; ?>

						<?= $field['display_name'] ?>
					<?php if($field['sortable']):?></a><?php endif; ?>
				</th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($rows as $row): ?>
			<tr>
				<td><?= htmlspecialchars($row['name']) ?></td>
				<td><?= htmlspecialchars($row['email']) ?></td>
				<td><?= htmlspecialchars($row['description']) ?></td>
				<td><input type="checkbox" <?php if($row['is_completed']): ?>checked<?php endif; ?> disabled></td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>


<ul class="pagination">
	<?php for($i=1; $i <= $pagenum; $i++): ?>
		<li class="page-item <?php if($i == $page): ?>disabled<?php endif; ?>">
			<a class="page-link <?php if($i == $page): ?>active<?php endif; ?>" data-index="<?= $i ?>"><?= $i ?></a>
		</li>
	<?php endfor; ?>
</ul>
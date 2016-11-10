<div class="page-header">
	<h2>
		<?= $pageName ?>
	</h2>
</div>

<ul class="list-group">
	<?php foreach($users as $nextUser): 
		$isPersonal = false;
	?>
		<li class="list-group-item">
			<h4>
				<a href="<?= BASE_URL ?>/"><?= $nextUser->username ?></a>
			</h4>
		</li>
	<?php endforeach; ?>
</ul>

<div class="page-header">
	<h2>Search Results for "<?= $qry ?>"</h2>
</div>

<?php if($numResults === 0): ?>
	<p>No results found</p>
<?php else: ?>

<?php endif; ?>

<div id="content">
	<ul class="list-group">
		<?php foreach($courses as $c):
			$creator = $c->getCreator(); ?>
			<li class="list-group-item">
				<h4>
					<a href="<?= BASE_URL ?>/courses/view/<?= $c->id ?>"><?= $c->coursename ?></a>
					<small>
						by
						<a href="<?= BASE_URL ?>/authors/view/<?= $creator->username ?>">
							<?= $creator->username ?>
						</a>
					</small>
				</h4>
				<p><?= $c->coursedescription; ?></p>
			</li>

		<?php endforeach; ?>

		<?php foreach($users as $u): ?>
			<li class="list-group-item">
				<a href="<?= BASE_URL ?>/authors/view/<?= $u->username ?>">User: <?= $u->username ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>

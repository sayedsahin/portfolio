<?php $this->layout('layout.dashboard'); ?>
<?php $this->start('content'); ?>

<div class="home">
	<!-- logout -->
	<?php if (\App\Supports\Auth::check()): ?>
		<p>Welcome, <?= $this->e(\App\Supports\Auth::user()->name) ?>! <a href="/logout">Logout</a></p>
	<?php else: ?>
		<p><a href="/login">Login</a> | <a href="/register">Register</a></p>
	<?php endif; ?>

	<h2><?= $this->e($title ?? 'Welcome') ?></h2>
	<p>Welcome to the site. This is a simple home page.</p>

	<?php if (!empty($users) && is_array($users)): ?>
		<h3>My Info</h3>
		<ul>
			<?php foreach ($users as $user): ?>
				<li><?= $this->e($user->name ?? $user->name ?? '') ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</div>

<?php $this->end(); ?>

<?php $this->start('scripts'); ?>
<!-- Page-specific scripts can go here -->
<?php $this->end(); ?>

<?php $this->layout('layout.dashboard'); ?>

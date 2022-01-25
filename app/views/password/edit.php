<?php view('dashboard/header'); ?>
<section Class="col-md-4 col-sm-6 col-10 mx-auto mt-3">
	<h3>Update Password</h3>
	<?php
	    helper(['message']);
	    message();
	?>
	<form action="<?= BASE_URL; ?>/password/update" method="post">
		<div class="mb-3">
			<label for="old-password" class="form-label">Old Password</label>
			<input type="password" name="old-password" placeholder="Type Your Old Password" class="form-control" id="old-password" autocomplete="current-password">
		</div>
		<div class="mb-3">
			<label for="password" class="form-label">New Password</label>
			<input type="password" name="password" placeholder="Type New Password" class="form-control" id="password" autocomplete="new-password">
		</div>
		<div class="mb-3">
			<label for="confirm-password" class="form-label">Confirm Password</label>
			<input type="password" name="confirm-password" placeholder="Re-Type New Password" class="form-control" id="confirm-password" autocomplete="new-password">
		</div>
		<button type="submit" name="password-update" class="btn btn-secondary">Update</button>
	</form>
</section>
<?php view('dashboard/footer'); ?>
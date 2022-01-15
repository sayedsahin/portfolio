<?php view('dashboard/header'); ?>
<section class="col-md-4 col-sm-6 col-10 mx-auto mt-3">
	<h3>Change Password</h3>
	<form>
		<div class="mb-3">
			<label for="password" class="form-label">Current Password</label>
			<input type="password" class="form-control" id="password">
		</div>
		<div class="mb-3">
			<label for="password" class="form-label">New Password</label>
			<input type="password" class="form-control" id="password">
		</div>
		<div class="mb-3">
			<label for="password" class="form-label">Confirm Password</label>
			<input type="password" class="form-control" id="password">
		</div>
		<button type="submit" class="btn btn-secondary">Submit</button>
	</form>
</section>
<?php view('dashboard/footer'); ?>
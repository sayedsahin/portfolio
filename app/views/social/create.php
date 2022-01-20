<?php view('dashboard/header'); ?>
<section Class="col-md-4 col-sm-6 col-10 mx-auto mt-3">
	<h3>Add a new social icon</h3>
	<?php
	    helper(['message']);
	    message();
	?>
	<form action="<?= BASE_URL; ?>/social/store" method="post">
		<div class="mb-3">
			<label for="name" class="form-label">Name</label>
			<input type="text" name="name" placeholder="Project Name" class="form-control" id="name">
		</div>
		<div class="mb-3">
			<label for="link" class="form-label">Link</label>
			<input type="text" name="link" placeholder="https://github.com/username/socialname" class="form-control" id="link">
		</div>
		<div class="mb-3">
			<label for="icon" class="form-label">Icon</label>
			<textarea name="icon" placeholder="<svg xmlns='http://www.w3.org...." class="form-control" id="icon" rows="3"></textarea>
		</div>
		<button type="submit" name="social" class="btn btn-secondary">Submit</button>
	</form>
</section>
<?php view('dashboard/footer'); ?>
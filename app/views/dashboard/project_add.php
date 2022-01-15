<?php view('dashboard/header'); ?>
<section class="col-md-4 col-sm-6 col-10 mx-auto mt-3">
	<h3>Add a new project</h3>
	<form>
		<div class="mb-3">
			<label for="name" class="form-label">Project Name</label>
			<input type="text" class="form-control" id="name">
			<div class="form-text">We'll never share your email with anyone else.</div>
		</div>
		<div class="mb-3">
			<label for="name" class="form-label">Github Link</label>
			<input type="text" class="form-control" id="name">
			<div class="form-text">We'll never share your email with anyone else.</div>
		</div>
		<div class="mb-3">
			<label for="name" class="form-label">Preview Link</label>
			<input type="text" class="form-control" id="name">
			<div class="form-text">We'll never share your email with anyone else.</div>
		</div>
		<div class="mb-3">
			<label for="name" class="form-label">Image</label>
			<input type="file" class="form-control" id="name">
			<div class="form-text">We'll never share your email with anyone else.</div>
		</div>
		<button type="submit" class="btn btn-secondary">Submit</button>
	</form>
</section>
<?php view('dashboard/footer'); ?>
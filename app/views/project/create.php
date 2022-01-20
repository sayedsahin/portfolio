<?php view('dashboard/header'); ?>
<section Class="col-md-4 col-sm-6 col-10 mx-auto mt-3">
	<h3>Add a new project</h3>
	<?php
	    helper(['message']);
	    message();
	?>
	<form action="<?= BASE_URL; ?>/project/store" method="post" enctype="multipart/form-data">
		<div class="mb-3">
			<label for="name" class="form-label">Project Name</label>
			<input type="text" name="name" placeholder="Project Name" class="form-control" id="name">
		</div>
		<div class="mb-3">
			<label for="source" class="form-label">Github Link</label>
			<input type="text" name="source" placeholder="https://github.com/username/projectname" class="form-control" id="source">
		</div>
		<div class="mb-3">
			<label for="name" class="form-label">Preview Link</label>
			<input type="text" name="preview" placeholder="http://example.com" class="form-control" id="name">
		</div>
		<div class="mb-3">
			<label for="description" class="form-label">Description</label>
			<textarea name="description" placeholder="Description" class="form-control" id="description" rows="3"></textarea>
		</div>
		<div class="mb-3">
			<label for="name" class="form-label">Image</label>
			<input type="file" name="image" class="form-control" id="name">
		</div>
		<button type="submit" name="project" class="btn btn-secondary">Submit</button>
	</form>
</section>
<?php view('dashboard/footer'); ?>
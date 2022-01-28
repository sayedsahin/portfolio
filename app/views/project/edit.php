<?php view('dashboard/header'); ?>
<section Class="col-md-4 col-sm-6 col-10 mx-auto mt-3">
	<div class="bg-light mt-2 p-2 rounded d-flex justify-content-between align-items-baseline" style="border: 1px solid #ebebeb;">
	    <button onclick="window.location.href='<?= BASE_URL ?>/projects';" class="border px-1 py-0 rounded">&larr;Back</button>
		<h3>Edit project</h3>
	    <button onclick="window.location.href='<?= BASE_URL ?>/projects/<?= $project['id']; ?>';" class="border px-1 py-0 rounded">view</button>
	</div>
	<?php
	    helper(['message']);
	    message();
	?>
	
	<form action="<?= BASE_URL; ?>/projects/<?= $project['id']; ?>/update" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $project['id']; ?>">
		<div class="mb-3">
			<label for="name" class="form-label">Project Name*</label>
			<input type="text" name="name" value="<?= $project['name'] ?>" placeholder="Project Name" class="form-control" id="name">
		</div>
		<div class="mb-3">
			<label for="name" class="form-label">Github Link</label>
			<input type="text" name="source" value="<?= $project['source'] ?>" placeholder="https://github.com/username/projectname" class="form-control" id="name">
		</div>
		<div class="mb-3">
			<label for="name" class="form-label">Preview Link</label>
			<input type="text" name="preview" value="<?= $project['preview'] ?>" placeholder="http://example.com" class="form-control" id="name">
		</div>
		<div class="mb-3">
			<label for="description" class="form-label">Description</label>
			<textarea name="description" placeholder="Description" class="form-control" id="description" rows="3"><?= $project['description'] ?></textarea>
		</div>
		<div class="mb-3">
			<label for="image" class="form-label">Image</label>
			<label for="image"><img class="rounded-2 w-50 d-block" src="<?= BASE_URL ?>/<?= $project['thumb'] ?>" alt=""></label>
			<input type="file" name="image" class="form-control" id="image">
		</div>
		<button type="submit" name="project" class="btn btn-secondary">Update</button>
	</form>

	<form class="mt-3" action="<?= BASE_URL; ?>/projects/image/store" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $project['id']; ?>">
		<div class="mb-3">
			<label for="image" class="form-label">Upload More Image</label>
			<style>
				.height-fit { object-fit: cover; max-height: 90px;}
			</style>
			<div class="row">
				<?php if ($images): ?>
				<?php foreach ($images as $key => $image): ?>
				<div class="col-auto">
					<img class="rounded-2 border mx-1 w-100 height-fit" src="<?= BASE_URL ?>/<?= $image['image'] ?>" alt="">
					<a class="d-block text-center" href="<?= BASE_URL ?>/projects/image/<?= $image['id'] ?>/delete">remove</a>
				</div>
				<?php endforeach; ?>
				<?php endif ?>
			</div>
			<div class="d-flex mt-2">
				<input type="file" name="images[]" multiple name="image" class="form-control me-2" id="image">
				<button type="submit" name="project" class="btn btn-secondary">Add</button>
			</div>
		</div>
	</form>
</section>
<?php view('dashboard/footer'); ?>
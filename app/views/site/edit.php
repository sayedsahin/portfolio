<?php view('dashboard/header'); ?>
<div class="bg-light mt-2 p-2 rounded d-flex justify-content-between align-items-baseline" style="border: 1px solid #ebebeb;">

    <h5 class="text-black-50">Site Icon Edit</h5>
    <button onclick="window.location.href='<?= BASE_URL ?>/dashboard/';" class="border px-2 py-1 rounded">Back</button>
</div>
<section Class="col-md-4 col-sm-6 col-10 mx-auto mt-3">
	<h3>Edit site Info</h3>
	<?php
	    helper(['message']);
	    message();
	?>
	<form action="<?= BASE_URL; ?>/site/update" method="post">
		<div class="mb-3">
			<label for="title" class="form-label">Title*</label>
			<input type="text" name="title" value="<?= $site['title'] ?>" placeholder="Title...." class="form-control" id="title">
		</div>
		<div class="mb-3">
			<label for="tagline" class="form-label">Tagline</label>
			<input type="text" name="tagline" value="<?= $site['tagline'] ?>" placeholder="Tagline..." class="form-control" id="tagline">
		</div>
		<div class="mb-3">
			<label for="location" class="form-label">Location</label>
			<input type="text" name="location" value="<?= $site['location'] ?>" placeholder="Location..." class="form-control" id="location">
		</div>

		<div class="mb-3">
			<label for="copyright" class="form-label">Copyright</label>
			<input type="text" name="copyright" value="<?= $site['copyright'] ?>" placeholder="Copyright..." class="form-control" id="copyright">
		</div>

		<div class="mb-3">
			<label for="description" class="form-label">Description (for seo meta tag)</label>
			<textarea name="description" placeholder="Description..." class="form-control" id="description" rows="3"><?= $site['description'] ?></textarea>
		</div>

		<div class="mb-3">
			<label for="credit" class="form-label">Credit</label>
			<textarea name="credit" placeholder="Credit..." class="form-control" id="credit" rows="3"><?= $site['credit'] ?></textarea>
		</div>
		
		<button type="submit" name="site" class="btn btn-secondary">Update</button>
	</form>
</section>
<?php view('dashboard/footer'); ?>
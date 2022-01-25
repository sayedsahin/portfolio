<?php view('dashboard/header'); ?>
<div class="bg-light mt-2 p-2 rounded d-flex justify-content-between align-items-baseline" style="border: 1px solid #ebebeb;">

    <h5 class="text-black-50">Social Icon Edit</h5>
    <button onclick="window.location.href='<?= BASE_URL ?>/socials';" class="border px-2 py-1 rounded">Back</button>
</div>
<section Class="col-md-4 col-sm-6 col-10 mx-auto mt-3">
	<!-- <h3>Edit social icon</h3> -->
	<p class="d-block mx-auto" style="width: 70px;"><?= $social['icon'] ?></p>
	<?php
	    helper(['message']);
	    message();
	?>
	<form action="<?= BASE_URL; ?>/socials/<?= $social['id']; ?>/edit" method="post">
		<input type="hidden" name="id" value="<?= $social['id']; ?>">
		<div class="mb-3">
			<label for="name" class="form-label">Social Name*</label>
			<input type="text" name="name" value="<?= $social['name'] ?>" placeholder="Project Name" class="form-control" id="name">
		</div>
		<div class="mb-3">
			<label for="name" class="form-label">Social Link</label>
			<input type="text" name="link" value="<?= $social['link'] ?>" placeholder="https://github.com/username/socialname" class="form-control" id="name">
		</div>

		<div class="mb-3">
			<label for="icon" class="form-label">Social Icon</label>
			<textarea name="icon" placeholder="<svg xmlns='http://www.w3.org...." class="form-control" id="icon" rows="3"><?= $social['icon'] ?></textarea>
		</div>
		
		<button type="submit" name="social" class="btn btn-secondary">Update</button>
	</form>
</section>
<?php view('dashboard/footer'); ?>
<?php view('dashboard/header'); ?>
<section class="col-md-4 col-sm-6 col-10 mx-auto mt-3">
	<h3 class="text-center">My Information</h3>
	<div class="my-3 text-center">
		<img class="rounded-circle" style="width: 10rem" src="<?= BASE_URL.'/public/assets/img/sayed.jpg' ?>" alt="">
		<?php
		    helper(['message']);
		    message();
		?>
	</div>
	<form method="post" action="<?= BASE_URL; ?>/user/name">
		<div class="mb-3">
			<label for="name" class="form-label">Your Name</label>
			<div class="d-flex">
				<input type="text" name="name" class="form-control" id="name" value="<?= $user['name']; ?>">
				<button class="ms-2 btn btn-secondary">Save</button>
			</div>
		</div>
	</form>
	<form method="post" action="<?= BASE_URL; ?>/user/email">
		<div class="mb-3">
			<label for="email" class="form-label">Email address</label>
			<div class="d-flex">
				<input type="email" name="email" class="form-control" id="email" value="<?= $user['email']; ?>">
				<button class="ms-2 btn btn-secondary">Save</button>
			</div>
		</div>
	</form>
	<form method="post" action="<?= BASE_URL; ?>/user/contact">
		<div class="mb-3">
			<label for="phone" class="form-label">Phone Number</label>
			<div class="d-flex">
				<input type="text" name="contact" class="form-control" id="phone" value="<?= $user['contact']; ?>">
				<button class="ms-2 btn btn-secondary">Save</button>
			</div>
		</div>
	</form>
	<form method="post" action="<?= BASE_URL; ?>/user/info">
		<div class="mb-3">
			<label for="skill" class="form-label">Skill Info (short)</label>
			<div class="d-flex">
				<input type="text" name="info" class="form-control" id="skill" value="<?= $user['info']; ?>">
				<button class="ms-2 btn btn-secondary">Save</button>
			</div>
		</div>
	</form>
	<form method="post" action="<?= BASE_URL; ?>/user/avatar" enctype="multipart/form-data">
		<div class="mb-3">
			<label for="image" class="form-label">Avatar</label>
			<div class="d-flex">
				<input type="file" name="avatar" class="form-control" id="image" value="<?= $user['name']; ?>">
				<button class="ms-2 btn btn-secondary">Save</button>
			</div>
		</div>
	</form>
	<form method="post" action="<?= BASE_URL; ?>/user/about">
		<div class="mb-3">
			<label for="about" class="form-label">About</label>
			<input type="hidden" name="user_id" value="<?= $about['user_id'] ?>">
			<textarea name="about_1" class="form-control" id="about" rows="3"><?= $about['about_1'] ?></textarea>
		</div>
		<button class="btn btn-secondary">Save</button>
	</form>
	<form method="post" action="<?= BASE_URL; ?>/user/experience">
		<div class="mb-3">
			<label for="about2" class="form-label">Experience</label>
			<input type="hidden" name="user_id" value="<?= $about['user_id'] ?>">
			<textarea name="about_2" class="form-control" id="about2" rows="3"><?= $about['about_2'] ?></textarea>
		</div>
		<button class="btn btn-secondary">Save</button>
	</form>
</section>
<?php view('dashboard/footer'); ?>

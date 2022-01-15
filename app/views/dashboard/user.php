<?php view('dashboard/header'); ?>
<section class="col-md-4 col-sm-6 col-10 mx-auto mt-3">
	<h3 class="text-center">My Information</h3>
	<div class="my-3 text-center">
		<img class="rounded-circle" style="width: 10rem" src="<?= BASE_URL.'/public/assets/img/sayed.jpg' ?>" alt="">
	</div>
	<form>
		<div class="mb-3">
			<label for="name" class="form-label">Your Name</label>
			<div class="d-flex">
				<input type="text" class="form-control" id="name">
				<button class="ms-2 btn btn-secondary">Save</button>
			</div>
			<div class="form-text">We'll never share your email with anyone else.</div>
		</div>
	</form>
	<form>
		<div class="mb-3">
			<label for="email" class="form-label">Email address</label>
			<div class="d-flex">
				<input type="email" class="form-control" id="email">
				<button class="ms-2 btn btn-secondary">Save</button>
			</div>
			<div class="form-text">We'll never share your email with anyone else.</div>
		</div>
	</form>
	<form>
		<div class="mb-3">
			<label for="phone" class="form-label">Phone Number</label>
			<div class="d-flex">
				<input type="text" class="form-control" id="phone">
				<button class="ms-2 btn btn-secondary">Save</button>
			</div>
			<div class="form-text">We'll never share your email with anyone else.</div>
		</div>
	</form>
	<form>
		<div class="mb-3">
			<label for="skill" class="form-label">Skill Info (short)</label>
			<div class="d-flex">
				<input type="text" class="form-control" id="skill">
				<button class="ms-2 btn btn-secondary">Save</button>
			</div>
			<div class="form-text">We'll never share your email with anyone else.</div>
		</div>
	</form>
	<form>
		<div class="mb-3">
			<label for="image" class="form-label">Avatar</label>
			<div class="d-flex">
				<input type="file" class="form-control" id="image">
				<button class="ms-2 btn btn-secondary">Save</button>
			</div>
			<div class="form-text">We'll never share your email with anyone else.</div>
		</div>
	</form>
	<form>
		<div class="mb-3">
			<label for="about" class="form-label">About 1</label>
			<textarea class="form-control" id="about" rows="3"></textarea>
			<div class="form-text">We'll never share your email with anyone else.</div>
		</div>
		<button class="btn btn-secondary">Save</button>
	</form>
	<form>
		<div class="mb-3">
			<label for="about2" class="form-label">About 2</label>
			<textarea class="form-control" id="about2" rows="3"></textarea>
			<div class="form-text">We'll never share your email with anyone else.</div>
		</div>
		<button class="btn btn-secondary">Save</button>
	</form>
</section>
<?php view('dashboard/footer'); ?>

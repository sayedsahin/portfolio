<?php view('dashboard/header'); ?>
<section Class="col-md-4 col-sm-6 col-10 mx-auto mt-3">
	<h3>Send a new email</h3>
	<?php message(); ?>
	<form action="<?= BASE_URL; ?>/message/sendMessage" method="post">
		<div class="mb-3">
			<label for="email" class="form-label">To (email)</label>
			<input type="text" name="email" placeholder="jondoe@example.com" class="form-control" id="email">
		</div>
		<div class="mb-3">
			<label for="subject" class="form-label">Subject</label>
			<input type="text" name="subject" placeholder="jondoe@example.com" class="form-control" id="subject">
		</div>
		<div class="mb-3">
			<label for="body" class="form-label">Message</label>
			<textarea name="body" placeholder="Message....." class="form-control" id="body" rows="3"></textarea>
		</div>
		<button type="submit" name="newemail" class="btn btn-secondary">Send</button>
	</form>
</section>
<?php view('dashboard/footer'); ?>
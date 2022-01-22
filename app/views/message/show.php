<?php view('dashboard/header'); ?>
<section class="col-lg-8 mx-auto">
	<div class="bg-light mt-2 p-2 rounded d-flex justify-content-between align-items-baseline" style="border: 1px solid #ebebeb;">

    <h5 class="text-black-50">Display Message</h5>
    <button onclick="window.location.href='<?= BASE_URL ?>/message';" class="border px-2 py-1 rounded">Back</button>
</div>
	<?php message();?>
	<div class="card mt-2" style="">
		<pre class="card-body" style="white-space: pre-wrap; word-wrap: break-word;">
Name: <?= $message['name']; ?>

Email: <?= $message['email']; ?>

Phone: <?= $message['phone']; ?>


<?= $message['body'] ?>


<?= dateFormat($message['created_at']); ?>

		</pre>

	</div>
	<?php if ($replies): ?>
	<?php foreach ($replies as $key => $reply): ?>
	<div class="card mt-2">
		<pre class="card-body" style="white-space: pre-wrap; word-wrap: break-word;">
<?= time_ago($reply['created_at']); ?> ago

<?= $reply['body'] ?>
		</pre>
	</div>
	<?php endforeach ?>
	<?php endif ?>
	<form action="<?= BASE_URL; ?>/message/reply" method="post" class="mt-3">
		<div class="mb-3">
			<input type="hidden" name="message_id" value="<?= $message['id'] ?>">
			<input type="hidden" name="name" value="<?= $message['name'] ?>">
			<input type="hidden" name="email" value="<?= $message['email'] ?>">
			<input type="hidden" name="subject" value="<?= textShorten($message['body'], 30) ?>">
			<textarea name="body" placeholder="reply message" class="form-control" id="icon" rows="3"></textarea>
		</div>
		
		<button type="submit" name="reply" class="btn btn-secondary">Reply</button>
	</form>
</section>
<?php view('dashboard/footer'); ?>
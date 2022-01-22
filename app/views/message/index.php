<?php view('dashboard/header'); ?>
<div class="bg-light mt-2 p-2 rounded d-flex justify-content-between align-items-baseline" style="border: 1px solid #ebebeb;">

    <h5 class="text-black-50">Project List</h5>
    <!-- <button onclick="window.location.href='<?= BASE_URL ?>/message/create';" class="border px-2 py-1 rounded">New</button> -->
</div>
<?php message();?>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Message</th>
      <th scope="col">Time</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <?php 
      if ($messages) { $i=0;
      foreach ($messages as $key => $message) {  $i++;
    ?>
    <tr>
      <th scope="row"><?= $i; ?></th>
      <td><?= $message['name']; ?></td>
      <td><?= $message['email']; ?></td>
      <td><?= $message['phone']; ?></td>
      <td><?= textShorten($message['body'], 30); ?></td>
      <td><?= time_ago($message['created_at']); ?></td>
      <td>
        <a href="<?= BASE_URL; ?>/message/show/<?= $message['id']; ?>" class="btn btn-outline-dark btn-sm">view</a>
        <a href="<?= BASE_URL; ?>/message/delete/<?= $message['id']; ?>" class="btn btn-danger btn-sm">delete</a>
      </td>
    </tr>
    <?php } } ?>
  </tbody>

<?php view('dashboard/footer'); ?>
</table>
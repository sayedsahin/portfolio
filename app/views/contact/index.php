<?php view('dashboard/header'); ?>
<div class="bg-light mt-2 p-2 rounded d-flex justify-content-between align-items-baseline" style="border: 1px solid #ebebeb;">

    <h5 class="text-black-50">Project List</h5>
    <!-- <button onclick="window.location.href='<?= BASE_URL ?>/contact/create';" class="border px-2 py-1 rounded">New</button> -->
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
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($contacts as $key => $contact) { ?>
    <tr>
      <th scope="row"><?= $contact['id']; ?></th>
      <td><a class="fw-bold text-secondary" href="<?= BASE_URL; ?>/contact/show/<?= $contact['id']; ?>"><?= $contact['name']; ?></a></td>
      <td><?= $contact['email']; ?></td>
      <td><?= $contact['phone']; ?></td>
      <td><?= textShorten($contact['message'], 30); ?></td>
      <td>
        <a href="<?= BASE_URL; ?>/contact/edit/<?= $contact['id']; ?>" class="btn btn-secondary btn-sm">reply</a>
        <a href="<?= BASE_URL; ?>/contact/edit/<?= $contact['id']; ?>" class="btn btn-outline-dark btn-sm">view</a>
        <a href="<?= BASE_URL; ?>/contact/delete/<?= $contact['id']; ?>" class="btn btn-danger btn-sm">delete</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>

<?php view('dashboard/footer'); ?>
</table>
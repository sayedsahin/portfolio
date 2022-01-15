<?php view('dashboard/header'); ?>
<div class="bg-light mt-2 p-2 rounded d-flex justify-content-between align-items-baseline" style="border: 1px solid #ebebeb;">

    <h5 class="text-black-50">Project List</h5>
    <button onclick="window.location.href='<?= BASE_URL ?>/dashboard/projectadd';" class="border px-2 py-1 rounded">New</button>
</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Thumb</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($projects as $key => $project) { ?>
    <tr>
      <th scope="row"><?= $project['id']; ?></th>
      <td><?= $project['name']; ?></td>
      <td><?= $project['description']; ?></td>
      <td>
        <img style="width: 50px;" src="<?= BASE_URL.'/'.$project['thumb']; ?>" alt="">
      </td>
      <td>
        <a href="<?= BASE_URL ?>" class="text-secondary">Edit</a>
        <a href="<?= BASE_URL ?>" class="text-danger">delete</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>

<?php view('dashboard/footer'); ?>
</table>
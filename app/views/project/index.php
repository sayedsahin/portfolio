<?php view('dashboard/header'); ?>
<div class="bg-light mt-2 p-2 rounded d-flex justify-content-between align-items-baseline" style="border: 1px solid #ebebeb;">

    <h5 class="text-black-50">Project List</h5>
    <button onclick="window.location.href='<?= BASE_URL ?>/project/create';" class="border px-2 py-1 rounded">New</button>
</div>
<?php
    helper(['message']);
    message();
?>
<table class="table table-striped align-baseline">
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
    <?php 
    if ($projects) {
    foreach ($projects as $key => $project) { 
    ?>
    <tr>
      <th scope="row"><?= $project['id']; ?></th>
      <td><a class="fw-bold text-secondary" href="<?= BASE_URL; ?>/project/show/<?= $project['id']; ?>"><?= $project['name']; ?></a></td>
      <td><?= $project['description']; ?></td>
      <td>
        <img style="width: 50px;" src="<?= BASE_URL.'/'.$project['thumb']; ?>" alt="">
      </td>
      <td>
        <div class="d-flex">
          <a href="<?= BASE_URL; ?>/project/edit/<?= $project['id']; ?>" class="btn btn-dark px-2 py-0 me-1">Edit</a>
          <a onclick="return confirm('Are you sure?')" href="<?= BASE_URL; ?>/project/delete/<?= $project['id']; ?>" class="btn btn-danger px-2 py-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">Del</a>
        </div>
      </td>
    </tr>
    <?php } } ?>
  </tbody>

<?php view('dashboard/footer'); ?>
</table>
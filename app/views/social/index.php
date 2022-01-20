<?php view('dashboard/header'); ?>
<style>
  .w-svg {width: 24px;height: 25px;}
</style>
<div class="bg-light mt-2 p-2 rounded d-flex justify-content-between align-items-baseline" style="border: 1px solid #ebebeb;">

    <h5 class="text-black-50">Social Icon List</h5>
    <button onclick="window.location.href='<?= BASE_URL ?>/social/create';" class="border px-2 py-1 rounded">New</button>
</div>
<?php
    helper(['message']);
    message();
?>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">name</th>
      <th scope="col">link</th>
      <th scope="col">icon</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($socials as $key => $social) { ?>
    <tr>
      <th scope="row"><?= $social['id']; ?></th>
      <td><?= $social['name']; ?></td>
      <td><?= $social['link']; ?></td>
      <td style="width: 24px; height: 24px"><?= $social['icon']; ?></td>
      <td>
        <a class="btn btn-dark btn-sm" href="<?= BASE_URL; ?>/social/edit/<?= $social['id']; ?>" class="text-secondary">Edit</a>
        <a class="btn btn-danger btn-sm" href="<?= BASE_URL; ?>/social/delete/<?= $social['id']; ?>" class="text-danger">delete</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>

<?php view('dashboard/footer'); ?>
</table>
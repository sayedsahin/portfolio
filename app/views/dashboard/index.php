<?php ob_start(); ?>
<h1>Dashboard</h1>
<!-- Page-specific scripts can go here -->
<?php $content = ob_get_clean(); ?>

<?php require view_path('layout.dashboard'); ?>

<?php

ob_start();
?>
<h2><?= $this->e($title) ?></h2>
<?= flash(); ?>
<form method="post" action="/login">
    <?= $this->csrfField() ?>
    <p>
        <label>
            Email
        </label><br>
            <input type="email" name="email" required>
    </p>
    <p>
        <label>
            Password
        </label><br>
            <input type="password" name="password" required>
    </p>
    <!-- remember -->
    <div>
        <label>
            Remember Me
        </label>
            <input type="checkbox" name="remember">
    </div><br>
    <button type="submit">Login</button>
</form>

<?php $this->end(); ?>

<?php $this->start('scripts'); ?>
<script></script>
<?php $this->end(); ?>



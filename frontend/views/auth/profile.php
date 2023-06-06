<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Profile");
?>

<p>
    Logged in as <b><?= $this->user->username ?></b>
</p>

<?php if ($this->user->user_role === "admin") : ?>
    <p>(admin user)</p>
<?php endif; ?>




<form action="<?= $this->home ?>/auth/logout" method="post">
    <input type="submit" value="Log out" class="btn delete-btn">
</form>

<?php Template::footer(); ?>
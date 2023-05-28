<?php
require_once __DIR__ . "/../../Template.php";

Template::header("New post");
?>

<h1>New post</h1>

<form action="<?= $this->home ?>/posts" method="post">
    <input type="text" name="post_name" placeholder="Post Name"> <br>

    <?php if ($this->user->user_role === "admin") : ?>
        <input type="number" name="user_id" placeholder="User ID"> <br>
    <?php endif; ?>

    <input type="submit" value="Save" class="btn">
</form>

<?php Template::footer(); ?>
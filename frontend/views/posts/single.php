<?php
require_once __DIR__ . "/../../Template.php";

Template::header($this->model["post"]->post_id);
?>

<h1><?= $this->model["post"]->post_id ?></h1>

<p>
    <b>Id: </b>
    <?= $this->model["post"]->post_id ?>
</p>

<p>
    <b>Product name: </b>
    <?= $this->model["post"]->content ?>
</p>

<?php if ($this->user->user_role === "admin") : ?>

    <p>
        <b>User ID: </b>
        <?= $this->model["post"]->user_id ?>
    </p>

<?php endif; ?>

<?php Template::footer(); ?>
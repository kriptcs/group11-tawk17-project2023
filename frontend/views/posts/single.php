<?php
require_once __DIR__ . "/../../Template.php";
$title = "Post Number";

Template::header($this->model["post"]->post_id);
// This page was created to display a selected resource.
?>

<h1> Post number <?= $this->model["post"]->post_id ?></h1>

<p>
    <b>Id: </b>
    <?= $this->model["post"]->post_id ?>
</p>

<p>
    <b>The post: </b>
    <?= $this->model["post"]->content ?>
</p>

<?php if ($this->user->user_role === "admin") : ?>

    <p>
        <b>User ID: </b>
        <?= $this->model["post"]->user_id ?>
    </p>

<?php endif; ?>

<?php Template::footer(); ?>
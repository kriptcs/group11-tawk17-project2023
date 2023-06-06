<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Edit " . $this->model->post_id);
?>

<h1>Edit Post Number <?= $this->model->post_id ?></h1>

<form action="<?= $this->home ?>/posts/<?= $this->model->post_id ?>/edit" method="post">
<h3> Post </h3>
    <input type="text" name="content" value="<?= $this->model->content ?>" placeholder="Content Name"> <br>

    <h3>User ID</h3>
    <input type="number" name="user_id" value="<?= $this->model->user_id ?>" placeholder="User ID"> <br>

    <input type="submit" value="Save" class="btn">
</form>

<form action="<?= $this->home ?>/posts/<?= $this->model->post_id ?>/delete" method="post">
    <input type="submit" value="Delete" class="btn delete-btn">
</form>

<?php Template::footer(); ?>
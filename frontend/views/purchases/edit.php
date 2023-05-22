<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Edit " . $this->model->purchase_id);
?>

<h1>Edit <?= $this->model->purchase_id ?></h1>

<form action="<?= $this->home ?>/purchases/<?= $this->model->purchase_id ?>/edit" method="post">
    <input type="text" name="product_name" value="<?= $this->model->product_name ?>" placeholder="Product name"> <br>
    <input type="number" name="price" value="<?= $this->model->price ?>" placeholder="Price"> <br>

    <input type="number" name="user_id" value="<?= $this->model->user_id ?>" placeholder="User ID"> <br>

    <input type="submit" value="Save" class="btn">
</form>

<form action="<?= $this->home ?>/purchases/<?= $this->model->purchase_id ?>/delete" method="post">
    <input type="submit" value="Delete" class="btn delete-btn">
</form>

<?php Template::footer(); ?>
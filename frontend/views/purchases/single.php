<?php
require_once __DIR__ . "/../../Template.php";

Template::header($this->model["purchase"]->purchase_id);
?>

<h1><?= $this->model["purchase"]->purchase_id ?></h1>

<p>
    <b>Id: </b>
    <?= $this->model["purchase"]->purchase_id ?>
</p>

<p>
    <b>Product name: </b>
    <?= $this->model["purchase"]->product_name ?>
</p>

<p>
    <b>Price: </b>
    <?= $this->model["purchase"]->price ?>
</p>

<p>
    <b>Purchase time: </b>
    <?= $this->model["purchase"]->purchase_time ?>
</p>

<?php if ($this->user->user_role === "admin") : ?>

    <p>
        <b>User ID: </b>
        <?= $this->model["purchase"]->user_id ?>
    </p>

<?php endif; ?>


<h2>Converted currencies</h2>
<?php foreach ($this->model["converted_currencies"] as $currency => $price) : ?>
    <p><?= $currency ?>: <?= $price ?></p>
<?php endforeach; ?>

<form action="" method="get">
    <h2>Convert to</h2>

    <select name="to_currency">

        <?php foreach ($this->model["available_currencies"] as $key => $currency) : ?>
            <option value="<?= $key ?>"><?= $currency ?></option>
        <?php endforeach; ?>

    </select>

    <input type="submit" value="Convert">
</form>

<?php Template::footer(); ?>
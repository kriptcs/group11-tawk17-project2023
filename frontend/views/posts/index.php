<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Purchases");
?>

<h1>Purchases</h1>

<a href="<?= $this->home ?>/purchases/new">Create new</a>

<div class="item-grid">

    <?php foreach ($this->model as $purchase) : ?>

        <article class="item">
            <div>
                <b><?= $purchase->product_name ?></b> <br>
                <span>Price: <?= $purchase->price ?></span> <br>
                <span>Purchased: <?= $purchase->purchase_time ?></span> <br>
            </div>


            <?php if ($this->user->user_role === "admin") : ?>

                <p>
                    <b>User ID: </b>
                    <?= $purchase->user_id ?>
                </p>
            <a href="<?= $this->home ?>/purchases/<?= $purchase->purchase_id ?>/edit">Edit</a>

            <?php endif; ?>

            <a href="<?= $this->home ?>/purchases/<?= $purchase->purchase_id ?>">Show</a>
        </article>

    <?php endforeach; ?>

</div>

<?php Template::footer(); ?>
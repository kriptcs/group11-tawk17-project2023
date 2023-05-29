<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Posts");
?>

<h1>Post</h1>

<a href="<?= $this->home ?>/posts/new">Create new</a>

<div class="item-grid">

    <?php foreach ($this->model as $post) : ?>

        <article class="item">
            <div>
                <b><?= $post->content ?></b> <br>
            </div>


            <?php if ($this->user->user_role === "admin") : ?>

                <p>
                    <b>User ID: </b>
                    <?= $post->user_id ?>
                </p>
            <a href="<?= $this->home ?>/posts/<?= $post->post_id ?>/edit">Edit</a>

            <?php endif; ?>

            <a href="<?= $this->home ?>/posts/<?= $post->post_id ?>">Show</a>
        </article>

    <?php endforeach; ?>

</div>

<?php Template::footer(); ?>
<?php
require_once __DIR__ . "/../Template.php";

Template::header("Articles"); 
//PAGE TO SHOW ALL POSTS OF ALL USERS WITHOUT ADMIN ACCESS. NO ACCESS TO MODIFY THEM THOUGH.
?>
<h1>Post</h1>
<div class="item-grid">

    <?php foreach ($this->model as $post) : ?>

        <article class="item">
            <div>
                <b><?= $post->content ?></b> <br>
            </div>
        </article>

    <?php endforeach; ?>

</div>

<?php Template::footer(); ?>
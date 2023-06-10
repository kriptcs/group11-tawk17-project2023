<?php
require_once __DIR__ . "/../Template.php";
require_once __DIR__ . "/../../business-logic/PostsService.php";

Template::header("Post Feed"); 
//PAGE TO SHOW ALL POSTS OF ALL USERS WITHOUT ADMIN ACCESS. NO ACCESS TO MODIFY THEM THOUGH.
?>
<h3>Here are all the posts made by our users!</h3>
<div class="item-grid">

    <?php foreach ($this->model as $post) : ?>

        <article class="item">
            <div>
                <b><?= $post->content?></b> <br>
            </div>

        </article>

    <?php endforeach; ?>

</div>

<?php Template::footer(); ?>
<?php
require_once __DIR__ . "/../Template.php";

Template::header("Home");
?>

<h1>Welcome home!</h1>

<p>
    Welcome to our social media app! 
</p>

<p>
Go to POSTS to see everyone's posts.
</p>

<p>
    Go to MEMES to generate a new meme.
</p>

<p>
    Go to LOG IN to Sign in.
</p>
<?php Template::footer(); ?>
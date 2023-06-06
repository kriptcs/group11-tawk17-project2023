<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Meme Generator");
?>

<h1>Welcome to the meme generator!</h1>
<p> Generate a Drake Hotline Bling meme! <br> Just write the text for the upper part (Drake disagreeing) and the bottom part (Drake agreeing)

<form action="" method="get">
    <input type="text" name="text0" placeholder="Upper Text"> <br>
     <input type="text" name="text1" placeholder="Bottom Text"> <br> <br>
    <input type="submit" value="Generate!" class="btn">
</form>
      
<img src="https://i.imgflip.com/<?= $this->model ?>">


<?php Template::footer(); ?>
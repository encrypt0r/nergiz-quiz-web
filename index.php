<?php require("includes/helper.php"); ?>
<?php RenderPart("header", array("title" => "Home | Nergi Quiz")); ?>

<div class="row">
    <div class="col-md-7 col-sm-12"> <?php require("leaderboard.php"); ?> </div>
    <div class="col-md-1 col-sm-12"></div>
    <div class="col-md-4 col-sm-12"> <?php require("about.php"); ?> </div>
</div> 
<?php RenderPart("footer"); ?>
<?php require("includes/helper.php"); ?>
<?php RenderPart("header", array("title" => "Home | Nergi Quiz")); ?>

<div class="page-header">
    <h1>Leaderboard</h1>
</div>

<p class="lead">
    Here are our top 10 participants.
</p>
<?php GetTopTen() ?>

<?php RenderPart("footer"); ?>
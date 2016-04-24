<?php require("includes/helper.php"); ?>
<?php RenderPart("header", array("title" => "Overview | Nergi Quiz")); ?>

<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="page-header">
            <h2>Leaderboard</h2>
        </div>
        <?php RenderLeaderboard(10); ?>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="page-header">
            <h2>Latest Participants</h2>
        </div>
        <?php RenderLatest(10); ?>
    </div>
        
</div> 
<?php RenderPart("footer"); ?>
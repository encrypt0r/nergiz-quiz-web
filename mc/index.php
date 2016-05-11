<?php require("../includes/helper.php") ?>
<?php RenderPart("header", array("title" => "Mission Control | Nergi Quiz")); ?>
<h1>Mission Control</h1>
<div class="row">

    <div class="col-sm-5">
        <?php require("insert.php") ?>
    </div>
        <div class="col-sm-2">
    </div>
    <div class="col-sm-5">
        <?php require("remove.php") ?>
    </div>
</div>
<div class="row">
    <?php require("all.php") ?>
</div>
<?php RenderPart("footer"); ?>
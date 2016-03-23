<?php require("../includes/helper.php") ?>
<?php RenderPart("header", array("title" => "Home | Nergi Quiz")); ?>
<h1>Mission Control</h1>
<div class="row">
    <div class="col-sm-6">
        <?php require("insert.php") ?>
    </div>
    <div class="col-sm-6">
        <?php require("remove.php") ?>
    </div>
</div>
<div class="row">
    <?php require("all.php") ?>
</div>
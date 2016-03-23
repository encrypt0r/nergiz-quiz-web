<!DOCTYPE html>
<?php require("includes/config.php"); ?>
<?php require("includes/helper.php"); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Nergiz Quiz Website">
    <meta name="author" content="Muhammad Yaseen">
    <link rel="icon" href="../favicon.ico">

    <title><?= htmlspecialchars($title) ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?= $siteURL ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?= $siteURL ?>/assets/css/custom.css" rel="stylesheet" type="text/css">
    <link href="<?= $siteURL ?>/assets/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
       <!-- Begin page content -->
       <?php RenderLeaderboard(10); ?>
  </body>
</html>
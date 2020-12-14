<?php
require_once 'config.inc.php';
require_once 'asg2-db-classes.inc.php';
require_once 'asg2-helpers.inc.php';



session_start();
var_dump($_SESSION['list']);

foreach ($_SESSION['list'] as $fav) {
    return $fav;
}

foreach ($paintings as $row) {
    if ($fav == $row['PaintingID']) {
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="CSS/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php'; ?>
    <main id="favorites">
        <h2>Favorite Paintings</h2>
        <div class=container>
            <!-- the following images are just to test CSS HOWEVER keep class=box for the paintings-->
            <div class=box><img src="images/bruh.png" class=m></div>
            <div class=box><img src="images/bruh.png" class=m></div>
            <div class=box><img src="images/bruh.png" class=m></div>
            <div class=box><img src="images/bruh.png" class=m></div>
            <div class=box><img src="images/bruh.png" class=m></div>
            <div class=box><img src="images/bruh.png" class=m></div>
        </div>
    </main>
    <script src='js/header.js'></script>
</body>

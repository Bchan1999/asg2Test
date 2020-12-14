<?php
require_once 'config.inc.php';
require_once 'asg2-db-classes.inc.php';
require_once 'asg2-helpers.inc.php';

session_start();
if (empty($_SESSION['list'])) {

    $_SESSION['list'] = array();
}

array_push($_SESSION['list'], $_GET['id']);

var_dump($_SESSION['list']);

try {
    $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
    $paintingGateway = new PaintingDB($conn);
    $paintings = $paintingGateway->getSinglePainting($_GET['id']);
} catch (Exception $e) {
    die($e->getMessage());
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link href="CSS/style.css" rel="stylesheet">
    <script src="js/script.js"></script>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <main id="singlepaint">

        <div id="single-display">

            <form action="" method="POST">
                <input type="submit" name="submitbutton" value="Added To Favourites" />
            </form>
            <?php
            getImage($paintings);
            ?>
            <h1>Added to favourites</h1>
        </div>

    </main>

</body>

</html>

<?php
require_once 'config.inc.php';
require_once 'asg2-db-classes.inc.php';
require_once 'asg2-helpers.inc.php';




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
            <?php
            getImage($paintings);
            ?>

            <form action="" method="POST">
                <input type="submit" name="submitbutton" value="Add To Favourites" />
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                header("Location: http://localhost/asg2/redirect.php?id=" . $_GET['id']);
            }

            ?>
        </div>
        <div id="single-info">
            <h2 id="paintingTitle">
                <?php
                printHeaders($paintings);
                ?>
            </h2>

            <!-- in JS change the visiblity of the description, details, and colors button when the user clicks -->
            <div id="descToggle">Description</div>
            <div id="detailToggle">Details</div>
            <div id="colorsToggle">Colors</div>
            <div id="paint-info">
                <section id=description>
                    <?php
                    printDesc($paintings);
                    ?>
                </section>
                <section id=details>
                    <?php
                    printDetails($paintings);
                    ?>
                </section>
                <section id=colors>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <span></span>
                    <span></span>
                    <span></span>
                </section>
            </div>
        </div>
    </main>

</body>

</html>

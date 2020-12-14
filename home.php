<?php
require_once 'config.inc.php';
require_once 'asg2-db-classes.inc.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="CSS/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <main id="loggedin">
        <div id="info">
            <!-- User info -->
            <h2>User Info</h2>
            <?php
            if (isset($_SESSION["CustomerID"])) {
                try {
                    $conn = DatabaseHelper::createConnection(array(
                        DBCONNSTRING,
                        DBUSER, DBPASS
                    ));
                    $data = new CustomerDB($conn);
                    $user = $data->getUser($_SESSION["CustomerID"]);
                    foreach ($user as $obj) {
                        echo "<p>User: $obj[FirstName]" . " $obj[LastName]</p>";
                        echo "<p>City: " . "$obj[City]</p>";
                        echo "<p>Country: " . "$obj[Country]</p>";
                    }
                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else {
                echo "<p>Please register an account here</p>";
                echo "<button type='button'>Join</button>";
            }


            ?>
        </div>
        <div id="searchbox">
            <!-- search -->
            <form action=browse-paintings.php method="get">
                <input type="search" id="home-search" name="title" placeholder="Search our Database">
            </form>
        </div>
        <div id="favorite">
            <!-- favorite paintings -->
            <h2>Favorite Paintings</h2>
            <div class=container>
                <?php
                if (isset($_SESSION["CustomerID"])) {
                    try {
                        foreach ($user as $obj) {
                        }
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                }
                ?>
                <!-- the following images are just to test CSS HOWEVER keep class=box for the paintings-->
                <div class=box><img src="images/bruh.png" class=m></div>
                <div class=box><img src="images/bruh.png" class=m></div>
                <div class=box><img src="images/bruh.png" class=m></div>
                <div class=box><img src="images/bruh.png" class=m></div>
                <div class=box><img src="images/bruh.png" class=m></div>
                <div class=box><img src="images/bruh.png" class=m></div>
            </div>
        </div>
        <div id="suggested">
            <!-- suggested paintings user will like -->
            <h2>Painting Suggestions<h2>
                    <div class=container>
                        <?php
                        if (isset($_SESSION["CustomerID"])) {
                            try {


                                $data = new PaintingDB($conn);
                                $paintings = $data->getAllSorted();
                                $i = 1;
                                foreach ($paintings as $painting) {
                                    $ID = $painting['PaintingId'];
                                    echo "<div class=box><a href=single-painting.php?id=$ID><img src=" . "https://res.cloudinary.com/funwebdev/image/upload/w_100/art/paintings/" . "$painting[FullImageFileName] " . "></a></div>";
                                    if ($i++ == 15) {
                                        break;
                                    }
                                }
                            } catch (Exception $e) {
                                die($e->getMessage());
                            }
                        }
                        ?>
                        <div class=box>
                        </div>
                    </div>
    </main>
    <script src='js/header.js'></script>
</body>

</html>
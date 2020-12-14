<?php
require_once 'config.inc.php';


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galleries</title>

    <link href="" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="CSS/style.css" rel="stylesheet">

</head>

<body>
    <?php include 'header.php'; ?>
    <main id="gallery-box">
        <div class="box a">
            <ul id="gallList">

            </ul>
        </div>
        <div class="box b">
            <h2>Gallery Info</h2>
            <label>Gallery Name:</label>
            <span id="galleryName"></span></br>
            <label>Native Name:</label>
            <span id="galleryNative"></span></br>
            <label>City:</label>
            <span id="galleryCity"></span></br>
            <label>Address:</label>
            <span id="galleryAddress"></span></br>
            <label>Country:</label>
            <span id="galleryCountry"></span></br>
            <label>Website:</label>
            <span><a href="" id="galleryWeb"></a></span>
        </div>
        <div class="box c"></div>
        <div class="box d">
            <table id="paintTable">
                <thead>
                    <th></th>
                    <th id="artH">Artist</th>
                    <th id="titleH">Title</th>
                    <th id="yearH">Year</th>
                </thead>
                <tbody id="tab"></tbody>
            </table>
        </div>
        <script src="js/galleries.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfjb-aEbejho-YCxJlAWnGnC4jhMBFECI&callback=initMap" async defer></script>
    </main>
    <script src='js/header.js'></script>
</body>

</html>
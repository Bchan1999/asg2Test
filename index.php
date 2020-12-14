<?php
require_once 'config.inc.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="CSS/style.css" rel="stylesheet">
</head>

<body id="index">
    <img src="images/logo.png" id="index-logo">

    <section id="loginbox">
        <section id="buttons">
            <button type="button" id="login" onclick='location.href="login.php"'>Login</button>
            <button type="button" id="join">Join</button>
        </section>
        <form action=browse-paintings.php method="get">
            <input type="search" id='index-search' name="title" placeholder="Search our Database">
        </form>
    </section>

</body>

</html>
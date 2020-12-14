<?php
session_start();
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
</head>

<body id="index">
    <img src="images/logo.png" id="index-logo">
    <section id="loginbox">
        <p>Login</p>
        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <input type="email" id="email" name="email" placeholder="Username">
            <input type="password" id="password" name="password" placeholder="Password">
            <input type="submit" name="submit" id="submit" value="Submit">
        </form>
        <p>OR</p>
        <div>
            <button type="button" id="signup" onclick='location.href="index.php"'>Sign Up</button>
        </div>
    </section>

    <?php

    try {
        $conn = DatabaseHelper::createConnection(array(
            DBCONNSTRING,
            DBUSER, DBPASS
        ));
        $data = new UserDB($conn);
        if (isset($_POST['submit'])) {
            $user = $data->getUser($_POST['email']);
            foreach ($user as $obj) {
                if (password_verify($_POST['password'], $obj['Pass'])) {
                    $ID = $obj['CustomerID'] + 1;
                    $_SESSION["CustomerID"] = $ID;
                    $_SESSION["Email"] = "$obj[UserName]";
                } else {
                    echo '<script>alert("Invalid Credentials")</script>';
                }
            }
        }

        if (isset($_SESSION["CustomerID"])) {
            header("Location:home.php");
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }


    ?>
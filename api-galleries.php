<?php
require_once 'config.inc.php';
require_once 'asg2-db-classes.inc.php';

header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");

try {
    $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
    $gateway = new GalleryDB($conn);
    if (isCorrectQueryStringInfo("GalleryID"))
        $paintings = $gateway->getGallery($_GET["GalleryID"]);
    else
        $paintings = $gateway->getAll();

    echo json_encode($paintings, JSON_NUMERIC_CHECK);
} catch (Exception $e) {
    die($e->getMessage());
}

function isCorrectQueryStringInfo($param)
{
    if (isset($_GET[$param]) && !empty($_GET[$param])) {
        return true;
    } else {
        return false;
    }
}

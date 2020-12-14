<?php

function printHeaders($paints)
{
    foreach ($paints as $row) {
        echo $row['Title'];
        echo "</h2>";
        echo "<span id=single-gallery>" . $row['FirstName'] . " " . $row['LastName'] . "</span></br>";
        echo "<span id=single-year>" . $row['YearOfWork'] . "</span></br>";
    }
}

function getImage($paints)
{
    foreach ($paints as $row) {
        echo "<img src=" . $row['FullImageFileName'] . ">";
    }
}

function printDesc($paints)
{

    foreach ($paints as $row) {


        echo "<p>" . $row['Excerpt'] . "</p>";
    }
}

function printDetails($paints)
{
    foreach ($paints as $row) {


        echo "<span>Medium: " . $row['Medium'] . " " . "</span></br>";
        echo "<span>Width: " . $row['Width'] . " " . "</span></br>";
        echo "<span>Height: " . $row['Height'] . " " . "</span></br>";
        echo "<span>Copyright Text: " . $row['CopyrightText'] . " " . "</span></br>";
        echo "<span>Wikipedia Link: " . $row['WikiLink'] . " " . "</span></br>";
        echo "<span>Museum Link: " . $row['MuseumLink'] . " " . "</span></br>";
    }
}

<?php
require_once 'config.inc.php';
require_once 'asg2-db-classes.inc.php';
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
    <main id="browse">

        <div id=paint-filter>
            <form action="browse-paintings.php" method="get">
                <section id="filter">
                    <h2>Painting Filter</h2>
                    <label>Title: </label><input type="text" placeholder="Title" name="title"><br>
                    <label>Artist: </label>
                    <select id="artist" name="artist">
                        <option value=>Choose an artist</option>
                        <?php
                        try {
                            $conn = DatabaseHelper::createConnection(array(
                                DBCONNSTRING,
                                DBUSER, DBPASS
                            ));
                            $data = new PaintingDB($conn);
                            $artists = $data->getArtists();
                            foreach ($artists as $artist) {
                                echo "<option value=$artist[LastName]>$artist[LastName]</option>";
                            }
                        } catch (Exception $e) {
                            die($e->getMessage());
                        }

                        ?>
                    </select></br>
                    <label>Gallery: </label>
                    <select id="gallery" name="gallery"></br>
                        <option value=>Choose a gallery</option>
                        <?php
                        try {

                            $data = new GalleryDB($conn);
                            $galleries = $data->gallerySort();
                            foreach ($galleries as $gallery) {
                                echo "<option value='$gallery[GalleryName]'>$gallery[GalleryName]</option>";
                            }
                        } catch (Exception $e) {
                            die($e->getMessage());
                        }

                        ?>
                    </select>
                </section>
                <section id="filter-year">
                    <h3>Year</h3>
                    <input type="radio" name="rb"><label>Before</label>
                    <input type="number" name="before"><br>
                    <input type="radio" name="rb"><label>After</label>
                    <input type="number" name="after"><br>
                    <input type="radio" name="rb"><label>Between</label>
                    <input type="number" name="between-first"><br>
                    <input type="number" name="between-last"><br>
                    <input type="submit" value="Filter" name="filter">
                    <input type="submit" value="Clear" action="browse-paintings.php">
                </section>
            </form>
        </div>
        <div id=paint-display>
            <table id="browse-table">
                <thead>
                    <th></th>
                    <th id="artH">Artist</th>
                    <th id="titleH">Title</th>
                    <th id="yearH">Year</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody id="tab">
                    <?php
                    try {

                        if (isset($_GET['title'])) {
                            $title = $_GET['title'];
                            if (isset($_GET['filter'])) {
                                $filter = array();
                                $creator = $_GET['artist'];
                                $gal = $_GET['gallery'];
                                $before = $_GET['before'];
                                $after = $_GET['after'];
                                $betweenFirst = $_GET['between-first'];
                                $betweenLast = $_GET['between-last'];
                            }
                            if (!empty($title)) {

                                $filter[] = "Title LIKE '%$_GET[title]%'";
                            }
                            if (!empty($creator)) {
                                $filter[] = "LastName='$_GET[artist]'";
                            }
                            if (!empty($gal)) {
                                $filter[] = "GalleryName='$_GET[gallery]'";
                            }
                            if (!empty($before)) {
                                $filter[] = "YearOfWork<'$_GET[before]'";
                            }
                            if (!empty($after)) {
                                $filter[] = "YearOfWork>'$_GET[after]'";
                            }
                            if (!empty($betweenFirst) && !empty($betweenLast)) {
                                $filter[] = "YearOfWork>$betweenFirst AND YearOfWork<$betweenLast";
                            }
                            if (count($filter) > 0) {
                                $sql = " WHERE " . implode(' AND ', $filter);
                                $data = new PaintingDB($conn);
                                $paintings = $data->getSearch($sql);
                            }
                        } else {
                            $data = new PaintingDB($conn);
                            $paintings = $data->getAllSorted();
                        }

                        foreach ($paintings as $painting) {
                            $ID = $painting['PaintingId'];
                            echo "<tr>";
                            echo "<td><img src=" . "https://res.cloudinary.com/funwebdev/image/upload/w_100/art/paintings/" . "$painting[FullImageFileName] " . "class=m></td>";
                            echo "<td>$painting[FirstName] $painting[LastName]</td>";
                            echo "<td class=title><a href=single-painting.php?id=$ID>$painting[Title]</a></td>";
                            echo "<td>$painting[YearOfWork]</td>";
                            echo "<td><img src=images/fav.png class=fav></td>";
                            echo "<td><a href=single-painting.php?id=$ID><img src=images/eye.svg class=view></a></td>";
                            echo "</tr>";
                        }
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src='js/header.js'></script>
</body>
<?php
class DatabaseHelper
{
    public static function createConnection($values = array())
    {
        $connString = $values[0];
        $user = $values[1];
        $password = $values[2];
        $pdo = new PDO($connString, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
    public static function runQuery($connection, $sql, $parameters = array())
    {
        if (!is_array($parameters)) {
            $parameters = array($parameters);
        }

        $statement = null;
        if (count($parameters) > 0) {
            $statement = $connection->prepare($sql);
            $executedOk = $statement->execute($parameters);
            if (!$executedOk) throw new PDOException;
        } else {
            $statement = $connection->query($sql);
            if (!$statement) throw new PDOException;
        }
        return $statement;
    }
}
// class ArtistDB
// {
//     private static $baseSQL = "SELECT * FROM Artists          
//     ORDER BY LastName";

//     public function __construct($connection)
//     {
//         $this->pdo = $connection;
//     }

//     public function getAll()
//     {
//         $sql = self::$baseSQL;
//         $statement =
//             DatabaseHelper::runQuery($this->pdo, $sql, null);
//         return $statement->fetchAll();
//     }
// }

class PaintingDB
{
    private static $baseSQL = "SELECT PaintingId, Paintings.ArtistID, FirstName, LastName, Paintings.GalleryID, GalleryName, CONCAT(ImageFileName,'.jpg') as FullImageFileName , Title, YearOfWork, Excerpt, Medium, Width, Height, CopyrightText, WikiLink, MuseumLink, JsonAnnotations FROM Galleries INNER JOIN (Artists INNER JOIN Paintings ON Artists.ArtistID = Paintings.ArtistID) ON Galleries.GalleryID = Paintings.GalleryID";

    public function __construct($connection)
    {
        $this->pdo = $connection;
    }

    public function getAll()
    {
        $sql = self::$baseSQL;
        $statement =
            DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
    public function getAllSorted()
    {
        $sql = self::$baseSQL . " ORDER BY Title";
        $statement =
            DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
    public function getAllPaintingsFromGallery($galleryID)
    {
        $sql = self::$baseSQL . " WHERE Galleries.GalleryID=?";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array($galleryID)
        );
        return $statement->fetchAll();
    }
    public function getSinglePainting($paintingID)
    {

        $sql = self::$baseSQL . " WHERE PaintingID=?";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array($paintingID)
        );
        return $statement->fetchAll();
    }
    public function getArtists()
    {

        $sql = self::$baseSQL . " GROUP BY LastName ORDER BY LastName";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array()
        );
        return $statement->fetchAll();
    }
    public function getSearch($params)
    {
        $sql = "";
        $sql = self::$baseSQL . $params;
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array()
        );
        return $statement->fetchAll();
    }
}

class GalleryDB
{
    private static $baseSQL = "SELECT * FROM Galleries";

    public function __construct($connection)
    {
        $this->pdo = $connection;
    }
    public function getAll()
    {
        $sql = self::$baseSQL;
        $statement =
            DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
    public function getGallery($galleryID)
    {
        $sql = self::$baseSQL . " WHERE GalleryID=?";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array($galleryID)
        );
        return $statement->fetchAll();
    }
    public function gallerySort()
    {
        $sql = self::$baseSQL . " ORDER BY GalleryName";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array()
        );
        return $statement->fetchAll();
    }
}

class UserDB
{
    private static $baseSQL = "SELECT * FROM customerlogon";

    public function __construct($connection)
    {
        $this->pdo = $connection;
    }
    public function getAll()
    {
        $sql = self::$baseSQL;
        $statement =
            DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
    public function getUser($CustomerID)
    {
        $sql = self::$baseSQL . " WHERE customerlogon.UserName=?";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array($CustomerID)
        );
        return $statement->fetchAll();
    }
}

class CustomerDB
{
    private static $baseSQL = "SELECT * FROM customers";

    public function __construct($connection)
    {
        $this->pdo = $connection;
    }
    public function getAll()
    {
        $sql = self::$baseSQL;
        $statement =
            DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
    public function getUser($CustomerID)
    {
        $sql = self::$baseSQL . " WHERE customers.CustomerID=?";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array($CustomerID)
        );
        return $statement->fetchAll();
    }
}

<?php
class db
{
    private static $conn;
    private static $PDO;
    public static $err = false;
    function __construct()
    {
        try {
            self::$PDO = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS);
            self::$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            self::$err = true;
        }
    }

    public static function get_instance()
    {
        if (!isset(self::$conn)) {
            self::$conn = new db();
        }
        return self::$conn;
    }
    public function read(string $query, array $data = [], bool $returnResults = false, bool $rowCount = true)
    {
        /**
         * Read Function
         * 
         * @param string $query -> is the query string that we use to search
         * 
         * @param array  $data  -> Data we want to pass
         * 
         * @return array #result-> Fetched Data or rowCount
         */
        $results = [];
        try {
            $stmt = self::$PDO->prepare($query);
            $stmt->execute($data);

            if ($returnResults)
                $results[] = $stmt->fetchAll();

            if ($rowCount)
                $results[] = $stmt->rowCount();
        } catch (Exception $e) {
            echo "Please Import The Database File To Your Server";
            die;
        }
        return $results;
    }
    public function write(string $query, array $data = [])
    {
        /**
         * Write Function is used to modify columns or add data to our tables
         * 
         * @param string $query -> is the query string that we use to search
         * 
         * @param Array  $data  -> Data we want to pass
         */
        try {
            $stmt = self::$PDO->prepare($query);
            $stmt->execute($data);
        } catch (Exception $e) {
            echo "Please Import Database File Into Your Server";
        }
    }
}
$db = db::get_instance();

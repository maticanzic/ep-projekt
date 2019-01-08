<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'demo');
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>

<?php 

class DBInit {

    private static $host = "localhost";
    private static $user = "root";
    private static $password = "ep";
    private static $schema = "articlestore";
    private static $instance = null;

    private function __construct() {
        
    }

    private function __clone() {
        
    }

    /**
     * Returns a PDO instance -- a connection to the database.
     * The singleton instance assures that there is only one connection active
     * at once (within the scope of one HTTP request)
     * 
     * @return PDO instance 
     */
    public static function getInstance() {
        if (!self::$instance) {
            $config = "mysql:host=" . self::$host
                    . ";dbname=" . self::$schema;
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            );

            self::$instance = new PDO($config, self::$user, self::$password, $options);
        }

        return self::$instance;
    }

}
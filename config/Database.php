// config/Database.php
<?php
class Database {
    private static $instance = null;
    private static $config = [
        'host' => 'localhost',
        'dbname' => 'daily_planner',
        'username' => 'root',
        'password' => ''
    ];
    
    public static function getInstance() {
        if (self::$instance === null) {
            try {
                $dsn = "mysql:host=" . self::$config['host'] . 
                       ";dbname=" . self::$config['dbname'];
                self::$instance = new PDO(
                    $dsn,
                    self::$config['username'],
                    self::$config['password'],
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
?>
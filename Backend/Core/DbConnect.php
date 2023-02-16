<?php
namespace App\Core;

use Dotenv\Dotenv;

Dotenv::createImmutable(__DIR__ . '/')->load();

class DbConnect{

    private $host;
    private $dbname;
    private $password;
    private $username;

    public function __construct(){
        $this->host = $_ENV['HOST'];
        $this->dbname = $_ENV['DBNAME'];
        $this->password = $_ENV['PASSWORD'];
        $this->username = $_ENV['USERNAME'];
    }


    /**
     * return PDO object for connection to db
     */
    protected function connect(){

        $bdd = new \PDO("mysql:host=$this->host;dbname=$this->dbname", "$this->username", "$this->password");
        $bdd->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC);  

        return $bdd;

    }


}

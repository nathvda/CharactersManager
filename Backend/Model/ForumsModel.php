<?php
namespace App\Model;

use App\Core\DbConnect;

class ForumsModel extends DbConnect{

    public function getForums(){

    $sql = "SELECT * FROM forums";

    $stmt = $this->connect()->prepare($sql);

    $stmt->execute();

    $res = $stmt->fetchAll();

    return $res;
    
    }

}

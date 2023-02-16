<?php
namespace App\Model;

use App\Core\DbConnect;

class GendersModel extends DbConnect{

    public function getGenders(){

        $sql = "SELECT * FROM genders";

        $stmt = $this->connect()->prepare($sql);
        
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;

    }

}

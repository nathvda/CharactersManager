<?php
namespace App\Model;

use App\Core\DbConnect;

class ThreadsModel extends DbConnect{

    public function getThreads(){

        $sql = "SELECT *, CONCAT(personnages.nom,' ',personnages.prenom) AS char_name, threads.id AS topic_id FROM threads INNER JOIN personnages ON threads.personnage_id = personnages.id ORDER BY created_at DESC";
        
        $stmt = $this->connect()->prepare($sql);
        
        $stmt->execute();

        $res = $stmt->fetchAll();

        return $res;
    }

    public function addThreads($title, $url, $character, $started){
        
        $sql = "INSERT INTO threads (title,url,personnage_id, started_at, created_at) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP())";
        
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$title,$url,$character, $started]);

    }

    public function updateDate($id, $status){

        $sql = "UPDATE threads SET updated_at = CURRENT_TIMESTAMP(), todo = ? WHERE threads.id = ?";

        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$status, $id]);

    }


}

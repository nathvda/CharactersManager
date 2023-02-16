<?php
namespace App\Model;

use App\Core\DbConnect;

class CharactersModel extends DbConnect{

    public function getCharacters(){

        $sql = "SELECT *, personnages.*, personnages.id AS character_id FROM personnages INNER JOIN genders ON personnages.gender_id = genders.id INNER JOIN forums ON personnages.forum_id = forums.id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    public function getCharacterOfChoice($id){

        $sql = "SELECT *, personnages.*, personnages.id AS character_id FROM personnages INNER JOIN genders ON personnages.gender_id = genders.id INNER JOIN forums ON personnages.forum_id = forums.id WHERE personnages.id = ?";

        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$id]);

        $result = $stmt->fetchAll();

        return $result;
    }

    public function addCharacter($nom,$prenom,$age,$gender,$forum){

        $sql = "INSERT INTO personnages (nom, prenom, age, gender_id, forum_id) VALUES (?,?,?,?,?)";

        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$nom,$prenom,$age,$gender,$forum]);

    }


}
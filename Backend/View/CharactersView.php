<?php
namespace App\View;

use App\Model\CharactersModel;

class CharactersView extends CharactersModel{

    public function createCharacter($json){

        (new CharactersModel)->addCharacter($json["nom"],$json["prenom"],intval($json["age"]),intval($json["gender"]),intval($json["forum"]));

    }

}
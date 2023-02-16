<?php
namespace App\Controller;

use App\Model\CharactersModel;

class CharacterController extends CharactersModel{

    public function fetchCharacters(){

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        $res = (new CharactersModel)->getCharacters();

        if (count($res) > 0){
        
        http_response_code(200);

        echo json_encode($res);

        } else { 

        http_response_code(404);

        echo json_encode(
            array("message" => "No company found")
        );
        }
        

    }

    public function fetchCharacterOfChoice($id){

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        $res = (new CharactersModel)->getCharacterOfChoice($id);

        if (count($res) > 0){
        
        http_response_code(200);

        echo json_encode($res);

        } else { 

        http_response_code(404);

        echo json_encode(
            array("message" => "No company found")
        );
        }
        

    }

}
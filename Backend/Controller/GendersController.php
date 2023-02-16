<?php
namespace App\Controller;

use App\Model\GendersModel;

class GendersController extends GendersModel{

    public function getGendersAll(){

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json; charset=UTF-8');

        $res = (new GendersModel)->getGenders();

        if (count($res) > 0){

            http_response_code(200);
            echo json_encode($res);

        } else { 

            http_response_code(404);
            echo json_encode(array("message" => "no Gender found"));

        }


    }

}

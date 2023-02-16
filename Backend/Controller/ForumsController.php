<?php
namespace App\Controller;

use App\Model\ForumsModel;

class ForumsController extends ForumsModel{

    public function getAllForums(){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json; charset=UTF-8');

        $res = (new ForumsModel)->getForums();

        if (count($res) > 0){

            http_response_code(200);

            echo json_encode($res);

        } else { 

            http_response_code(404);

            echo json_encode(array("message" => "no forum found"));
        }
    }


}

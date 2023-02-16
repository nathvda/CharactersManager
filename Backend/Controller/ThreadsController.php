<?php
namespace App\Controller;

use App\Model\ThreadsModel;

class ThreadsController extends ThreadsModel{

    public function getAllThreads(){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json; charset=UTF-8');

        $res = (new ThreadsModel)->getThreads();

        if (count($res) > 0 ){

            http_response_code(200);

            echo json_encode($res);

        } else {
            
            http_response_code(404);

            echo json_encode(
                array("message" => "no thread found")
            );

        }

    }
}
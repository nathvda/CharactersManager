<?php
namespace App\View;

use App\Model\ThreadsModel;

class ThreadView extends ThreadsModel{

    public function createThread($json){

        (new ThreadsModel())->addThreads($json['title'],$json['url'],intval($json['personnage_id']), $json['started']);
    }
}
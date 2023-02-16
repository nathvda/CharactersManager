<?php
namespace App\Validators;

use App\View\ThreadView;

class ThreadValidator{

    private $data;
    private static $fields = ['title', 'url', 'personnage_id'];
    private $errors = [];

    public function __construct($form_data){
        $this->data = $form_data;
    }

    public function validateThread(){
        foreach(self::$fields as $field){
            if(!array_key_exists($field, $this->data)){
                trigger_error("$field doesn't exist in data");
                return;
            }
        }

        $this->validateTitle($this->data['title'],'title');
        $this->validateTitle($this->data['url'],'url');
        $this->validateNumberInput($this->data['personnage_id'],'muse name');

        if(count($this->errors) == 0 ){
            (new ThreadView)->createThread($this->data);
        }

        return $this->errors;

    }

    private function validateTitle($datafield, $errorname){
        $val = trim($datafield);
        $val = htmlspecialchars($val);
        $val = stripslashes($val);

        if(empty($val)){
            $this->add_error("$errorname", "$errorname cannot be empty");
        } else {
            if(!preg_match('/^.{1,255}$/',$val)){
                $this->add_error("$errorname", "$errorname must be from 1 to 255 chars");
            } else {
                $this->data[$errorname] = $val;
            }
        }
    }

    private function validateNumberInput($datafield, $errorname){
        $val = trim($datafield);
        $val = htmlspecialchars($val);
        $val = stripslashes($val);

        if(empty($val)){
            $this->add_error("$errorname", "$errorname cannot be empty");
        } else {
            if(!preg_match('/^\d{1,3}$/',$val)){
                $this->add_error("$errorname", "$errorname must be a number from 1 to 999");
            } else {
                $this->data[$errorname] = $val;
            }
        }
    }

    private function add_error($key,$value){
        $this->errors[$key] = $value;
    }

}
<?php
namespace App\Validators;

use App\View\CharactersView;

class CharacterValidator {

    private $data;
    private static $fields = ['nom','prenom','age','gender','forum'];
    private $errors = [];

    public function __construct($form_data){
        $this->data = $form_data;
    }

    public function validateCharacter(){
        foreach(self::$fields as $field){
            if(!array_key_exists($field, $this->data)){
                trigger_error("$field isn't present in data");
                return;
            }
        }

        $this->validateNames($this->data['nom'],'nom');
        $this->validateNames($this->data['prenom'],'prenom');
        $this->validateNumberInput($this->data['age'],'age');
        $this->validateNumberInput($this->data['gender'],'gender');
        $this->validateNumberInput($this->data['forum'],'forum');

        if(count($this->errors) == 0){
            (new CharactersView)->createCharacter($this->data);
        }

        return $this->errors;

    }

    private function validateNames($datafield, $errorname){
        $val = trim($datafield);
        $val = htmlspecialchars($val);
        $val = stripslashes($val);

        if(empty($val)){
            $this->add_error("$errorname", "$errorname cannot be empty");
        } else {
            if(!preg_match('/^[\sa-zA-ZÀ-ù-]{1,255}$/',$val)){
                $this->add_error("$errorname", "$errorname must be from 1 to 255 chars and alphabetic");
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

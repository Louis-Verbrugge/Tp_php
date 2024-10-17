<?php

class ValidatorInput {

    public function checkText($input) {
 
        return strlen($input) === 0;

    }

    public function checkPassword($input) {
        
        return !(strlen($input) > 8);       
    }

}

?>
<?php 

class Fighter {

    private $name;

    public function __construct($name){
            $this->name = $name;
    }
    public function get_name(){
        return $this->name;
    }
}

?>
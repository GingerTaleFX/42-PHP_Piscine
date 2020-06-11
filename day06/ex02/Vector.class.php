<?php

class Vector {
    private $x;
    private $y;
    private $z;
    private $w = 1;
    static $verbose = false;

    public function __construct($vector){
        if (isset($vector['dest']) && $vector['dest'] instanceof Vertex){
            if (isset($vector['orig']) && $vector['orig'] instanceof Vertex){
                $orig = new Vertex(array('x' => $vector['orig'] -> get_x(), 'y' => $vector['orig'] -> get_y(), 'z' => $vector['orig'] -> get_z()));
            } else {
                $orig = new Vertex(array('x' => 0, 'y' => 0, 'z' => 0));
            }
            $this->_x = $vector['dest']->get_x() - $orig->get_x();
            $this->_y = $vector['dest']->get_y() - $orig->get_y();
            $this->_z = $vector['dest']->get_z() - $orig->get_z();
            $this->_w = 0;
        }
        if (Self::$verbose){
            printf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w);
        }
    }

    public function get_x(){
        return $this->_x;
    }

    public function get_y(){
        return $this->_x;
    }

    public function get_z(){
        return $this->_z;
    }

    public function get_w(){
        return $this->_w;
    }

    public function magnitude() {
        $new_x = $this->_x * $this->_x;
        $new_y = $this->_y * $this->_y;
        $new_z = $this->_z * $this->_z;
        return ((float)sqrt($new_x + $new_y + $new_z));
    }

    public function normalize(){
        $length = $this->magnitude();
        if ($length == 1){
            $b = $this;
            return $b;
        }
        $new_x = $this->_x / $length;
        $new_y = $this->_y / $length;
        $new_z = $this->_z / $length;
        return(new Vector(array('dest' => new Vertex(array('x' => $new_x, 'y' => $new_y, 'z' => $new_z)))));
    }

    public function add(Vector $rhs){
        $new_x = $this->_x + $rhs->_x;
        $new_y = $this->_y + $rhs->_y;
        $new_z = $this->_z + $rhs->_z;

        return new Vector(array('dest' => new Vertex(array('x' => $new_x, 'y' => $new_y, 'z' => $new_z))));
    }

    public function sub(Vector $rhs){
        $new_x = $this->_x - $rhs->_x;
        $new_y = $this->_y - $rhs->_y;
        $new_z = $this->_z - $rhs->_z;

        return new Vector(array('dest' => new Vertex(array('x' => $new_x, 'y' => $new_y, 'z' => $new_z))));
    }

    public function opposite(){
        $new_x = $this->_x * (-1);
        $new_y = $this->_y * (-1);
        $new_z = $this->_z * (-1);

        return new Vector(array('dest' => new Vertex(array('x' => $new_x, 'y' => $new_y, 'z' => $new_z))));
    }

    public function scalarProduct($k){
        $new_x = $this->_x * $k;
        $new_y = $this->_y * $k;
        $new_z = $this->_z * $k;

        return new Vector(array('dest' => new Vertex(array('x' => $new_x, 'y' => $new_y, 'z' => $new_z))));

    }

    public function  dotProduct(Vector $rhs){
        $new_x = $this->_x * $rhs->_x;
        $new_y = $this->_y * $rhs->_y;
        $new_z = $this->_z * $rhs->_z;

        return((float)($new_x + $new_y + $new_z));
    }

    public function cos(Vector $rhs) {
        $a = ($this->_x * $rhs->_x) + ($this->_y * $rhs->_y) + ($this->_z * $rhs->_z);
        $b = ($this->_x * $this->_x) + ($this->_y * $this->_y) + ($this->_z * $this->_z);
        $c = ($rhs->_x * $rhs->_x) + ($rhs->_y * $rhs->_y) + ($rhs->_z * $rhs->_z);
        $sqrt = sqrt($b * $c);
        return((float)($a / $sqrt));

    }

    public function crossProduct(Vector $rhs){

        $new_x = $this->_y * $rhs->get_z() - $this->_z * $rhs->get_y();
        $new_y = $this->_z * $rhs->get_x() - $this->_x * $rhs->get_z();
        $new_z = $this->_x * $rhs->get_y() - $this->_y * $rhs->get_x();

        return(new Vector(array('dest' => new Vertex(array('x' => $new_x, 'y' => $new_y, 'z' => $new_z)))));
    }

    function __toString(){
        return(vsprintf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f ).\n", array($this->_x, $this->_y, $this->_z, $this->_w)));
    }

    function __destruct(){
        if(Self::$verbose){
            printf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f ) destructed.\n", $this->_x, $this->_y, $this->_z, $this->_w);
 
        }
    }

    public static function doc(){
        $read = fopen("Vector.doc.txt", "r");
        While ($read && !feof($read)){
            $ret = fgets($read);
            echo $ret . "\n";
        }
    }
}

?>
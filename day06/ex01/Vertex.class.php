<?php
class Vertex {

    private $x;
    private $y;
    private $z;
    private $w = 1;
    private $color;
    static $verbose = false;

    public function __construct($vertex){
        $this->_x = $vertex['x'];
        $this->_y = $vertex['y'];
        $this->_z = $vertex['z'];
        if (isset($vertex['w']) && !(empty($vertex['w']))) {
            $this->_w = $vertex['w'];
        }
        else {
            $this->_w = 1.0;
        }
        if (isset($vertex['color']) && !(empty($vertex['color']) && ($vertex['color'] instanceof Color))){
            $this->_color = $vertex['color'];
        } else {
            $this->_color = new Color(array('red' => 255, 'green' => 255, 'blue' => 255));
        }
        if(Self::$verbose){
            printf("Vertex( x: %0.2f, y: %0.2f, z: %0.2f, w: %0.2f, Color( red: %3d, green: %3d, blue: %3d ) ) constructed.\n", $this->_x, $this->_y, $this->z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
        }

    }

    function __destruct()
    {
        if (Self::$verbose)
            printf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, Color( red: %3d, green: %3d, blue: %3d ) ) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
    }


    function __toString()
    {
        if (Self::$verbose)
            return (vsprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, Color( red: %3d, green: %3d, blue: %3d ) )", array($this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue)));
        return (vsprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f )", array($this->_x, $this->_y, $this->_z, $this->_w)));
    }

    public function get_x(){
        return $this->_x;
    }
    
    public function set_x($x) {
        $this->_x = $x;
    }

    public function get_y(){
        return $this->_y;
    }

    public function set_y($y){
        $this->_y = $y;
    }

    public function get_z(){
        return $this->_z;
    }

    public function set_z($z){
        $this->_z = $z;
    }

    public function get_w(){
        return $this->_w;
    }

    public function set_w($w){
        $this->_w = $w;
    }

    public function get_color(){
        return $this->_color;
    }

    public function set_color($color){
        $this->_color = $color;
    }

    public function doc() {
        $read = fopen("Vertex.doc.txt", "r");
        while ($read && !(feof($read))){
            $ret = fgets($read);
            echo $ret . "\n";
        }
    }
}
?>
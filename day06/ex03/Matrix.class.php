<?php

class Matrix {
    const IDENTITY = "IDENTITY";
    const SCALE = "SCALE";
    const RX = "OX rotation";
    const RY = "OY rotation";
    const RZ = "OZ rotation";
    const TRANSLATION = "TRANSLATION";
    const PROJECTION = "PROJECTION";

    protected $_matrix = array();
    private $_preset;
    private $_scale; 
    private $_angle;
    private $_vtc;
    private $_fov;
    private $_ratio;
    private $_near;
    private $_far;

    static $verbose = false;

    public function __construct($array = null)
    {
        if (isset($array)) {
            if (isset($array['preset']))
                $this->_preset = $array['preset'];
            if (isset($array['scale']))
                $this->_scale = $array['scale'];
            if (isset($array['angle']))
                $this->_angle = $array['angle'];
            if (isset($array['vtc']))
                $this->_vtc = $array['vtc'];
            if (isset($array['fov']))
                $this->_fov = $array['fov'];
            if (isset($array['ratio']))
                $this->_ratio = $array['ratio'];
            if (isset($array['near']))
                $this->_near = $array['near'];
            if (isset($array['far']))
                $this->_far = $array['far'];
            // $this->checker();
            $this->createMatrix();
            if (Self::$verbose) {
                if ($this->_preset == Self::IDENTITY)
                    echo "Matrix " . $this->_preset . " instance constructed\n";
                else
                    echo "Matrix " . $this->_preset . " preset instance constructed\n";
            }
            $this->visualOps();
        }
    }

    // private function checker(){
    //     if(empty($this->_preset))
    //         return "error";
    //     if ($this->_preset == Self::SCALE && empty($this->_scale)){
    //         echo "ERROR\n";
    //         exit();
    //     }
    //     if (($this->_preset == Self::RX || $this->_preset == Self::RY || $this->_preset == Self::RZ) && empty($this->_angle)){
    //         echo "ERROR\n";
    //         exit();
    //     }
    //     if ($this->_preset == Self::TRANSLATION && empty($this->_vtc)){
    //         echo "ERROR\n";
    //         exit();
    //     }
    //     if ($this->_preset == Self::PROJECTION &&(empty($this->_fov) || empty($this->_ratio) || empty($this->_near) || empty($this->_far))){
    //         echo "ERROR\n";
    //         exit();
    //     }
    // }

    private function visualOps(){
        switch ($this->_preset) {
            case (self::IDENTITY) :
                $this->identity(1);
                break;
            case (self::TRANSLATION) :
                $this->translation();
                break;
            case (self::SCALE) :
                $this->identity($this->_scale);
                break;
            case (self::RX) :
                $this->rotation_x();
                break;
            case (self::RY) :
                $this->rotation_y();
                break;
            case (self::RZ) :
                $this->rotation_z();
                break;
            case (self::PROJECTION) :
                $this->projection();
                break;
        }
    }

    private function identity($scale){
        $this->_matrix[0] = $scale;
            $this->_matrix[5] = $scale;
            $this->_matrix[10] = $scale;
            $this->_matrix[15] = 1;
    }

    private function translation(){
        $this->identity(1);
        $this->_matrix[3] = $this->_vtc->get_x();
        $this->_matrix[7] = $this->_vtc->get_y();
        $this->_matrix[11] = $this->_vtc->get_z();
    }

    private function rotation_x(){
        $this->identity(1);
        $this->_matrix[5] = cos($this->_angle);
        $this->_matrix[6] = -sin($this->_angle);
        $this->_matrix[9] = sin($this->_angle);
        $this->_matrix[10] = cos($this->_angle);
    }

    private function rotation_y(){
        $this->identity(1);
        $this->_matrix[0] = cos($this->_angle);
        $this->_matrix[2] = sin($this->_angle);
        $this->_matrix[8] = -sin($this->_angle);
        $this->_matrix[10] = cos($this->_angle);
    }

    private function rotation_z(){
        $this->identity(1);
        $this->_matrix[0] = cos($this->_angle);
        $this->_matrix[1] = -sin($this->_angle);
        $this->_matrix[4] = sin($this->_angle);
        $this->_matrix[5] = cos($this->_angle);
    }

    private function projection(){
        $range = tan(deg2rad($this->_fov) / 2) * $this->_near;
        $this->_matrix[0] = (2 * $this->_near) / ($range * $this->_ratio + $range * $this->_ratio);
        $this->_matrix[5] = $this->_near / $range;
        $this->_matrix[10] = -($this->_far + $this->_near) / ($this->_far - $this->_near);
        $this->_matrix[11] = -(2 * $this->_far * $this->_near) / ($this->_far - $this->_near);
        $this->_matrix[14] = - 1;
    }

    private function createMatrix(){
        $i = 0;
        while ($i < 16){
            $this->_matrix[$i] = 0;
            $i++;
        }
    }

    public function mult( Matrix $rhs ){
        $tmp = array();
        $i = 0;
        $j = 0;
        while ($i < 16)
        {
            while ($j < 4)
            {
                $tmp[$i + $j] = 0;
                $tmp[$i + $j] += $this->_matrix[$i + 0] * $rhs->_matrix[$j + 0];
                $tmp[$i + $j] += $this->_matrix[$i + 1] * $rhs->_matrix[$j + 4];
                $tmp[$i + $j] += $this->_matrix[$i + 2] * $rhs->_matrix[$j + 8];
                $tmp[$i + $j] += $this->_matrix[$i + 3] * $rhs->_matrix[$j + 12];
                $j++;
            }
            $j = 0;
            $i+= 4;
        }
        $newMatrix = new Matrix();
        $newMatrix->_matrix = $tmp;
        return $newMatrix;
    }

    public function transformVertex( Vertex $vtx ){
        $tmp = array();
        $new_x = $vtx->get_x();
        $new_y = $vtx->get_y();
        $new_z = $vtx->get_z();
        $new_w = $vtx->get_w();

        $tmp['x'] = ($new_x * $this->_matrix[0]) + ($new_y * $this->_matrix[1]) + ($new_z * $this->_matrix[2]) + ($new_w * $this->_matrix[3]); 
        $tmp['y'] = ($new_x * $this->_matrix[4]) + ($new_y * $this->_matrix[5]) + ($new_z * $this->_matrix[6]) + ($new_w * $this->_matrix[7]);
        $tmp['z'] = ($new_x * $this->_matrix[8]) + ($new_y * $this->_matrix[9]) + ($new_z * $this->_matrix[10]) + ($new_w * $this->_matrix[11]);
        $tmp['w'] = ($new_x * $this->_matrix[12]) + ($new_y * $this->_matrix[13]) + ($new_z * $this->_matrix[14]) + ($new_w * $this->_matrix[15]);
        $tmp['color'] = $vtx->get_color();
        $vertex = new Vertex($tmp);
        return $vertex;
    }

    function __toString() {
        $line = "M | vtcX | vtcY | vtcZ | vtxO\n";
        $line .= "-----------------------------\n";
        $line .= "x | %0.2f | %0.2f | %0.2f | %0.2f\n";
        $line .= "y | %0.2f | %0.2f | %0.2f | %0.2f\n";
        $line .= "z | %0.2f | %0.2f | %0.2f | %0.2f\n";
        $line .= "w | %0.2f | %0.2f | %0.2f | %0.2f";
        return (vsprintf($line, array($this->_matrix[0], $this->_matrix[1], $this->_matrix[2], $this->_matrix[3], $this->_matrix[4],
                        $this->_matrix[5], $this->_matrix[6], $this->_matrix[7], $this->_matrix[8], $this->_matrix[9], $this->_matrix[10],
                        $this->_matrix[11], $this->_matrix[12], $this->_matrix[13], $this->_matrix[14], $this->_matrix[15])));
    }

    function __destruct() {
        if(Self::$verbose)
        printf("Matrix instance destructed\n");
    }

    public static function doc() {
        $read = fopen("Matrix.doc.txt", "r");
        while($read && !feof($read)){
            $ret = fgets($read);
            echo $ret . "\n";
        }
    }
}

?>
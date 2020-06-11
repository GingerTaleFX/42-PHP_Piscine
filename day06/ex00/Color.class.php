<?php
    class Color {
        public $red;
        public $green;
        public $blue;
        static $verbose = false;

        public function __construct($color){
            if (isset($color['red']) && isset($color['green']) && isset($color['blue'])){
                $this->red = intval($color['red']);
                $this->green = intval($color['green']);
                $this->blue = intval($color['blue']);
            } else if (isset($color['rgb'])){
                $rgb = intval($color['rgb']);
                $this->red = ($rgb >> 16) & 0xFF;
                $this->green = ($rgb >> 8) & 0xFF;
                $this->blue = $rgb & 0xFF;

            }
            if (self::$verbose){
                printf("Color(red: %3d, green: %3d, blue: %3d) contructed.\n", $this->red, $this->green, $this->blue);

            }
        }

        function __toString()
        {
            return (vsprintf("Color( red: %3d, green: %3d, blue: %3d )\n", array($this->red, $this->green, $this->blue)));
        }

        public function add($color) {
            $red = $this->red + $color->red;
            $green = $this->green + $color->green;
            $blue = $this->blue + $color->blue;

            return(new Color(array('red' => $red, 'green' => $green, 'blue' => $blue)));
        }

        public function sub($color) {
            $red = $this->red - $color->red;
            $green = $this->green - $color->green;
            $blue = $this->blue - $color->blue;

            return(new Color(array('red' => $red, 'green' => $green, 'blue' => $blue)));
        }

        public function mult($mult) {

            $red = $this->red * $mult;
            $green = $this->green * $mult;
            $blue = $this->blue * $mult;

            return(new Color(array('red' => $red, 'green' => $green, 'blue' => $blue)));
        }

        function __destruct()
        {
            if (Self::$verbose)
                printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n", $this->red, $this->green, $this->blue . PHP_EOL);
        }

        public static function doc() {
            $read = fopen("Color.doc.txt", "r");
            while (!feof($read) && $read){
                $ret = fgets($read);
                echo $ret . "\n";
            }
        }
    }   
?>
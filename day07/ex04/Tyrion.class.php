<?php
    class Tyrion {
        public function sleepWith($value){
            if($value instanceof Jaime){
                print ("Not even if I'm drunk !" . PHP_EOL);
            }
            else if ($value instanceof Sansa){
                print ("Let's do this." .PHP_EOL);
            } else if ($value instanceof Cersei) {
                print ("Not even if I'm drunk !" . PHP_EOL);
            }
        }
    }

?>
<?php 
class Jaime {
    public function sleepWith($value){
        if ($value instanceof Tyrion){
            print ("Not even if I'm drunk !" . PHP_EOL);
        }
        else if ($value instanceof Sansa) {
            print("Let's do this." . PHP_EOL);
        }
        else if ($value instanceof Cersei) {
            print("With pleasure, but only in a tower in Winterfell, then." . PHP_EOL);
        }
    }
}

?>
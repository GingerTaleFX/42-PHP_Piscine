<?php 

class NightsWatch implements IFighter {
    private $troop = array();

    public function recruit($soldier){
        $this->troop[] = $soldier;
    }

    function fight(){
        foreach($this->troop as $soldier){
            if (method_exists(get_class($soldier), 'fight'))
                $soldier->fight();
        }
    }
}

?>
<?php

class UnholyFactory {

    private $troop = array();
    private $f_name;

    public function absorb($fighter)
    {
        if (get_parent_class($fighter))
        {
            $f_name = $fighter->get_name();
            if (isset($this->troop[$f_name])){
                print("(Factory already absorbed a fighter of type " . $f_name . ")" . PHP_EOL);
            } else {
                print("(Factory absorbed a fighter of type " . $f_name . ")" . PHP_EOL);
                $this->troop[$f_name] = $fighter;
            }
        } else {
            print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
        }
    }

    public function fabricate($fighter)
    {
        if (array_key_exists($fighter, $this->troop))
        {
            print("(Factory fabricates a fighter of type " . $fighter . ")" . PHP_EOL);
            return clone $this->troop[$fighter];
        }
        print("(Factory hasn't absorbed any fighter of type " . $fighter . ")" . PHP_EOL);
        return null;

    }
}
    
?>
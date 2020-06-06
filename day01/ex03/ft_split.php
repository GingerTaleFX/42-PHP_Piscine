<?php
    function ft_split($str){
        $ready = array_filter(explode(' ', $str));
        sort($ready);
        return $ready;
    }
?>
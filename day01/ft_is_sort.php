<?php
function ft_is_sort($array){
    $sort_array = $array;
    sort($sort_array);
    if (array_diff_assoc($sort_array, $array) == null)
        return true;
    else
        return false;
}
?>

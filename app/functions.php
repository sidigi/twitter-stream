<?php
function recursive($array, $needle = 'media', &$arr = [])
{
    foreach($array as $key => $value){
        if(isset($value[$needle]) && $value[$needle]){
            foreach ($value[$needle] as $item){
                $arr[$item['id']] = $item;
            }

        }elseif(is_array($value)){
            recursive($value, $needle, $arr);
        }
    }
}

function find_in_arr_recursive(array $arr, string $key) {
    $result = [];

    if(isset($arr[$key]) && $arr[$key]){
        foreach ($arr[$key] as $item){
            $result[$item['id']] = $item;
        }
    }

    if(is_array( $arr)) {
        foreach( $arr as $i => $el) {
            if(is_array( $el)) {
                $result += find_in_arr_recursive($el, $key);
            }
        }
    }

    return $result;
}
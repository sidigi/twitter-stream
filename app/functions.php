<?php
declare(strict_types = 1);

function find_in_arr_recursive(array $arr, string $key) {
    $result = [];

    if(isset($arr['extended_entities'][$key]) && $arr['extended_entities'][$key]){
        $result += find_in_arr_recursive($arr['extended_entities'], $key);
    }

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
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
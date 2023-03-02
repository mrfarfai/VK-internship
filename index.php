<?php
$input = explode(" ", readline());
$n = $input[0];
$m = $input[1];
$arr = array(array()[$m])[$n];
$arr_result = array(array()[$m])[$n];
$result = PHP_INT_MAX;


for($i = 0; $i < $n; $i++) {
    $j = 0;
    foreach (explode(" ", readline()) as $key => $value){
        $arr[$i][$j] = (int) $value;
        $arr_result[$i][$j] = -1;
        $j++;
    }
}

$input = explode(" ", readline("Точка старта: "));
$x_start = $input[0] - 1;
$y_start = $input[1] - 1;

$input = explode(" ", readline("Точка стопа: "));
$x_stop = $input[0] - 1;
$y_stop = $input[1] - 1;


function rec($i, $j, $arr_result) {
    global $n, $m, $arr, $result, $x_stop, $y_stop;
    if(($i < $n || $i > -1) && ($j < $m || $j > -1) && $arr[$i][$j] > 0 && $arr_result[$i][$j] == -1) {
        $min = PHP_INT_MAX;
        if($i + 1 < $n && $arr_result[$i + 1][$j] != -1) {
            $min = min($min, $arr_result[$i + 1][$j]);
        }

        if($i - 1 > -1 && $arr_result[$i - 1][$j] != -1) {
            $min = min($min, $arr_result[$i - 1][$j]);
        }

        if($j - 1 > -1 && $arr_result[$i][$j - 1] != -1) {
            $min = min($min, $arr_result[$i][$j - 1]);
        }

        if($j + 1 < $m && $arr_result[$i][$j + 1] != -1) {
            $min = min($min, $arr_result[$i][$j + 1]);
        }

        if($min == PHP_INT_MAX) $min = 0;

        $arr_result[$i][$j] = $min + $arr[$i][$j];
        if($i == $x_stop && $j == $y_stop) $result = min($arr_result[$i][$j], $result);
        rec($i + 1, $j, $arr_result);
        rec($i - 1, $j, $arr_result);
        rec($i, $j - 1, $arr_result);
        rec($i, $j + 1, $arr_result);
    }
}

rec($x_start, $y_start, $arr_result);
echo "Количество ходов быстрого пути: ". $result;

?>



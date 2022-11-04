<?php

for ($i = 1; $i <= 100; $i++) {
    $primeNumb = array();
    echo "$i [";
    for ($j = $i; $j > 1; $j--) {
        if ($i % $j == 0) {
            array_push($primeNumb, $j);
        }
    }

    if (sizeof($primeNumb) > 1) {
        for ($j = 0; $j < sizeof($primeNumb); $j++) {
            echo $primeNumb[$j];
            if ($j < sizeof($primeNumb) - 1) {
                echo ',';
            }
        }
        echo '] <br>';
    } else {
        echo "PRIME] <br>";
    }
}

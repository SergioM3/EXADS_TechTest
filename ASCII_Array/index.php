<?php 
    // Populate ASCII array from ',' to '|' 
    $ascii_arr = array();
    for($i=44;$i<=124;$i++){
        array_push($ascii_arr,chr($i));
    }
    // Randomize array - Shuffle
    shuffle($ascii_arr);

    // Randomly remove one character
    $randNum = rand(0,80);
    array_splice($ascii_arr,$randNum,1);

    // Print Missing character
    echo 'Missing character from array is: <br><b style="color:red;font-size:3em">'.MissingChar($ascii_arr).'</b><br>';

    // Function to find missing character
    function MissingChar($arr){
        // Loops through all "known" characters and when first missing is found then returns it
        for($i=44;$i<=124;$i++){
            if(!in_array(chr($i),$arr))
                return chr($i);
        }
    }

?>
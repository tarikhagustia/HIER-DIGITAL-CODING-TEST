<?php

function find_duplicate(string $string){
    $returnValue = [];
    for($i = 0; $i < strlen($string); $i++) {  
        $count = 1;  
        for($j = $i+1; $j < strlen($string); $j++) {  
            if($string[$i] == $string[$j] && $string[$i] != ' ') {  
                $count++;  
                $string[$j] = '0';  
            }  
        }  
        if($count > 1 && $string[$i] != '0'){  
            $returnValue[] = $string[$i];  
        }  
    }
    return $returnValue;  
}
print_r(find_duplicate("ABCA")[0]);
echo PHP_EOL;
print_r(find_duplicate("ABCDEBE")[0]);
echo PHP_EOL;
// Mestinya yang return A Bukan B, karena A awal
print_r(find_duplicate("ABBA")[0]);

?>  
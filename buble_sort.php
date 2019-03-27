<?php
// https://en.wikipedia.org/wiki/Bubble_sort
function b_sort($arr )
{
	do{
		$is_wpd = false;
		for( $i = 0, $c = count( $arr ) - 1; $i < $c; $i++ )
		{
			if( $arr[$i] > $arr[$i + 1] )
			{
				list( $arr[$i + 1], $arr[$i] ) =
						array( $arr[$i], $arr[$i + 1] );
				$is_wpd = true;
			}
		}
	}
	while( $is_wpd );
    return $arr;
}

$t = array(6,7,23,8,1,6,8);
echo "Original :\n";
print_r($t);
echo "Sorted :";
print_r(b_sort($t)). PHP_EOL;
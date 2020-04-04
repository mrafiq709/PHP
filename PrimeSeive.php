<?php
	
	$arr = new SplFixedArray(1001);
	$prime = [];

	function seive($N, &$arr, &$prime){
		$k = sqrt($N);
		for ($i=3; $i<=$k; $i+=2) { 
			if ($arr[$i] == 0) {
				for ($j=$i*$i; $j<=$N; $j+=2*$i) { 
					$arr[$j] = 1;
				}
			}
		}
		$arr[1] = 1;

		for ($i=4; $i<=$N ; $i+=2) { 
			$arr[$i] = 1;
		}

		array_push($prime, 2);

		for ($i=3; $i<=$N ; $i+=2) { 
			if ($arr[$i]==0) {
				array_push($prime, $i);
			}
		}
	}

	seive(1000, $arr, $prime);

	for ($i=0; $i < count($prime) ; $i++) { 
		echo $prime[$i] . '<br/>';
	}

?>
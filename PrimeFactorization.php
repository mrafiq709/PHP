<?php

	require_once('PrimeSeive.php');

	$N = 100;
	seive($N, $arr, $prime);

	function primeFactor($N, &$prime, &$koyta){
		$k = count($prime);
		for ($i=0; $i<$k && $N!=1; $i++) { 
			if($N % $prime[$i] == 0){
				$j = 0;
				while ($N % $prime[$i] == 0) {
					$j++;
					$N = $N/$prime[$i];
				}

				$koyta[$i] = $j;
			}
		}
		if ($N != 1) {
			$koyta[$N] = 1;
		}
	}

	$koyta = new SplFixedArray(101);

	primeFactor(15, $prime, $koyta);

	//print_r($koyta);
	//exit;

	for ($i=0; $i < sizeof($koyta); $i++) { 
		if (isset($koyta[$i])) {

			echo $prime[$i] . "^" . $koyta[$i] . ' x ';
		}
	}

?>
<?php

	// PHP program to find smallest window  
	// containing all characters of a pattern.  
	define('no_of_chars', 256);
	// Function to find smallest window  
	// containing all characters of 'pattern' 
	function minWindowSubstring(&$str, &$pattern)
	{
		$len_str = strlen($str);
		$len_pattern = strlen($pattern);

	    // check if string's length is less  
	    // than pattern's length. If yes 
	    // then no such window can exist 
		if ($len_str < $len_pattern) {
			echo "No such substring exists";
			return "";
		}

		$hash_pattern = array_fill(0, no_of_chars, 0);
		$hash_str = array_fill(0, no_of_chars, 0);

	    // store occurrence ofs characters 
	    // of pattern  
	    for ($i = 0; $i < $len_pattern; $i++)
	        $hash_pattern[ord($pattern[$i])]++;  
	  
	    $start = 0; 
	    $start_index = -1; 
	    $min_len = PHP_INT_MAX; 

	    // start traversing the string  
	    $count = 0; // count of characters  
	    for ($j = 0; $j < $len_str ; $j++)  
	    {  
	        // count occurrence of characters 
	        // of string  
	        $hash_str[ord($str[$j])]++;  
	  
	        // If string's char matches with  
	        // pattern's char then increment count  
	        if ($hash_pattern[ord($str[$j])] != 0 &&  
	            $hash_str[ord($str[$j])] <= 
	            $hash_pattern[ord($str[$j])])  
	            $count++;  
	  
	        // if all the characters are matched  
	        if ($count == $len_pattern)  
	        {  
	            // Try to minimize the window i.e.,  
	            // check if any character is occurring  
	            // more no. of times than its occurrence  
	            // in pattern, if yes then remove it from 
	            // starting and also remove the useless  
	            // characters.  
	            while ($hash_str[ord($str[$start])] >  
	                   $hash_pattern[ord($str[$start])] ||  
	                   $hash_pattern[ord($str[$start])] == 0)  
	            {  
	  
	                if ($hash_str[ord($str[$start])] > 
	                    $hash_pattern[ord($str[$start])])  
	                    $hash_str[ord($str[$start])]--;  
	                $start++;  
	            }  
	  
	            // update window size  
	            $len_window = $j - $start + 1;  
	            if ($min_len > $len_window)  
	            {  
	                $min_len = $len_window;  
	                $start_index = $start;  
	            }  
	        }  
	    }  
	  
	    // If no window found  
	    if ($start_index == -1)  
	    {  
	        echo "No such window exists";  
	        return "";  
	    }  
	  
	    // Return substring starting from  
	    // start_index and length min_len  
	    return substr($str, $start_index, $min_len);
	}

	// Driver code  
	$str = "this is a test string";  
	$pattern = "tist";  
	  
	echo "Smallest window is : " . minWindowSubstring($str, $pattern); 

?>
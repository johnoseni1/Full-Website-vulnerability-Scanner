<?php


//Commonly used functions

//Check if a string contains a substring
function contains($substring, $string) 
{
    $pos = strpos($string, $substring);
 
    if($pos === false) 
	{
         return false;
    }
    else 
	{
        return true;
    }
}

//Find domain and directory(if any) of site being tested
//e.g. convert http://127.0.0.1/testsitewithvulns/search.php to 
//http://127.0.0.1/testsitewithvulns/, or convert 
//http://example.com/search.php to http://example.com/
function getSiteBeingTested($urlToScan)
{
	$countSlashes = 0;
	$lastIndexOfSlash = 0;
	$lastIndexOfDot = 0;
	$siteBeingTested = $urlToScan;
	for($i=0; $i<strlen($siteBeingTested); $i++)
	{
		if($siteBeingTested[$i] == '/')
		{
			$lastIndexOfSlash = $i;
			$countSlashes++;
		}
		if($siteBeingTested[$i] == '.')
		{
			$lastIndexOfDot = $i;
		}
	}
	if(($lastIndexOfDot < $lastIndexOfSlash) && (substr($siteBeingTested, -1) != '/'))
		$siteBeingTested .= '/';
	else if($countSlashes > 2)
		$siteBeingTested = substr($siteBeingTested, 0 , $lastIndexOfSlash+1);

	return $siteBeingTested;
}

?>
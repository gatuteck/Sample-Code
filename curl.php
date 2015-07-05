<?php
# Author: Shailender Singh
# Blog Url : gatuteck.blogspot.in
# Stack overflow,twitter,facebook etc  Profile name : gatuteck
$url="https://mobile.twitter.com/session/new ";
//Delay in calling the URL
define('MinDelayTime', 2);
define('MaxDelayTime', 8);

function LogMessage($message)
{	
	$log_file = "log.txt";	
    $file = fopen($log_file, 'a');
    $to_save = date(DATE_COOKIE) . ' -- ' . getmypid() . ' -- ' . $message . "\r\n";
    if (flock($file, LOCK_EX)) {
        fputs($file, $to_save);
    } else {
        echo 'Cant save log...';
    }

    echo $to_save . "\r\n";
    fclose($file);
}
// Defining the basic cURL function
function Get_Curl($url) {
    //Random sleep or delay in call of page to avoid risk of blocking of IP address
    sleep(rand(MinDelayTime, MaxDelayTime));
    LogMessage("URL requested : ".$url);

    $ch = curl_init();  // Initialising cURL
    curl_setopt($ch, CURLOPT_URL, $url);    // Setting cURL's URL option with the $url variable passed into the function
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, True); // Setting cURL's option to return the webpage data
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, True);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
    if(curl_errno($ch)){
        echo 'Curl error: ' . curl_error($ch);
    }
    curl_close($ch);    // Closing cURL
    return $data;   // Returning html content of site
}
?>

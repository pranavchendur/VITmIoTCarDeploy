<?php

if ($_GET["slot"]==1) {
	$fh = fopen("state.txt", "w") or die("Something went wrong!"); // Opens up the .txt file for writing and replaces any previous content
	$stringToWrite = $_GET["state"]; // Write either 1 or 0 depending on request from index.html
	fwrite($fh, $stringToWrite); // Writes it to the .txt file
	fclose($fh); 
}
if ($_GET["slot"]==2) {
	$fh = fopen("state2.txt", "w") or die("Something went wrong!"); // Opens up the .txt file for writing and replaces any previous content
	$stringToWrite = $_GET["state"]; // Write either 1 or 0 depending on request from index.html
	fwrite($fh, $stringToWrite); // Writes it to the .txt file
	fclose($fh); 
}
if ($_GET["slot"]==3) {
	$fh = fopen("state3.txt", "w") or die("Something went wrong!"); // Opens up the .txt file for writing and replaces any previous content
	$stringToWrite = $_GET["state"]; // Write either 1 or 0 depending on request from index.html
	fwrite($fh, $stringToWrite); // Writes it to the .txt file
	fclose($fh); 
}

//Azure Table Post
if ($_GET["state"]=="404") $po = "Free"; else $po = "Parked";

/** Using http_build_query() to build parameters */
$data =array('slot'=>$_GET["slot"],'value'=>$po);
    
$url = "http://iotmcare.azure-mobile.net/tables/datastore"; 
$page = "/tables/datastore"; 
$headers = array( 
    "POST ".$page." HTTP/1.0", 
    "Cache-Control: no-cache", 
    "X-ZUMO-APPLICATION : DIxyzBoGouxqPaojoTezZFWtiVsdxF24"
); 

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL,$url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_TIMEOUT, 5); 
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 

// Apply the XML to our curl call 
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 

$datac = curl_exec($ch); 

if (curl_errno($ch)) { 
    print "Error: " . curl_error($ch); 
} else { 
    // Show me the result 
    var_dump($datac); 
    curl_close($ch); 
} 

?>
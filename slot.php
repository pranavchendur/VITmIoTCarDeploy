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

if ($_GET["state"]=="404") $po = "Free"; else $po = "Parked";

/** Using http_build_query() to build parameters */
$data_array =array('slot'=>$_GET["slot"],'value'=>$po);
$data = http_build_query($data_array);

$head_array =array('slot'=>'X-ZUMO-APPLICATION','DIxyzBoGouxqPaojoTezZFWtiVsdxF24'=>$po);
$head = http_build_query($head_array);
 
/** Now call the p2.php in HTTP POST by using function do_post_request */
echo do_post_request('https://iotmcare.azure-mobile.net/tables/datastore', $data, $head);
 
function do_post_request($url, $data, $optional_headers = null)
{
     $params = array('http' => array(
                  'method' => 'POST',
                  'content' => $data
               ));
     if ($optional_headers !== null) {
        $params['http']['header'] = $optional_headers;
     }
     $ctx = stream_context_create($params);
     $fp = @fopen($url, 'rb', false, $ctx);
     if (!$fp) {
        throw new Exception("Problem with $url, $php_errormsg");
     }
     $response = @stream_get_contents($fp);
     if ($response === false) {
        throw new Exception("Problem reading data from $url, $php_errormsg");
     }
     return $response;
}

?>
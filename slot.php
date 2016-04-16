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

?>
<?php
function OpenCon()
 {
	 $dbhost = "localhost";
	  
	 $dbuser = "complete here"; /* user and pass should be read from file "pass.txt" */
	 $dbpass = "complete here"; /* "pass.txt" is in gitignore so - no include on git */ 

	 $db = "leads";
	 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 	 return $conn;
 }
 
function CloseCon($conn)
 {
 	$conn -> close();
 }
   
?>
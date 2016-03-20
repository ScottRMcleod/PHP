<?php

//This function creates a standard html page dynamicaly on your webserver
function CreateHTML5_Page()
{
		//setup the file location on the server and assigns a file type 
		//if you want a html extention all you have to do is change the .filetype e.g. .txt, .html , .csv, .doc
		$myFile = "myPage/index.php";
		
		//creates the file header variable called fh calls the fopen function
		//passes is both the name of the file and calls the write switch
		
		$fh = fopen($myFile, 'w') or die("can't open file");
		
		//string data has been assigned the value of your required document
		$stringData = "
		<!doctype html>
		<html>
		<head>
		<meta charset=\"utf-8\">
		<title>Untitled Document</title>
		<link rel=\"stylesheet\" href=\"style.css\">
		</head>

		<body>
		</body>
		</html>
		";
		
		//calls the file write function passing in the file header and the stringData variable
		fwrite($fh, $stringData);
		//calls the file close function closing the connection to the file header
		fclose($fh);
}
?>

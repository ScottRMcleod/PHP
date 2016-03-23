<?php
//establishing connection to Database
 function openDB()
 {
			global $conn, $username,$host,$password,$db;
				$host = "localhost";
				$username ="exampleUsername";
				$password= "examplePassword";
				$db = "exampleDB";
					$conn = mysql_connect($host, $username,$password) or die(mysql_error());
		mysql_select_db($db,$conn) or die(mysql_error());
		}
		 function closeDB()
		{
			global $conn;
			mysql_close($conn);
		}
		function emailChecker($email)
		{
			global $conn, $check_result;
			$check = "select * from autho_users where subscribe = $subscribe";
			$check_result = mysql_query($check,$conn)or die(mysql_error());
		}
// format MySQL DATETIME value into a more readable string
function formatDate($val)
{
	$arr = explode('-', $val);
	return date('d M Y', mktime(0,0,0, $arr[1], $arr[2], $arr[0]));
}
			?>

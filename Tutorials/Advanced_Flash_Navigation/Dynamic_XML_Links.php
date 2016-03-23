//This Script Creates an XML list for items to be populated to a flash document

<?php
include("Admin/includes/config.php");
openDB();

$result = mysql_query("select * from page_links where id between 1 and 10 and Link_id between 1 and 10");
// select all data from the products table.

//now we are going to write this data into xml for flash.

echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
// In PHP you can use front slash to skip inverted commas. e.g. \"...\" 

//Enter file contents here

echo("<NAVBAR>\n");

while($rows=mysql_fetch_array($result))
{
	echo("<BUTTON NAME='".$rows['link_title']."'LINK='".$rows['link_page']."'TARGET='main'/>\n");
}


echo("</NAVBAR>");
?>

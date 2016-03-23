
<link rel="stylesheet" type="text/css" href="../styles/styles2.css">
<script src="js/three.min.js"></script>
<script src="js/TrackballControls.js"></script>
<?
/*
	||***************************************************************************||
	||*		Script Author: Scott Mcleod			    	    *||
	||*									    *||
	||*		Contact Details:				    	    *||
	||*									    *||
	||*		Email: scott.mcleod@smcleodtech.com.au			    *||
	||*		Phone: +61 408392896				    	    *||
	||*		WebSite: www.smcleodtech.com.au			    	    *||
	||*									    *||
	||*		version 1.0					    	    *||
	||*									    *||
	||***************************************************************************||
	||***************************************************************************||
	||*		  Script Purpose: Controller Script	    	    	    *||
	||*									    *||
	||*             Requirements:						    *||
	||*									    *||
	||*	  	1. Handel Connection calls to DB 		    	    *||
	||*		2. Manages User Authentication / Profile Creation   	    *||
	||*		3. Manage Shopping site elements                            *||
	||*		4. Manage Front and backend of CMS                  	    *||
	||*									    *||
	||***************************************************************************||
*/

/* 
	Function Designed to establish a connection to MySql Database passing 
	Database Username Password server name as well as databasename 
	
*/
function openDB()
 {
	global $conn, $username,$host,$password,$db;
	$host = "********";
	$username ="*********";
	$password= "********";
	$db = "*********";
	$conn = mysql_connect($host, $username,$password) or die(mysql_error());
	mysql_select_db($db,$conn) or die(mysql_error());
}  
// This function gets the IP address of a users machine this IP address will then be placed in our database to ensure that once a client has 
function getIp() 
{
   //get the Ipaddresss for the connected machine
   $ip = $_SERVER['REMOTE_ADDR'];
   
   //checkes to see if there vaule is not empty
   if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
   {
	//returns the Ipaddress of the client machine calling the page
        $ip = $_SERVER['HTTP_CLIENT_IP'];
   } 
   //checks to see if the client machine is not empty the forwards this address to http address
   elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
   {
       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
   }
   //returns the IP address of the client machine accessing this site
   return $ip;
}
function cart()
{
	//establishes connection to the database
	openDB();
	//checks to see if an item has been added to the cart
	
	if(isset($_GET['add_cart']))
	{
		//gets the IP address of the client machine
		$ip = getIp();
		//gets the ID of the item listed on the page 
		$pro_id = $_GET['add_cart'];
		
		//selects all items from the cart and check to see if the ip address of the client machine has been already listed
		//and adds the product ID to the list of item in the cart
		$check_pro="select * from shopping_cart where ip_add='$ip' and pro_id='$pro_id'";
		
		//creates the query to ther database passing in the check_pro varible
		$result = mysql_query($check_pro);
		
		//validates that the query has been successfull completed and ensures that the result is greater then 0
		if(mysql_num_rows($result)>0)
		{
			//echo's noting to the screen
			echo"";	
		}
		//inserts the item to the cart table passing in the product ID as well as the IP address of the client asking for this product
		
		else 
		{
			$insert_pro = "insert into shopping_cart(p_id,ip_add) values('$pro_id','$ip')";
			$run_pro = mysql_query($insert_pro);
			echo"<script>window.open('http://www.smcleodtech.com.au/index.php','_self')</script>";
		}
	}
	// terminates connection to the database
	closeDB();
}

//this fuction has been created to calculate all the items in the cart to present to the customer in the index page
function total_items()
{
	openDB();
	if(isset($_GET['add_cart']))
	{
		
		$ip = getIp();
		$get_items="select * from shopping_cart where ip_add='$ip'";
		$result = mysql_query($get_items);
		$count_items = mysql_num_rows($result);
	}
	else
	{
		$ip = getIp();
		$get_items="select * from shopping_cart where ip_add='$ip'";
		$result = mysql_query($get_items);
		$count_items = mysql_num_rows($result);
	}
	echo"$count_items";
	
	// call back to close DB 
	closeDB();
}
//this function has been created to calculate the total of the carts contence and then pressent this information to the customer
function total_price()
{
	$total = 0;
	$ip = getIp();
	openDB();
	$select_price="select * from shopping_cart where ip_add='$ip'";
	$total_price = mysql_query($select_price);
		
	while($p_price=mysql_fetch_array($total_price))
	{
		$pro_id = $p_price['p_id'];
		$pro_price = "select * from products where product_id='$pro_id'";
		$run_pro_price = mysql_query($pro_price);
		
		while($pp_price=mysql_fetch_array($run_pro_price))
		{
			$pro_price = array($pp_price['product_price']);
			$vaules = array_sum($pro_price);
			$total += $vaules;
		}
	}
	closeDB();
	echo $total;
}
function adminLogin()
{
	
}
/* 
	Function Designed to display server details in the admin_index 
	
*/ 
function ServerDetails()
{
	echo"<div id='ServerDetails'>";
	echo "<h3>Server Details</h3><br>";
 	echo "Current PHP version: " . phpversion() ."<br>";
 	echo "Current Operating System:". php_uname();
 	echo "<br>IP Address of Server: ".getHostByName($_SERVER['HTTP_HOST'] )."<br>";
	echo $_SERVER['SERVER_SOFTWARE'];
	echo"<br>Home Directory:<br>";
	echo $_SERVER['DOCUMENT_ROOT'];
	echo"<br><br>";
	echo $_SERVER['SERVER_NAME'];
	echo"<br><br>";
	echo"</div>";
	colourTable();
}
/* 
	Function Designed to close connection to MySql Database passing 
	Database Username Password server name as well as databasename 
	
*/ 
function closeDB()
{
	global $conn;
	mysql_close($conn);
}
//Displasy the top Navigation to websitre
function topNav()
{
	echo "<div id='topBanner'><a href='http://www.smcleodtech.com.au'>
	<img src='../Images/SMcleodTechnologiesLogo.png' width='188' height='86'/></a>
	<div id='form' style='float:right; postion:absolute;'>
        <form method='get' action='v2/results.php' enctype='multipart/form-data'>
	<br><br><br><input type='text' name='user_query' value='Search Products'>
        <input type='submit' name='search' value='Search'></form><br>";
	echo"</div>";
	
	//refere to styles/styles2.css file location http://www.smcleodtech.com.au/styles/styles2.css line 39 to 395
	
	echo"<div id='c1menu'>";
   	mainNav();
   	echo"</div>";
   	echo"<font color='#3FC86C' style='float:right;'>Items in cart :";
   	total_items();
   	echo" Total Price: $";
   	total_price();
   	echo"</font>";
   
}
//creates a second menu for adminportal
function adminTopNav()
{
	echo "
	<div id='topBanner'>
	<a href ='http://www.smcleodtech.com.au'><img src='../Images/SMcleodTechnologiesLogo.png' width='188' height='86'/></a>
	<div id='form' style='float:right; postion:absolute;'>
        <form method='get' action='v2/results.php' enctype='multipart/form-data'>
	<br><br><br>
        <input type='text' name='user_query' value='Search Products'>
        <input type='submit' name='search' value='Search'>
        </form>
        </div>
	</div>";
	admintopNavMenu();
}
function admintopNavMenu()
{
	echo"<div id='AdminNav'>";
	openDB();	
	$result = mysql_query("select * from admin_nav_table");
	echo"<ul>";
	while($rows=mysql_fetch_array($result))
	{	
		$mainNav_id = $rows['main_nav_id'];
		$mainNave_title = $rows['main_nav_title'];
		echo"<li><a href=".$rows['main_nav_link'].">".$rows['main_nav_title']."</a></li>";
	}
	echo"</ul>
	</div>";
	closeDB();
}
// This function builds the main site dropdownMenu which can be updated from the main_nav_table and drop_down_menu_table1
function mainNav() 
{
	//creates connection to the database
	openDB();	
	$result = mysql_query("select * from main_nav_table");
	echo"<ul>";
	//first pass through the main nave table to collect all feilds in table
	while($rows=mysql_fetch_array($result))
	{	
		$mainNav_id = $rows['main_nav_id'];
		$mainNave_title = $rows['main_nav_title'];
		$main_item_type = $rows['main_item_type'];
		
		//allocates li objects in page to the active class see ../styles/styles2.css
		echo"<li class='active'>";
		// first nested If Statement to select all the fields of main_nav_table 
		//with a value of dropDownMenu as Y and checks to  
		if($rows['dropDownMenu'] == "Y" && $rows['main_item_type']  != "Service")
		{
			echo"<li class='active'>
			<a href=".$rows['main_nav_link'].">".$rows['main_nav_title']."</a><ul>";
			$result2 = mysql_query("select * from drop_down_menu_table1 where menu_item_type ='Product'");
			
			while($rows2=mysql_fetch_array($result2))
			{
				$subNav_id = $rows2['dropNode1_id'];
				$subNave_title = $rows2['dropNode1_title'];
				echo"<li><a href=".$rows2['dropNode1_link'].">
				".$rows2['dropNode1_title']."</a></li>";
			}
			
			echo"</ul>";
		}
		if ($rows['dropDownMenu'] == "Y" && $rows['main_item_type']  == "Service")
		{ 
			echo"<li class='active'>
			<a href=".$rows['main_nav_link'].">".$rows['main_nav_title']."</a><ul>";
			$result3 = mysql_query("select * from drop_down_menu_table2 where menu_item_type ='Service'");
			
			while($rows2=mysql_fetch_array($result3))
			{
				$subNav_id = $rows2['dropNode2_id'];
				$subNave_title = $rows2['dropNode2_title'];
				echo"<li><a href=".$rows2['dropNode2_link'].">
				".$rows2['dropNode2_title']."</a></li>";
			}
			
			echo"</ul>";
		}
		if($rows['dropDownMenu'] == "N")
		{
			echo"
			<li><a href=".$rows['main_nav_link'].">".$rows['main_nav_title']."</a></li>";
		}
	}
	echo"</ul>";
	closeDB();
}
function getHomePage()
{
	echo"";
}
function footer()
{
	echo"<div id='footer'>
	<h4 style='color:white'><a href='http://smcleodtech.com.au/pages/contact.php'><font style='color:white'>
	Contact Us</font></a></h4>
        <font style='color:white'>Address:<br> 
        4 The Grove, Wyoming, NSW 2250 <br>
        P: (04) 08392 896 <br>
        E: <a href='mailto:admin@smcleodtech.com.au'>admin@smcleodtech.com.au</font></a></p><br>
        <a rel='nofollow external' title='Facebook' href='http://facebook.com/SmcleodTechnologies' target='_blank'>Facebook</a> 
	<a rel='nofollow external' title='Linkedin'  style='text-decoration:none'href='http://linkedin.com/company/smcleod-technologies' target='_blank'>Linkedin</a>
	</div>";
}
function getCats()
{
	openDB();	
	$result = mysql_query("select * from categories");
	
	while($rows=mysql_fetch_array($result))
	{	
		$cat_id = $rows['cat_id'];
		$cat_title = $rows['cat_title'];
		echo"<li><a href='index.php?cat=$cat_id'>".$rows['cat_title']."</a></li>";
	}
	closeDB();
}
function getBrands()
{
	openDB();	
	$result = mysql_query("select * from brands");
	while($rows=mysql_fetch_array($result))
	{
		$brand_id = $rows['brand_id'];	
		$brand_title = $rows['brand_title'];
		echo"<li><a href='index.php?brad=$brand_id'>".$rows['brand_title']."</a></li>";
	}
	closeDB();
}
function getModels()
{
	openDB();	
	$result = mysql_query("select * from models");
	while($rows=mysql_fetch_array($result))
	{	
		echo"<li><a href=".$rows['page_link'].">".$rows['model_title']."</a></li>";
	}
	closeDB();
}
function getTemplates()
{
	openDB();
	$result = mysql_query("select * from Templates");
	
	while($rows=mysql_fetch_array($result))
	{	
		echo"<li><a href=".$rows['page_link'].">".$rows['Template_title']."</a></li>";
	}
	closeDB();
}
function getFlashTemplates()
{
	openDB();
	$result = mysql_query("select * from flashTemplates");
	
	while($rows=mysql_fetch_array($result))
	{	
		echo"<li><a href=".$rows['page_link'].">".$rows['flash_title']."</a></li>";
	}
	closeDB();
}
function getSoftwareApps()
{
	openDB();	
	$result = mysql_query("select * from software_apps");
	
	while($rows=mysql_fetch_array($result))
	{	
		echo"<li><a href=".$rows['page_link'].">".$rows['software_title']."</a></li>";
	}
	closeDB();
}
function getTraining()
{
	openDB();	
	$result = mysql_query("select * from training_courses");
	
	while($rows=mysql_fetch_array($result))
	{	
		echo"<li><a href=".$rows['page_link'].">".$rows['course_title']."</a></li>";
	}
	closeDB();
}
function selCat()
{
	openDB();
	$result = mysql_query("select * from categories");
	
	while($rows=mysql_fetch_array($result))
	{	
		echo"<option value=".$rows['cat_id'].">".$rows['cat_title']."</option>";
	}
	closeDB();
}
function selBrand()
{
	openDB();
	$result = mysql_query("select * from brands");
	
	while($rows=mysql_fetch_array($result))
	{	
		echo"<option value=".$rows['brand_id'].">".$rows['brand_title']."</option>";
	}
	closeDB();
}
function getPro()
{
	if(!isset($_GET['cat']))
	{
		if(!isset($_GET['brand']))
		{
			openDB();
			$getPro = mysql_query("select * from products");
			while($row_pro=mysql_fetch_array($getPro))
			{	
				$prod_id = $row_pro['product_id'];$prod_cat = $row_pro['product_cat'];
				$prod_brand = $row_pro['product_brand'];$prod_title = $row_pro['product_title'];
				$prod_price = $row_pro['product_price'];$prod_image = $row_pro['product_image'];
				$pro_desc = $row_pro['product_desc'];
				echo "<div id'single_product'><h3>$prod_title</h3>
				      <a href='images/$prod_image' style='float:left;'>
				      <image src='images/$prod_image' width='180' height='133'></image></a>
				      <h4><strong>$ $prod_price</strong></h4><br><br><br><br><br><br><br>
				      <a href='details2.php?pro_id=$prod_id'>Details</a>
				      <a href='index.php?pro_id=$prod_id' style='float:right;'>
				      <button style='float:right;'>Add to Cart</button></a> 
				      </div>";
			}
			closeDB();
		}
	}
}
function getCatPro()
{
	if(isset($_GET['cat']))
	{
		$cat_id = $_GET['cat'];
		openDB();
		$get_cat_pro = mysql_query("select * from products where product_cat='$cat_id'");
		while($row_cat_pro=mysql_fetch_array($get_cat_pro))
		{	
			$prod_id = $row_cat_pro['product_id'];$prod_cat = $row_cat_pro['product_cat'];
			$prod_brand = $row_cat_pro['product_brand'];$prod_title = $row_cat_pro['product_title'];
			$prod_price = $row_cat_pro['product_price'];$prod_image = $row_cat_pro['product_image'];
			$pro_desc = $row_cat_pro['product_desc'];
			echo "<div id'single_product'>
			<h3>$prod_title</h3>
			<a href='images/$prod_image' style='float:left;'><image src='images/$prod_image' width='180' height='133'></image></a>
			<h4><strong>$ $prod_price</strong></h4><br><br><br><br><br><br><br>
			<a href='details2.php?pro_id=$prod_id'>Details</a>
			<a href='index.php?pro_id=$prod_id' style='float:right;'><button style='float:right;'>Add to Cart</button></a> 
			</div>";
		}
		closeDB();
	}
}
function getPro_details()
{
	openDB();
	if(isset($_GET['pro_id']))
	{
		$prod_id = $_GET['pro_id'];
		$getPro_id = mysql_query("select * from products where prod_id='$prod_id'");
		while($row_pro=mysql_fetch_array($getPro_id))
		{	
			$prod_id = $row_pro['product_id'];
			$prod_title = $row_pro['product_title'];
			$prod_price = $row_pro['product_price'];
			$prod_image = $row_pro['product_image'];
			$pro_desc = $row_pro['product_desc'];
		
			echo "<div id'single_product'>
			<h3>$prod_title</h3>
			<a href='images/$prod_image' style='float:left;'>
			<image src='images/$prod_image' width='400' height='300'></image></a>
			<h4><strong>$ $prod_price</strong></h4>
			<br><br>$pro_desc<br><br><br><br><br>
			<a href='index.php?pro_id=$prod_id'>Go Back</a>
			<a href='index.php?pro_id=$prod_id' style='float:right;'>
			<button style='float:right;'>Add to Cart</button></a> 
			</div>";
		}
	}
	closeDB();
}
function ThreeDModels()
{
	openDB();
	if(isset($_GET['pro_id']))
	{
		$prod_id = $_GET['pro_id'];
		$getPro_id = mysql_query("select * from products where prod_id='$prod_id'");
		while($row_pro=mysql_fetch_array($getPro_id))
		{	
			$prod_id = $row_pro['product_id'];
			$prod_title = $row_pro['product_title'];
			$prod_price = $row_pro['product_price'];
			$prod_image = $row_pro['product_image'];
			$pro_desc = $row_pro['product_desc'];
			
			echo "<div id'single_product'><h3>$prod_title</h3>
			<a href='images/$prod_image' style='float:left;'>
			<image src='images/$prod_image' width='400' height='300'></image></a>
			<h4><strong>$ $prod_price</strong></h4>
			<br><br>$pro_desc<br><br><br><br><br>
			<a href='index.php?pro_id=$prod_id'>Go Back</a>
			<a href='index.php?pro_id=$prod_id' style='float:right;'>
			<button style='float:right;'>Add to Cart</button></a> 
			</div>";
		}
	}
	closeDB();
}
function products()
{
	echo"<center><table width='800'>
    	<tr>";
	openDB();
		$getPro_id = mysql_query("select * from products where product_type='Product'");
		$split=0;
		
		while($row_pro=mysql_fetch_array($getPro_id))
		{	
			$prod_id = $row_pro['product_id'];
			$prod_title = $row_pro['product_title'];
			$prod_price = $row_pro['product_price'];
			$prod_image = $row_pro['product_image'];
			$pro_desc = $row_pro['product_desc'];
			$split++; 
			
			echo "<td width='400' style='padding:5px;'><h3>$prod_title</h3><br>
			<a href='../pages/details2.php?pro_id=$prod_id'><br>
			<image src='../Images/$prod_image' width='200' height='100'></image></a>
			<br>
			<h4><strong>Price: $ $prod_price</strong></h4>
			<br><br><h4>Description:</h4><br>$pro_desc<br><br>
			<a href='../pages/details2.php?pro_id=$prod_id'>Details</a>
			<a href='http://www.smcleodtech.com.au/index.php?add_cart=$prod_id'>
			<button>Add to Cart</button></a></td>";
			
			if($split%3==0)
			{
       				echo "</tr><tr>";
			}
		}
	cart();
	closeDB();
	echo"</tr><br></table></center>";
}
function webTemplates()
{
echo"<center><table width='800'>
    <tr>";
	
	openDB();
	$getPro_id = mysql_query("select * from products where product_type='WebDesignTemplate'");
	$split=0;
			
	while($row_pro=mysql_fetch_array($getPro_id))
	{	
		$prod_id = $row_pro['product_id'];
		$prod_title = $row_pro['product_title'];
		$prod_price = $row_pro['product_price'];
		$prod_image = $row_pro['product_image'];
		$pro_desc = $row_pro['product_desc'];
		$split++; 
				
		echo "
		<td width='400' style='padding:5px;'><h3>$prod_title</h3>
		<br><a href='../pages/details2.php?pro_id=$prod_id'>
		<br>
		<image src='../Images/$prod_image' width='200' height='100'></image></a>
		<br><h4><strong>Price: $ $prod_price</strong></h4>
		<br><br><h4>Description:</h4><br>$pro_desc<br><br>
		<a href='../pages/details2.php?pro_id=$prod_id'>Details</a>
		<a href='http://www.smcleodtech.com.au/index.php?add_cart=$prod_id'>
		<button>Add to Cart</button></a></td>";
		
		if ($split%3==0)
		{
       			echo "</tr><tr>";
		}
	}
	cart();
	closeDB();
	echo"</tr><br></table></center>";
}
function softwareApps()
{
echo"<center><table width='800'>
    <tr>";
	
	openDB();
	$getPro_id = mysql_query("select * from products where product_type='SoftwareApps'");
	$split=0;
			
	while($row_pro=mysql_fetch_array($getPro_id))
	{	
		$prod_id = $row_pro['product_id'];
		$prod_title = $row_pro['product_title'];
		$prod_price = $row_pro['product_price'];
		$prod_image = $row_pro['product_image'];
		$pro_desc = $row_pro['product_desc'];
		$split++; 
				
		echo "<td width='400' style='padding:5px;'><h3>$prod_title</h3><br>
		<a href='../pages/details2.php?pro_id=$prod_id'><br>
		<image src='../Images/$prod_image' width='200' height='100'></image></a>
		<br><h4><strong>Price: $ $prod_price</strong></h4>
		<br><br><h4>Description:</h4><br>$pro_desc<br><br>
		<a href='../pages/details2.php?pro_id=$prod_id'>Details</a>
		<a href='http://www.smcleodtech.com.au/index.php?add_cart=$prod_id'>
		<button>Add to Cart</button></a></td>";
				
		if ($split%3==0)
		{
       			echo "</tr><tr>";
		}
	}
	cart();
	closeDB();
	echo"</tr><br></table></center>";
}
function Training()
{
echo"<center><table width='800'>
    <tr>";
	
	openDB();
	$getPro_id = mysql_query("select * from products where product_type='Tutorial'");
	$split=0;
			
	while($row_pro=mysql_fetch_array($getPro_id))
	{	
		$prod_id = $row_pro['product_id'];
		$prod_title = $row_pro['product_title'];
		$prod_price = $row_pro['product_price'];
		$prod_image = $row_pro['product_image'];
		$pro_desc = $row_pro['product_desc'];
		$split++; 
		echo "<td width='400' style='padding:5px;'><h3>$prod_title</h3><br>
		<a href='../pages/details2.php?pro_id=$prod_id'><br>
		<image src='../Images/$prod_image' width='200' height='100'></image></a><br>
		<h4><strong>Price: $ $prod_price</strong></h4>
		<br><br><h4>Description:</h4><br>$pro_desc<br><br>
		<a href='../pages/details2.php?pro_id=$prod_id'>Details</a>
		<a href='http://www.smcleodtech.com.au/index.php?add_cart=$prod_id'>
		<button>Add to Cart</button></a></td>";
		
		if ($split%3==0)
		{
		echo "</tr><tr>";
		}
	}
	cart();
	closeDB();
	echo"</tr><br></table></center>";	
}
function CSSTraining()
{
echo"<center><table width='800'>
    <tr>";
	
	openDB();
	$getPro_id = mysql_query("select * from products where product_type='Tutorial'");
	$split=0;
			
	while($row_pro=mysql_fetch_array($getPro_id))
	{	
		$prod_id = $row_pro['product_id'];
		$prod_title = $row_pro['product_title'];
		$prod_price = $row_pro['product_price'];
		$prod_image = $row_pro['product_image'];
		$pro_desc = $row_pro['product_desc'];
		$split++; 
		
		echo "<td width='400' style='padding:5px;'><h3>$prod_title</h3>
		<br><a href='../pages/details2.php?pro_id=$prod_id'><br>
		<image src='../Images/$prod_image' width='200' height='100'></image></a>
		<br><h4><strong>Price: $ $prod_price</strong></h4>
		<br><br><h4>Description:</h4><br>$pro_desc<br><br>
		<a href='../pages/details2.php?pro_id=$prod_id'>Details</a>
		<a href='http://www.smcleodtech.com.au/index.php?add_cart=$prod_id'>
		<button>Add to Cart</button></a></td>";
		if ($split%3==0)
		{
       			echo "</tr><tr>";
		}
	}
	cart();
	closeDB();
	echo"</tr><br></table></center>";	
}
function Portfolio()
{
echo"<center><table width='800'>
    <tr>";
	
	openDB();
	$getPro_id = mysql_query("select * from products where product_type='Portfolio'");
	$split=0;
			
	while($row_pro=mysql_fetch_array($getPro_id))
	{	
		$prod_id = $row_pro['product_id'];
		$prod_title = $row_pro['product_title'];
		$prod_price = $row_pro['product_price'];
		$prod_image = $row_pro['product_image'];
		$pro_desc = $row_pro['product_desc'];
		$split++; 
		
		echo "<td width='400' style='padding:5px;'><h3>$prod_title</h3>
		<br>
		<a href='../pages/details2.php?pro_id=$prod_id'><br>
		<image src='../Images/$prod_image' width='200' height='100'></image></a><br>
		<h4><strong>Price: $ $prod_price</strong></h4>
		<br><br><h4>Description:</h4><br>$pro_desc<br><br>
		<a href='../pages/details2.php?pro_id=$prod_id'>Details</a>
		<a href='http://www.smcleodtech.com.au/index.php?add_cart=$prod_id'>
		<button>Add to Cart</button></a></td>";
		
		if ($split%3==0)
		{
       			echo "</tr><tr>";
		}
	}
	closeDB();
	echo"</tr><br></table></center>";	
}
function CSharpTutorials()
{
	echo"<center><table width='800'>
    <tr>";
	
	openDB();
	$getPro_id = mysql_query("select * from products where product_link='csharp.php'");
	$split=0;
	
	while($row_pro=mysql_fetch_array($getPro_id))
	{	
		$prod_id = $row_pro['product_id'];
		$prod_title = $row_pro['product_title'];
		$prod_price = $row_pro['product_price'];
		$prod_image = $row_pro['product_image'];
		$pro_desc = $row_pro['product_desc'];
		$split++; 
		
		echo "
		<td width='400' style='padding:5px;'><h3>$prod_title</h3>
		<br>
		<a href='../pages/details2.php?pro_id=$prod_id'>
		<br>
		<image src='../Images/$prod_image' width='200' height='100'></image></a>
		<br>
		<h4><strong>Price: $ $prod_price</strong></h4>
		<br><br><h4>Description:</h4><br>$pro_desc<br><br>
		<a href='../pages/details2.php?pro_id=$prod_id'>Details</a>
		<a href='../index.php?add_cart=$prod_id'>
		<button>Add to Cart</button></a></td>";
		
		if ($split%3==0)
		{
       			echo "</tr><tr>";
		}
	}
	cart();
	closeDB();
	echo"</tr><br></table></center>";	
}
function PHPTutorials()
{
	openDB();
	echo"<center><table width='800'><tr>";

	$getPro_id = mysql_query("select * from products where product_link='php.php'");
	$split=0;
	
		while($row_pro=mysql_fetch_array($getPro_id))
		{	
			$prod_id = $row_pro['product_id'];
			$prod_title = $row_pro['product_title'];
			$prod_price = $row_pro['product_price'];
			$prod_image = $row_pro['product_image'];
			$pro_desc = $row_pro['product_desc'];
			$split++; 
			
			echo "<td width='400' style='padding:5px;'><h3>$prod_title</h3><br>
			<a href='../pages/details2.php?pro_id=$prod_id'><br>
			<image src='../Images/$prod_image' width='200' height='100'></image></a>
			<br><h4><strong>Price: $ $prod_price</strong></h4>
			<br><br><h4>Description:</h4><br>$pro_desc<br><br>
			<a href='../pages/details2.php?pro_id=$prod_id'>Details</a>
			<a href='http://www.smcleodtech.com.au/index.php?add_cart=$prod_id'>
			<button>Add to Cart</button></a></td>";
			
			if ($split%3==0)
			{
       				echo "
				</tr><tr>";
			}
		}

	cart();
	closeDB();
	echo"</tr><br></table></center>";
		
}
/*	
	Colour Table Function
	
	Function Purpose: Creates a colour chart for updating the front end of website 
	Function Actors: Site Content Creators / Site Managers.
	Function Requerments: Only Authorised users have access, and each time a user has selected a colour from the table
	Colour value is to be placed in the database then referenced on the created Page
	
	Technology used 
	JavaScript, PHP, MySQL	
	
*/
function colourTable()
{
	echo"
	<script language=\"javaScript\">
	function changeColor(code) 
	{
		document.bgColor=code;
		return(code);
	}
	</script>
	<table bgcolor=\"#CCCCCC\" width=\"300\" border=\"1\">
		<tr>
			<td onMouseOver=\"\" onClick=\"changeColor('#000000')\" bgcolor=\"#000000\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#003300')\" bgcolor=\"#003300\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#006600')\" bgcolor=\"#006600\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#009900')\" bgcolor=\"#009900\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#00CC00')\" bgcolor=\"#00CC00\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#00FF00')\" bgcolor=\"#00FF00\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#330000')\" bgcolor=\"#330000\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#333300')\" bgcolor=\"#333300\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#336600')\" bgcolor=\"#336600\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#339900')\" bgcolor=\"#339900\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#33CC00')\" bgcolor=\"#33CC00\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#33FF00')\" bgcolor=\"#33FF00\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#660000')\" bgcolor=\"#660000\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#663300')\" bgcolor=\"#663300\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#666600')\" bgcolor=\"#666600\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#669900')\" bgcolor=\"#669900\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#66CC00')\" bgcolor=\"#66CC00\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#66FF00')\" bgcolor=\"#66FF00\">&nbsp;</td>
		</tr>
		<tr>
			<td onMouseOver=\"\" onClick=\"changeColor('#000033')\" bgcolor=\"#000033\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#003333')\" bgcolor=\"#003333\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#006633')\" bgcolor=\"#006633\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#009933')\" bgcolor=\"#009933\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#00CC33')\" bgcolor=\"#00CC33\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#00FF33')\" bgcolor=\"#00FF33\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#330033')\" bgcolor=\"#330033\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#333333')\" bgcolor=\"#333333\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#336633')\" bgcolor=\"#336633\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#339933')\" bgcolor=\"#339933\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#33CC33')\" bgcolor=\"#33CC33\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#33FF33')\" bgcolor=\"#33FF33\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#660033')\" bgcolor=\"#660033\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#663333')\" bgcolor=\"#663333\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#666633')\" bgcolor=\"#666633\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#669933')\" bgcolor=\"#669933\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#66CC33')\" bgcolor=\"#66CC33\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#66FF33')\" bgcolor=\"#66FF33\">&nbsp;</td>
		</tr>
		<tr>
			<td onMouseOver=\"\" onClick=\"changeColor('#000066')\" bgcolor=\"#000066\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#003366')\" bgcolor=\"#003366\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#006666')\" bgcolor=\"#006666\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#009966')\" bgcolor=\"#009966\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#00CC66')\" bgcolor=\"#00CC66\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#00FF66')\" bgcolor=\"#00FF66\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#330066')\" bgcolor=\"#330066\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#333366')\" bgcolor=\"#333366\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#336666')\" bgcolor=\"#336666\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#339966')\" bgcolor=\"#339966\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#33CC66')\" bgcolor=\"#33CC66\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#33FF66')\" bgcolor=\"#33FF66\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#660066')\" bgcolor=\"#660066\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#663366')\" bgcolor=\"#663366\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#666666')\" bgcolor=\"#666666\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#669966')\" bgcolor=\"#669966\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#66CC66')\" bgcolor=\"#66CC66\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#66FF66')\" bgcolor=\"#66FF66\">&nbsp;</td>
		</tr>
		<tr>
			<td onMouseOver=\"\" onClick=\"changeColor('#000099')\" bgcolor=\"#000099\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#003399')\" bgcolor=\"#003399\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#006699')\" bgcolor=\"#006699\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#009999')\" bgcolor=\"#009999\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#00CC99')\" bgcolor=\"#00CC99\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#00FF99')\" bgcolor=\"#00FF99\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#330099')\" bgcolor=\"#330099\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#333399')\" bgcolor=\"#333399\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#336699')\" bgcolor=\"#336699\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#339999')\" bgcolor=\"#339999\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#33CC99')\" bgcolor=\"#33CC99\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#33FF99')\" bgcolor=\"#33FF99\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#660099')\" bgcolor=\"#660099\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#663399')\" bgcolor=\"#663399\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#666699')\" bgcolor=\"#666699\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#669999')\" bgcolor=\"#669999\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#66CC99')\" bgcolor=\"#66CC99\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#66FF99')\" bgcolor=\"#66FF99\">&nbsp;</td>
		</tr>
		<tr>
			<td onMouseOver=\"\" onClick=\"changeColor('#0000CC')\" bgcolor=\"#0000CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#0033CC')\" bgcolor=\"#0033CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#0066CC')\" bgcolor=\"#0066CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#0099CC')\" bgcolor=\"#0099CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#00CCCC')\" bgcolor=\"#00CCCC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#00FFCC')\" bgcolor=\"#00FFCC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#3300CC')\" bgcolor=\"#3300CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#3333CC')\" bgcolor=\"#3333CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#3366CC')\" bgcolor=\"#3366CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#3399CC')\" bgcolor=\"#3399CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#33CCCC')\" bgcolor=\"#33CCCC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#33FFCC')\" bgcolor=\"#33FFCC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#6600CC')\" bgcolor=\"#6600CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#6633CC')\" bgcolor=\"#6633CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#6666CC')\" bgcolor=\"#6666CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#6699CC')\" bgcolor=\"#6699CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#66CCCC')\" bgcolor=\"#66CCCC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#66FFCC')\" bgcolor=\"#66FFCC\">&nbsp;</td>
		</tr>
		<tr>
			<td onMouseOver=\"\" onClick=\"changeColor('#0000FF')\" bgcolor=\"#0000FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#0033FF')\" bgcolor=\"#0033FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#0066FF')\" bgcolor=\"#0066FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#0099FF')\" bgcolor=\"#0099FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#00CCFF')\" bgcolor=\"#00CCFF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#00FFFF')\" bgcolor=\"#00FFFF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#3300FF')\" bgcolor=\"#3300FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#3333FF')\" bgcolor=\"#3333FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#3366FF')\" bgcolor=\"#3366FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#3399FF')\" bgcolor=\"#3399FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#33CCFF')\" bgcolor=\"#33CCFF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#33FFFF')\" bgcolor=\"#33FFFF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#6600FF')\" bgcolor=\"#6600FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#6633FF')\" bgcolor=\"#6633FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#6666FF')\" bgcolor=\"#6666FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#6699FF')\" bgcolor=\"#6699FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#66CCFF')\" bgcolor=\"#66CCFF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#66FFFF')\" bgcolor=\"#66FFFF\">&nbsp;</td>
		</tr>
		<tr>
			<td onMouseOver=\"\" onClick=\"changeColor('#990000')\" bgcolor=\"#990000\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#993300')\" bgcolor=\"#993300\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#996600')\" bgcolor=\"#996600\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#999900')\" bgcolor=\"#999900\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#99CC00')\" bgcolor=\"#99CC00\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#99FF00')\" bgcolor=\"#99FF00\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC0000')\" bgcolor=\"#CC0000\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC3300')\" gcolor=\"#CC3300\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC6600')\" bgcolor=\"#CC6600\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC9900')\" bgcolor=\"#CC9900\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CCCC00')\" bgcolor=\"#CCCC00\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CCFF00')\" bgcolor=\"#CCFF00\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF0000')\" bgcolor=\"#FF0000\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF3300')\" bgcolor=\"#FF3300\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF6600')\" bgcolor=\"#FF6600\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF9900')\" bgcolor=\"#FF9900\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FFCC00')\" bgcolor=\"#FFCC00\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FFFF00')\" bgcolor=\"#FFFF00\">&nbsp;</td>
		</tr>
		<tr>
			<td onMouseOver=\"\" onClick=\"changeColor('#990033')\" bgcolor=\"#990033\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#993333')\" bgcolor=\"#993333\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#996633')\" bgcolor=\"#996633\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#999933')\" bgcolor=\"#999933\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#99CC33')\" bgcolor=\"#99CC33\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#99FF33')\" bgcolor=\"#99FF33\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC0033')\" bgcolor=\"#CC0033\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC3333')\" bgcolor=\"#CC3333\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC6633')\" bgcolor=\"#CC6633\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC9933')\" bgcolor=\"#CC9933\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CCCC33')\" bgcolor=\"#CCCC33\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CCFF33')\" bgcolor=\"#CCFF33\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF0033')\" bgcolor=\"#FF0033\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF3333')\" bgcolor=\"#FF3333\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF6633')\" bgcolor=\"#FF6633\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF9933')\" bgcolor=\"#FF9933\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FFCC33')\" bgcolor=\"#FFCC33\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FFFF33')\" bgcolor=\"#FFFF33\">&nbsp;</td>
		</tr>
		<tr>
			<td onMouseOver=\"\" onClick=\"changeColor('#990066')\" bgcolor=\"#990066\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#993366')\" bgcolor=\"#993366\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#996666')\" bgcolor=\"#996666\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#999966')\" bgcolor=\"#999966\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#99CC66')\" bgcolor=\"#99CC66\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#99FF66')\" bgcolor=\"#99FF66\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC0066')\" bgcolor=\"#CC0066\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC3366')\" bgcolor=\"#CC3366\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC6666')\" bgcolor=\"#CC6666\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC9966')\" bgcolor=\"#CC9966\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CCCC66')\" bgcolor=\"#CCCC66\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CCFF66')\" bgcolor=\"#CCFF66\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF0066')\" bgcolor=\"#FF0066\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF3366')\" bgcolor=\"#FF3366\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF6666')\" bgcolor=\"#FF6666\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF9966')\" bgcolor=\"#FF9966\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FFCC66')\" bgcolor=\"#FFCC66\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FFFF66')\" bgcolor=\"#FFFF66\">&nbsp;</td>
		</tr>
		<tr>
			<td onMouseOver=\"\" onClick=\"changeColor('#990099')\" bgcolor=\"#990099\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#993399')\" bgcolor=\"#993399\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#996699')\" bgcolor=\"#996699\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#999999')\" bgcolor=\"#999999\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#99CC99')\" bgcolor=\"#99CC99\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#99FF99')\" bgcolor=\"#99FF99\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC0099')\" bgcolor=\"#CC0099\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC3399')\" bgcolor=\"#CC3399\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC6699')\" bgcolor=\"#CC6699\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC9999')\" bgcolor=\"#CC9999\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CCCC99')\" bgcolor=\"#CCCC99\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CCFF99')\" bgcolor=\"#CCFF99\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF0099')\" bgcolor=\"#FF0099\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF3399')\" bgcolor=\"#FF3399\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF6699')\" bgcolor=\"#FF6699\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF9999')\" bgcolor=\"#FF9999\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FFCC99')\" bgcolor=\"#FFCC99\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FFFF99')\" bgcolor=\"#FFFF99\">&nbsp;</td>
		</tr>
		<tr>
			<td onMouseOver=\"\" onClick=\"changeColor('#9900CC')\" bgcolor=\"#9900CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#9933CC')\" bgcolor=\"#9933CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#9966CC')\" bgcolor=\"#9966CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#9999CC')\" bgcolor=\"#9999CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#99CCCC')\" bgcolor=\"#99CCCC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#99FFCC')\" bgcolor=\"#99FFCC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC00CC')\" bgcolor=\"#CC00CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC33CC')\" bgcolor=\"#CC33CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC66CC')\" bgcolor=\"#CC66CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC99CC')\" bgcolor=\"#CC99CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CCCCCC')\" bgcolor=\"#CCCCCC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CCFFCC')\" bgcolor=\"#CCFFCC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF00CC')\" bgcolor=\"#FF00CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF33CC')\" bgcolor=\"#FF33CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF66CC')\" bgcolor=\"#FF66CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF99CC')\" bgcolor=\"#FF99CC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FFCCCC')\" bgcolor=\"#FFCCCC\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FFFFCC')\" bgcolor=\"#FFFFCC\">&nbsp;</td>
		</tr>
		<tr>
			<td onMouseOver=\"\" onClick=\"changeColor('#9900FF')\" bgcolor=\"#9900FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#9933FF')\" bgcolor=\"#9933FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#9966FF')\" bgcolor=\"#9966FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#9999FF')\" bgcolor=\"#9999FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#99CCFF')\" bgcolor=\"#99CCFF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#99FFFF')\" bgcolor=\"#99FFFF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC00FF')\" bgcolor=\"#CC00FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC33FF')\" bgcolor=\"#CC33FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC66FF')\" bgcolor=\"#CC66FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CC99FF')\" bgcolor=\"#CC99FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CCCCFF')\" bgcolor=\"#CCCCFF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#CCFFFF')\" bgcolor=\"#CCFFFF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF00FF')\" bgcolor=\"#FF00FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF33FF')\" bgcolor=\"#FF33FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF66FF')\" bgcolor=\"#FF66FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FF99FF')\" bgcolor=\"#FF99FF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FFCCFF')\" bgcolor=\"#FFCCFF\">&nbsp;</td>
			<td onMouseOver=\"\" onClick=\"changeColor('#FFFFFF')\" bgcolor=\"#FFFFFF\">&nbsp;</td>
		</tr>
	</table> 
	Colour Number:<br>
	<input type=\"text\" name=\"pageColour\" onChange=\"changeColor(color)\">
	<input name=\"sumbit\" type=\"submit\" value=\"Apply Colour\">";
}

// this function has been created so that all items within  the database that have a link property of Game_development.php
function gameDevelopment()
{
	//creates the start of the table tag and sets it's property to center on the webpage
	echo"<center><table width='800'><tr>";
	
	//establishes connection to the database
	openDB();
	//selects all elements of the database with the product_link of Game_Development.php
	$getPro_id = mysql_query("select * from products where product_link='Game_Development.php'");
	//this varible has been setup to split the output of the records displayed in the table 
	$split=0;
			
	//selects all fields of the products table and creates and array to display the contence of the array
	while($row_pro=mysql_fetch_array($getPro_id))
	{	
		$prod_id = $row_pro['product_id'];
		$prod_title = $row_pro['product_title'];
		$prod_price = $row_pro['product_price'];
		$prod_image = $row_pro['product_image'];
		$pro_desc = $row_pro['product_desc'];
		
		$split++; 
		
		echo "<td width='400' style='padding:5px;'><h3>$prod_title</h3><br>
		<a href='../pages/details2.php?pro_id=$prod_id'>
		<br>
		<image src='../Images/$prod_image' width='200' height='100'></image></a>
		<br><h4><strong>Price: $ $prod_price</strong></h4>
		<br><br><h4>Description:</h4><br>$pro_desc<br><br>
		<a href='../pages/details2.php?pro_id=$prod_id'>Details</a>
		<a href='http://www.smcleodtech.com.au/index.php?add_cart=$prod_id'>
		<button>Add to Cart</button></a></td>";
		
		//devides the table into 3 columes
		if ($split%3==0)
		{
       			echo "</tr><tr>";
		}
	}
	//calls to cart function incase a client wishes to add any elememnt to the store
	cart();
	closeDB();
	echo"</tr><br></table></center>";
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Insert_Product</title>
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
</head>
<?php
include("../functions/functions2.php");
?>
<body>
<?php topNav();?>

<center><form action="<? echo $_SERVER[PHP_SELF];?>" method="post" enctype="multipart/form-data">
<table align="center" width="700" bgcolor="#F7F4F4">
	<tr>
		<td align="center" colspan="7px"><h2>Insert New Product Here:</h2></td>
	</tr>
	<tr>
    	<td align="right"><b>Product Title:</b></td>
		<td><input type="hidden" name="product_id"><input type="text" name="product_title" size="60" required></td>
	</tr>
    <tr>
    	<td align="right"><b>Product Category:</b></td>
		<td>
             <select name="product_cat">
        		<option>Select a Category</option>
        		<?php 
					selCat(); 
				?>
        	</select>
        </td>
	</tr>
    <tr>
	</tr>
    <tr>
    	<td align="right"><b>Product Image 1:</b></td>
		<td><input type="file" accept="image/*" name="product_image" size="60">        
        </td>
	</tr>
    <tr>
    	<td align="right"><b>Product Price:</b></td>
		<td><input type="text" name="product_price" size="60" required></td>
	</tr>
    <tr>
    	<td align="right">Product Description:</td>
		<td><textarea type="text" name="product_desc" cols="20" rows="10"></textarea></td>
	</tr>
    <tr>
    	<td align="right">Product Keywords:</td>
		<td><input type="text" name="product_keywords" size="60"></td>
	</tr>
    <tr>
    	<td align="right">Product Hyper link:</td>
		<td><input type="text" name="product_link" size="60"></td>
	</tr>
	<tr align="center">
		<td colspan="7" align="right"><input type="submit" name="insert_product" value="Insert Product Now"></td>
	</tr>
</table>
</form></center>
</body>
</html>
<?php
openDB();
	$product_id = $_POST['product_id'];
	$product_title = $_POST['product_title'];
	$product_cat = $_POST['product_cat'];
	$product_type = $_POST['product_type'];
	$product_price = $_POST['product_price'];
	$product_desc = $_POST['product_desc'];
	$product_keywords = $_POST['product_keywords'];
	$product_link = $_POST['product_link'];
	
	//getting the image from the feild
	
	$product_image = $_FILES['product_image']['name'];
	$product_image_tmp = $_FILES['product_image']['tmp'];	
	
if(isset($_POST['insert_product']))
{
	//getts the Text Feild Data
	 $insert_product = "insert into products(product_id,product_cat, product_type, product_title, 
			product_price, product_desc, product_image, product_keywords,product_link)					 
			values('','$product_cat','$product_type','$product_title',
			'$product_price','$product_desc','$product_image','$product_keywords','$product_link')";					
					
		if(mysql_query($insert_product))
		{
			$file_directory ="../Images";	
			foreach($_FILES as $file_name => $file_array)
			{				
				if(is_uploaded_file($file_array["tmp_name"]))
				{
					move_uploaded_file($file_array["tmp_name"],"$file_directory/"
					.$file_array["name"]) or die ("Could not copy");
				}
				echo"<script>alert('Product has been successfully added to the Database Thank you!')</script>";
			}	
		}
		else{
			echo"Product adding has been unsuccessfull<b>",mysql_error(),"</b>";
		}
closeDB();
}
?>
<?php footer();?>

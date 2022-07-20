<?php 
require_once '../Controller/productInfo.php';
$product = fetchProduct($_GET['ProductId']);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
 <form action='../Controller/updateProduct.php?ProductId=<?php echo $_GET['ProductId'];?>' method="POST" enctype="multipart/form-data">
  <label for="ProductName">Name:</label><br>
  <input value="<?php echo $product['ProductName'] ?>" type="text" id="ProductName" name="ProductName"><br>
  <label for="BuyingPrice">Buying Price:</label><br>
  <input value="<?php echo $product['BuyingPrice'] ?>" type="text" id="BuyingPrice" name="BuyingPrice"><br>
  <label for="SellingPrice">Selling Price:</label><br>
  <input value="<?php echo $product['SellingPrice'] ?>" type="text" id="SellingPrice" name="SellingPrice"><br>
  <input type="submit" name = "updateProduct" value="update" >
  <input type="reset"> 
</form> 
</body>
</html>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
 <form action="../Controller/createProduct.php" method="POST" enctype="multipart/form-data">
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="ProductName"><br>
  <label for="BuyingPrice">:Buying Price</label><br>
  <input type="text" id="BuyingPrice" name="BuyingPrice"><br>
  <label for="SellingPrice">Selling Price:</label><br>
  <input type="text" id="SellingPrice" name="SellingPrice"><br>
  <input type="submit" name = "createProduct" value="Create">
  <input type="reset"> 
</form> 
</body>
</html>


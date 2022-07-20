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

<table>
	<tr>
		<th>Product Name</th>
		<th>Product Id</th>
		<th>Buying Price</th>
		<th>Selling Price</th>
		<th>Profit</th>
	</tr>
	<tr>
		<td><a href="../View/showProduct.php?ProductId=<?php echo $product['ProductId'] ?>"><?php echo $product['ProductName'] ?></a></td>
		<td><?php echo $product['ProductId'] ?></td>
		<td><?php echo $product['BuyingPrice'] ?></td>
		<td><?php echo $product['SellingPrice'] ?></td>
        <td><?php echo $product['Profit'] ?></td>
	</tr>
</table>
</body>
</html>
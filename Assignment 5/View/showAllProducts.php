<?php  
require_once '../Controller/productInfo.php';
$products = fetchAllProducts();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<table border="1px solid">
	<thead>
		<tr>
			<th>Product Name</th>
			<th>Product Id</th>
			<th>Buying Price</th>
			<th>Selling Price</th>
			<th>Profit</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($products as $i => $product): ?>
			<tr>
				<td><a href="../View/showProduct.php?ProductId=<?php echo $product['ProductId'] ?>"><?php echo $product['ProductName'] ?></a></td>
				<td><?php echo $product['ProductId'] ?></td>
				<td><?php echo $product['BuyingPrice'] ?></td>
				<td><?php echo $product['SellingPrice'] ?></td>
                <td><?php echo $product['Profit'] ?></td>
				<td><a href="../View/editProduct.php?ProductId=<?php echo $product['ProductId'] ?>">Edit</a>&nbsp<a href="../Controller/deleteProduct.php?ProductId=<?php echo $product['ProductId'] ?>" onclick="return confirm('Are you sure want to delete this ?')">Delete</a></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>


</body>
</html>
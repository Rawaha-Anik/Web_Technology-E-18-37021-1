
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		table,td,th{
			border:1px solid black;
		}
	</style>
</head>
<body>

<table>
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
		<?php foreach($allSearchedProducts as $i => $Product): ?>
			<tr>
				<td><?php echo $Product['ProductName']?></td>
				<td><?php echo $Product['ProductId']?></td>
				<td><?php echo $Product['BuyingPrice']?></td>
				<td><?php echo $Product['SellingPrice']?></td>
				<td><?php echo $Product['Profit']?></td>
				<td><a href="../View/editProduct.php?ProductId=<?php echo $Product['ProductId']?>">Edit</a>&nbsp<a href="../Controller/deleteProduct.php?ProductId=<?php echo $Product['ProductId'] ?>">Delete</a></td>
			</tr>
		<?php endforeach; ?>

	</tbody>
	

</table>


</body>
</html>
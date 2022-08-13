<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Controller\ProductController\ControllerShowProductInformation.php';
        $id=$_GET["ProductType"];
        $data=ControllerShowProductByProductType($id);
        echo "<table border='1px solid'>
	        <thead>
	            <tr>
		            <th>Product Name</th>
		            <th>Product Id</th>
                    <th>Product Date</th>
			        <th>Buying Price</th>
		            <th>Selling Price</th>
                    <th>Product Type</th>
                    <th>Product Quantity</th>
                    <th>Product Availability</th>
			    </tr>
	        </thead>
            <tbody>";
	            foreach($data as $i => $product):
			        echo "<tr>
		            	<td>"; echo $product['ProductName'];echo "</td>
				        <td>"; echo $product['ProductId']; echo "</td>
                        <td>"; echo $product['ProductDate']; echo "</td>
				        <td>"; echo $product['ProductBuyingPrice']; echo "</td>
				        <td>"; echo $product['ProductSellingPrice']; echo "</td>
                        <td>"; echo $product['ProductType'];echo "</td>
                        <td>"; echo $product['ProductQuantity'];echo "</td>
                        <td>"; echo $product['ProductAvailability'];echo "</td>
				    </tr>";
		        endforeach;
            echo "</tbody>"
    ?>
</body>
</html>
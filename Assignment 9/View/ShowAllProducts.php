<?php
	session_start();
	if(isset($_COOKIE['Username']))
	{
        $_SESSION['Name']=$_COOKIE["Name"];
        $_SESSION['Username'] =$_COOKIE["Username"];
        $_SESSION['Email'] =$_COOKIE["Email"];
        $_SESSION['Password'] =$_COOKIE["Password"];
        $_SESSION['Gender'] =$_COOKIE["Gender"];
        $_SESSION['DateOfBirth'] =$_COOKIE["DateOfBirth"];
		$_SESSION['BloodGroup'] =$_COOKIE["BloodGroup"];
		$_SESSION['Role'] =$_COOKIE["Role"];
		///$_SESSION['PicturePath'] =$_COOKIE["PicturePath"];
?>
    <?php
        include 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Controller\ProductController\ControllerShowProductInformation.php';
        $data=ControllerShowAllProducts();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Home</title>
        <style>

        </style>
    </head>
    <body>
        
        <table border="1" width="100%" cellspacing="0">
            <tr>
                <td align="right" colspan="3">
                    <?php
                        include 'Login As.php';
                    ?>
                </td>
            </tr>
            <tr height = "200px">
                <td width="30%">
                    <?php
                        include 'dashboardoptions.php';
                    ?>
                </td>
                <td colspan="2">
                    <table border="1px solid">
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
			                <th>Action</th>
		                </tr>
	                </thead>
                	<tbody>
	                	<?php foreach ($data as $i => $product): ?>
			            <tr>
		            		<td><?php echo $product['ProductName']?></td>
				            <td><?php echo $product['ProductId']?></td>
                            <td><?php echo $product['ProductDate']?></td>
				            <td><?php echo $product['ProductBuyingPrice']?></td>
				            <td><?php echo $product['ProductSellingPrice']?></td>
                            <td><?php echo $product['ProductType']?></td>
                            <td><?php echo $product['ProductQuantity']?></td>
                            <td><?php echo $product['ProductAvailability']?></td>
				            <td><a href="removeProduct.php?ProductId=<?php echo $product['ProductId'] ?>" onclick="return confirm('Are you sure want to delete this ?')">Delete</a></td>
			            </tr>
		                <?php endforeach; ?>
                	</tbody>
                    </table>
                </td>
            </tr>
            <tr height = "50px">
                <td colspan="3" >
                    <center> Copyright &copy 2022 </center>
                </td>
            </tr>
        </table>
    </body>
    </html>
<?php
}
else{
	echo "Please do Registration before login in";
}
?>
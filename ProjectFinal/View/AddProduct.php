<?php
    function notanumber($value){
        for($i=0;$i<strlen($value);$i++){
            if(!($value[$i]>='0'&& $value[$i]<='9')){
                return true;
            }
        }
        return false;
    }
?>
<?php
	$nameErr=$name=$emailErr=$email=$username=$usernameErr=$password=$passwordErr=$confirmpassword=$confirmpasswordErr="";
	$date=$dateErr=$gender=$genderErr=$dateErr=$selectRoleErr=$selectBloodGroupErr=$productquantityErr=$productquantity="";
    $producttypeErr=$productname=$buyingprice=$buyingpriceErr=$sellingprice=$sellingpriceErr=$productnameErr=$producttype="";
    $productavailability=$productavailabilityErr="";
	$DateBegin = date('Y-m-d',strtotime("01/01/1953"));
    $DateEnd = date('Y-m-d', strtotime("01/01/2022"));
	$datefromform=date('Y-m-d',strtotime("01/01/2000"));
	$producttype="Perfume";
	if(isset($_POST['Submit'])){
		$allOk = true;		
        $productname=$_POST["ProductName"];
		$buyingprice=$_POST["BuyingPrice"];
		$sellingprice=$_POST["SellingPrice"];
        $producttype=$_POST["ProductType"];
        $productquantity=$_POST["ProductQuantity"];
        $productavailability=$_POST["ProductAvailability"];
		if($productname === ""){
			$productnameErr="Product name is required";
			$allOk = false;
		}
		if(empty($_POST["BuyingPrice"])){
			$allOk=false;
			$buyingpriceErr = "Buying Price is required";
		}
        elseif(notanumber($buyingprice)){
            $buyingpriceErr="Buying Price Must Be A Number";
            $allOk=false;
        }
        if(empty($_POST["SellingPrice"])){
			$allOk=false;
			$sellingpriceErr = "Selling Price is required";
		}
        elseif(notanumber($sellingprice)){
            $sellingpriceErr="Selling Price Must Be A Number";
            $allOk=false;
        } 
        if(empty($_POST["ProductType"])){
            $allOk=false;
			$producttypeErr = "Product Type is required";
        }
		$datefromform=$_POST['ProductDate'];
        if(empty($datefromform)){
			$allOk=false;
            $dateErr="Date can't be empty";
        }
        elseif($datefromform<$DateBegin || $datefromform>$DateEnd){
			$allOk=false;
            $dateErr="Invalid Date";
        }

        if(empty($_POST["ProductAvailability"])){
            $productavailabilityErr="Availibility Can't be empty";
            $allOk=false;
        }
        elseif(!($_POST["ProductAvailability"]==='1' || $_POST["ProductAvailability"]==='0')){
            $productavailabilityErr="The value can be Only 0 or 1";
            $allOk=false;
        }
        if(empty($_POST["ProductQuantity"])){
            $productquantityErr="Quantity Can't be empty";
            $allOk=false;
        }
        elseif(notanumber($productquantity)){
            $productquantityErr="Quantity Must Be A Number";
            $allOk=false;
        }
		if($allOk === true){
            include 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Controller\ProductController\ControllerShowProductInformation.php';
            $data=ControllerShowAllProducts();
            $productid=0;
            foreach($data as $i => $product){
                $newProductId=max($productId,$product['ProductId']);
            }
			$productid=$newProductId+1;
			$extra = array(
                'ProductName'                =>  $productname,  
                'ProductId'  	            =>    $productid,
                'ProductDate'              =>     $_POST["ProductDate"],
                'ProductBuyingPrice'      =>     $_POST["BuyingPrice"],  
                'ProductSellingPrice'    =>  	   $_POST["SellingPrice"],
                'ProductType'           =>     $_POST["ProductType"],
                'ProductQuantity'      => $_POST["ProductQuantity"],
                'ProductAvailability' => $_POST['ProductAvailability']
            );
            addProduct($extra);
            header('Location:AddProduct.php');
		}
	} 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Product</title>
    <style>
        .Coloring{color: #ECF0F1;font-size:5vw;}
        .FontChange{color: #ECF0F1;font-size:2.5vw;}
        .field_set{border-color:#090A09;color: #080A0B;}
        .error{color: #122aa6;}
		hr{background-color: #a61224;}
    </style>
	<script>
		function notanumber(let x)
		{
			for(let i=0;i<x.length;i=i+1)
			{
				if(x[i]>='0'&&x[i]<='9'){
					continue;
				}
				else{
					return true;
				}
			}
			return false;
		}
		function ValidateForm(){
			let x = document.forms["myForm"]["ProductName"].value;
			let k=true;
  			if(x==""){
    			document.getElementById("ProductName").style.borderColor="red";
				document.getElementById("productnamespan").innerHTML="Name Can't Be Empty";
				k&=false;
  			}
			else{
				document.getElementById("Name").style.borderColor="black";
				document.getElementById("namespan").innerHTML="";
				k&=true;
			}
			x = document.forms["myForm"]["BuyingPrice"].value;
			if(x==""){
				document.getElementById("BuyingPrice").style.borderColor="red";
				document.getElementById("buyingpricespan").innerHTML="Buying Price Can't Be Empty";
				k&=false;
			}
			else if(notanumber(x)){
				document.getElementById("BuyingPrice").style.borderColor="red";
				document.getElementById("buyingpricespan").innerHTML="Buying Price Must Be A Number";
				k&=false;
			}
			else{
				document.getElementById("BuyingPrice").style.borderColor="black";
				document.getElementById("buyingpricespan").innerHTML="";
				k&=true;
			}
			x = document.forms["myForm"]["SellingPrice"].value;
			if(x==""){
				document.getElementById("SellingPrice").style.borderColor="red";
				document.getElementById("sellingpricespan").innerHTML="Selling Price Can't Be Empty";
				k&=false;
			}
			else if(notanumber(x)){
				document.getElementById("SellingPrice").style.borderColor="red";
				document.getElementById("sellingpricespan").innerHTML="Selling Price Must Be A Number";
				k&=false;
			}
			else{
				document.getElementById("SellingPrice").style.borderColor="black";
				document.getElementById("sellingpricespan").innerHTML="";
				k&=true;
			}

			x = document.forms["myForm"]["ProductQuantity"].value;
			if(x==""){
				document.getElementById("ProductQuantity").style.borderColor="red";
				document.getElementById("productquantityspan").innerHTML="Product Quantity Can't Be Empty";
				k&=false;
			}
			else if(notanumber(x)){
				document.getElementById("ProductQuantity").style.borderColor="red";
				document.getElementById("productquantityspan").innerHTML="Product Quantity Must Be A Number";
				k&=false;
			}
			else{
				document.getElementById("ProductQuantity").style.borderColor="black";
				document.getElementById("productquantityspan").innerHTML="";
				k&=true;
			}
			x = document.forms["myForm"]["ProductAvailability"].value;
			if(x==""){
				document.getElementById("ProductAvailability").style.borderColor="red";
				document.getElementById("productavailabilityspan").innerHTML="Product Availability Can't Be Empty";
				k&=false;
			}
			else if(x!="0" || x!="1"){
				document.getElementById("ProductAvailability").style.borderColor="red";
				document.getElementById("productavailabilityspan").innerHTML="Product Availability Must Be 0 or 1";
				k&=false;
			}
			else{
				document.getElementById("ProductAvailability").style.borderColor="black";
				document.getElementById("productavailabilityspan").innerHTML="";
				k&=true;
			}
			if(k==1)return true;
			return false;
		}
	</script>
</head>
<body>
	<table border="1" width="100%" cellspacing="0">
		<tr>
			<td align="right">
				<a href="Welcome.php"> <img src="logo.jpg" align="left"> </a> 
				<a href="Welcome.php"> Home </a> 
				&nbsp | &nbsp
				<a href="Login.php"> Login </a>
				&nbsp | &nbsp
				<a href="Registration.php"> Registration </a>
				&nbsp
			</td>
		</tr>
		<tr height = "500px">
			<td colspan="2" align="center">
				<br>
				<form method="POST" action="" name="myForm" onsubmit="return ValidateForm()">
				<fieldset style="width: 50%" class="field_set">
					<legend> <b>Add Product</b></legend>
						<table>
							<tr>
								<td> Name </td>
								<td>
								:<input type="text" name="ProductName" id="ProductName" value="<?php echo $productname;?>">
    							<span class="error" id="productnamespan">* <?php echo $productnameErr;?></span>
    							<br/> </td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
							<tr>
								<td> Buying Price </td>
								<td> :<input type="text" name="BuyingPrice" id="BuyingPrice" value="<?php echo $buyingprice;?>"> 
								<span class="error" id="buyingpricespan">* <?php echo $buyingpriceErr;?></span>
								<br/></td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
							<tr>
								<td> Selling Price </td>
								<td> :<input type="text" name="SellingPrice" id="SellingPrice" value="<?php echo $sellingprice;?>"> 
								<span class="error" id="sellingpricespan">* <?php echo $sellingpriceErr;?></span>
								<br/> </td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
                            <tr>
								<td> Product Quantity </td>
								<td> :<input type="text" name="ProductQuantity" id="ProductQuantity" value="<?php echo $productquantity;?>"> 
								<span class="error" id="productquantityspan">* <?php echo $productquantityErr;?></span>
								<br/></td>
							</tr>
					</table>
					<fieldset style="width: 50%" class="field_set" align="left">
 				   	<legend>Date:</legend>
    				<input name="ProductDate" id="date" type="date" value="<?php echo $datefromform;?>">
    				<span class="error">* <?php echo $dateErr;?></span>
    				</fieldset><br>
					
					<fieldset style="width: 50%" class="field_set" align="left">
    				<legend>Product Type:</legend> 
   					 <select name ="ProductType" id="ProductType" value="<?php echo $producttype;?>">
        				<option value="Electronics">Electronics</option>
        				<option value="Furniture">Furniture</option>
        				<option value="Food">Food</option>
                        <option value="Beauty">Beauty</option>
                        <option value="Perfume">Perfume</option>
    				</select>
    				<span class="error"> <?php echo $producttypeErr;?></span><br>
  				    </fieldset><br>
                     
                    <fieldset  style="width: 50%" class="field_set" align="left">
                    <legend>Product Availability </legend>
                    <input type="text" name="ProductAvailability" id="ProductAvailability" value="<?php echo $productavailability; ?>">
                    <span class="error" id="productavailabilityspan"> <?php echo $productavailabilityErr;?></span>
                    </fieldset><br>
                    <hr>
					<input type="reset" name="Reset" value="Reset">
					<input type="submit" name="Submit" value="Submit">
				</fieldset>
				</form>
			<br>
			</td>
		</tr>
		<tr height = "50px">
			<td colspan="2">
				<center> Copyright &copy 2022 </center>
			</td>
		</tr>
	</table>
</body>
</html>
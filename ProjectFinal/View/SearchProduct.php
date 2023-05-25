<?php
    if(isset($_COOKIE['Username'])){
		session_start();
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Product</title>
    <script>
        function showProduct(str){
            if(str==""){
                document.getElementById("txtHint").innerHTML="";
                return;
            }
            else{
				const xmlhttp = new XMLHttpRequest();
				xmlhttp.onload = function(){
				    document.getElementById("txtHint").innerHTML =this.responseText;
				}
				xmlhttp.open("GET", "getproducts.php?ProductType="+str);
				xmlhttp.send();
			}
       }
    </script>
</head>
<body>
    <form action="">
        <select name="product" onchange="showProduct(this.value)">
            <option value="">Select A Product</option>
            <option value="Electronics">Electronics</option>
            <option value="Furniture">Furniture</option>
            <option value="Food">Food</option>
            <option value="Beauty">Beauty</option>
            <option value="Perfume">Perfume</option>
        </select>
    </form>
    <div id="txtHint">All Products Info Will be Shown Here</div>
</body>
</html>
<?php
    }
?>
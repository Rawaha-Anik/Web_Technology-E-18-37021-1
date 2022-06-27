<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body>
<img src="pngwing.PNG" alt="not found"><br>
<form action="ImageValidation.php" method="post" enctype="multipart/form-data">
    <fieldset>
      Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
    </fieldset>
    <fieldset>
         <input type="submit" value="Upload Image" name="submit">
    </fieldset>
</form>
</body>
</html>
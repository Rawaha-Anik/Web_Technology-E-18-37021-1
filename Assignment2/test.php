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
        $errorName=$errorWordCount=$errorMustStart=$errorMustContain="";
        $errorEmail=$errorDate=$errorRadio=$errorCheck=$errorBG="";
        $reg="/^[a-zA-Z\s\.-]+$/";
        $namefromForm;
        $emailfromform;
        $cnt=0;
        $DateBegin = date('Y-m-d', strtotime("01/01/1953"));
        $DateEnd = date('Y-m-d', strtotime("01/01/1998"));
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $namefromForm=$_POST['name'];
            $emailfromform= $_POST["email"];
            $f=true;
            if(empty($namefromForm)){
                $errorName="Empty name cannot be allowed";
            }
            elseif(str_word_count($namefromForm)<2){
                $errorWordCount="Word is too short";
            }
            elseif(empty($namefromForm)){
                $f=false;
            }
            elseif(!($namefromForm[0]>='a'&&$namefromForm[0]<='z') && !($namefromForm[0]>='A'&&$namefromForm[0]<='Z')){
                $errorMustStart="Must Start With a letter";
            }
            elseif(preg_match($reg,$namefromForm)==false){
                $errorMustContain="Must contain characters between [A-Z][a-z].-";
            }
            if(!filter_var($emailfromform, FILTER_VALIDATE_EMAIL)){
                $errorEmail = "Invalid email format";
            }
            $datefromform=$_POST['date'];
            if(empty($datefromform)){
                $errorDate="Date can't be empty";
            }
            elseif($datefromform<$DateBegin || $datefromform>$DateEnd){
                $errorDate="Invalid Date";
            }
            if(!isset($_POST['gender'])){
                $errorRadio="Must select";
            }
            if(isset($_POST['ssc'])){
                $cnt++;
            }
            if(isset($_POST['hsc'])){
                $cnt++;
            }
            if(isset($_POST['bsc'])){
                $cnt++;
            }
            if(isset($_POST['msc'])){
                $cnt++;
            }
            if($cnt<2){
                $errorCheck="Select Atleast 2 Options";
            }
            if(!isset($_POST['bg']) || $_POST['bg']==""){
                $errorBG="Must Select A Blood Group";
            }
        }
    ?>
    <form method="post">
        <fieldset>
        <legend>Name :</legend>
        <input name="name" id="name" type="text">
        <span>*<?php echo $errorName;echo $errorWordCount;echo $errorMustStart;echo $errorMustContain?></span><br>
        </fieldset>

        <fieldset>
        <legend>Email : </legend>
        <input name="email" id="email" type="text">
        <span>*<?php echo $errorEmail?></span><br>
        </fieldset>

        <fieldset>
        <legend>Date : </label>
        <input name="date" id="date" type="date">
        <span>*<?php echo $errorDate?></span><br>
        </fieldset>
        <fieldset>
        <legend>Gender : </legend>
        <input name="gender" id="male" type="radio" value="male">
        <label for="male">Male</label>
        <input name="gender" id="female" type="radio" value="female">
        <label for="female">Female</label>
        <input name="gender" id="other" type="radio" value="other">
        <label for="other">Other</label>
        <span>*<?php echo $errorRadio?></span><br>
        </fieldset>

        <fieldset>
        <legend>Degree : </legend>
        <input name="ssc" id="ssc" type="checkbox" value="SSC">
        <label for="ssc">SSC</label>
        <input name="hsc" id="hsc" type="checkbox" value="HSC">
        <label for="hsc">HSC</label>
        <input name="bsc" id="bsc" type="checkbox" value="Bsc">
        <label for="bsc">Bsc</label>
        <input name="msc" id="msc" type="checkbox" value="Msc">
        <label for="msc">Msc</label>
        <span>*<?php echo $errorCheck?></span><br>
        </fieldset>
        <fieldset>
        <label for="bg">Blood Group : </label><br>
        <select id="bg" name ="bg">
            <option value=""></option>
            <option value="B+">B+</option>
            <option value="AB+">AB+</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB-">AB-</option>
            <option value="B-">B-</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
        </select>
        <span>*<?php echo $errorBG?></span><br>
        </fieldset>
        <fieldset>
        <input type="submit">
        </fieldset>
    </form>
</body>
</html>
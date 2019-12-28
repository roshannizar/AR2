<?php
require "AR2-serverConnection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AR2 - Sign up</title>
    <style type="text/css">
        body
        {
            background-image: url(images/3.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        }
        .sideContainer
        {
            background-color: seagreen;
            height:300px;
            width:62.3%;
            margin-left:50px;
            margin-top:80px;
            float:left;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            text-align: center;
            padding-top:200px;
        }
        .sideContainer2
        {
            background-color: white;
            height: 500px;
            width: 30%;
            margin-right: 50px;
            margin-top: 80px;
            float: right;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
        }
        .credentialsFields
        {
            text-align: center;
            margin-top:20px;
        }
        .heading
        {
            text-align:left;
            margin-left:70px;
            margin-top:20px;
        }
        input[type=text],input[type=password],input[type=email]
        {
            background-color: transparent;
            font-size: 16px;
            padding-left:10px;
            padding-top:10px;
            padding-bottom:10px;
            border:none;
            outline:none;
            width:70%;
            border-bottom:2px solid dimgray;
            color: dimgray;
            transition-duration: 1.0s;
        }
        input[type=text]::placeholder,input[type=password]::placeholder,input[type=email]::placeholder
        {
            color:dimgray;
        }
        input[type=text]:hover,input[type=password]:hover,input[type=email]:hover
        {
            border-bottom:2px solid seagreen;
        }
        input[type=submit]
        {
            background-color: seagreen;
            border-radius: 10px;
            font-size: 18px;
            color:white;
            outline:none;
            border: none;
            padding:10px;
            width:70%;
            transition-duration: 1.0s;
        }
        input[type=submit]:hover
        {
            background-color: seagreen;
            box-shadow: 1px 1px 3px 1px dimgray;
        }
        label
        {
            font-size: 20px;
            color:dimgray;
        }
        .Titlehead
        {
            font-size:55px;
            color:white;
        }
    </style>
</head>
<body>
<div class="sideContainer">
    <label class="Titlehead">AR2</label><br/><br/><br/><br/>
    <a href="http://www.facebook.com"><img src="CSS/Icons/facebook1.png" style="width:10%"></a>
    <a href="http://www.instagram.com"><img src="CSS/Icons/insta.png" style="width:10%"></a>
    <a href="http://www.linkedin.com"><img src="CSS/Icons/in.png" style="width:10%"></a>
    <a href="http://www.google+.com"><img src="CSS/Icons/gplus.png" style="width:10%"></a>
</div>
<div class="sideContainer2">
    <div class="heading">
        <label>AR2 - Sign up</label><br/>
    </div>
    <form class="credentialsFields" method="POST" action="AR2-Signup.php">
        <input type="text" placeholder="First Name" name="first"><br/><br/>
        <input type="text" placeholder="Last Name" name="last"><br/><br/>
        <input type="text" placeholder="Username" name="user"><br/><br/>
        <input type="email" hidden placeholder="Email" name="email">
        <input type="password" placeholder="Password" name="pass"><br/><br/>
        <input type="password" placeholder="Confirm Password" name="conpass"><br/><br/>
        <input type="text" placeholder="Contact No" hidden name="cont">
        Account type: <input type="radio" name="rdtype" value="Administrator">Administrator
        <input type="radio" name="rdtype" value="Standard">Standard
        <br/><br/>
        <input type="submit" value="Sign up" name="btnSignup">
    </form>
    <?php
        if(isset($_POST["first"]) && $_POST["last"] && isset($_POST["user"]) && isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["conpass"]) && isset($_POST["cont"]) && isset($_POST["rdtype"]))
        {
            $firstname = $_POST["first"];
            $lastname = $_POST["last"];
            $username = $_POST["user"];
            $email = $_POST["email"];
            $password = $_POST["pass"];
            $confirmpassword = $_POST["conpass"];
            $contactno = $_POST["cont"];
            $accountype = $_POST["rdtype"];
        }


        if(isset($_POST["btnSignup"]))
        {
            if($password==$confirmpassword)
            {
                $createAccount = "INSERT INTO user VALUES('$firstname','$lastname','$username','null@gmail.com','$password','0','$accountype')";

                if ($con->query($createAccount))
                {
                    echo '<script>';
                    echo 'alert("Account Created Successfully...")';
                    echo '</script>';
                    header('AR2-Main.php');
                }
                else
                {
                    echo '<script>';
                    echo 'alert("Error occured while creating....")';
                    echo '</script>';
                }
            }
            else
            {
                echo '<script>';
                echo 'alert("Password didnt match")';
                echo '</script>';
            }
        }
    ?>
</div>
</body>
</html>
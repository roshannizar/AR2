<?php
    require "AR2-serverConnection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AR2 - SignIn</title>
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
            margin-top:150px;
        }
        .heading
        {
            text-align:left;
            margin-left:70px;
            margin-top:50px;
        }
        input[type=text],input[type=password]
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
        input[type=text]::placeholder,input[type=password]::placeholder
        {
            color:dimgray;
        }
        input[type=text]:hover,input[type=password]:hover
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
    <script type="text/javascript">
        function showPassword()
        {
            var pass = document.getElementById("pass");

            if(pass.type==="password")
            {
                pass.type="text";
            }
            else
            {
                pass.type="password";
            }
        }
    </script>
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
        <label>AR2 - Login</label><br/>
    </div>
    <form class="credentialsFields" method="POST" action="AR2-Signin.php">
        <input type="text" placeholder="Username" name="user"><br/><br/>
        <input type="password" placeholder="Password" name="pass" id="pass"><br/><br/>
        <input type="checkbox" onclick="showPassword()" style="margin-left:-160px">Show Password<br/><br/>
        <input type="submit" value="Sign In" name="btnSignin">
    </form>
    <?php
        session_start();

    if(isset($_POST["user"]) && isset($_POST["pass"]))
    {
        $username = $_POST["user"];
        $password = $_POST["pass"];
    }


    if(isset($_POST["btnSignin"]))
    {
        if($username=="" && $password=="")
        {
            echo '<script>';
            echo 'alert("Invalid Credentials...")';
            echo '</script>';
        }
        else
        {
            $selectUserPass = "SELECT * FROM user WHERE (username='$username' AND password='$password')";
            $selectedDetails = $con->query($selectUserPass);
            $rowUserPass = mysqli_fetch_assoc($selectedDetails);

            $_SESSION["loginuser"]=$username;
            $_SESSION["user"] = $rowUserPass["firstname"] . " " .$rowUserPass["lastname"];
            $_SESSION["account"]=$rowUserPass["accountype"];

            if ($username == $rowUserPass["username"] && $password == $rowUserPass["password"])
            {
                header("location: AR2-SplashStart.html");
            }
            else
            {
                echo '<script>';
                echo 'alert("Invalid Credentials..")';
                echo '</script>';
            }
        }
    }
    ?>
</div>
</body>
</html>
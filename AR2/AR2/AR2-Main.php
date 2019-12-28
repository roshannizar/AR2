<?php
    require "AR2-serverConnection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AR2 - Dashboard</title>
    <style>
        .container
        {
            background-color: whitesmoke;
            box-shadow: 1px 1px 3px 1px dimgray;
            position: fixed;
            top:0;
            left:0;
            width:100%;
            padding:15px;
            text-align: center;
        }
        .container a
        {
            font-size:20px;
            color:black;
            padding:18px 20px;
            border:none;
            text-decoration: none;
            transition-duration: 1.0s;
            font-family: Carlito;
        }
        .container a:hover
        {
            color:seagreen;
            border-bottom: 3px solid seagreen;
        }
        .container1
        {
            padding:15px;
            position: absolute;
            top:0;
            left:0;
        }
        .container1 label
        {
            font-size:25px;
            color:black;
            padding:18px 20px;
            border:none;
            transition-duration: 1.0s;
            font-family: Carlito;
        }
        .main
        {
            margin-top:70px;
        }
        .main label
        {
            font-size:20px;
        }
        .subContainer
        {
            width:12%;
            margin:10px;
            background-color: seagreen;
            height:90px;
            padding-top:30px;
            padding-left:150px;
            box-shadow: 1px 1px 3px 1px dimgray;
            border-top:5px solid white;
            float:left;
        }
        .subContainer label
        {
            font-size: 24px;
            color:white;
        }
        th
        {
            background-color: seagreen;
            color:white;
            font-size:18px;
            padding:10px;
        }
        .tab
        {
            margin-top:10px;
            float:left;
            margin-left:8px;
            width:47.9%;
            border:0.5px solid seagreen;
        }
        .tab1
        {
            margin-top:10px;
            float:right;
            margin-right:30px;
            width:47.9%;
            border:0.5px solid seagreen;
        }
        .profileDetails
        {
            margin-top:5%;
        }
        td
        {
            padding-left:10px;
        }
        input[type=text],input[type=email],input[type=password]
        {
            box-sizing: border-box;
            outline:none;
            border:none;
            margin:10px;
            padding:10px;
            background-color: silver;
            color:black;
            width:25%;
            border-left:4px solid darkslategray;
        }
        input[type=submit],button
        {
            background-color: transparent;
            color:dimgray;
            width:25%;
            margin:10px;
            font-family:calibri;
            font-size:20px;
            border:2px solid dimgray;
            padding:10px;
        }
        input[type=submit]:hover,button:hover
        {
            background-color: dimgray;
            color:white;
        }
    </style>
    <script type="text/javascript">
        function showProfile()
        {
            document.getElementById("profile").style.display="Block";
        }

        function hideProfile()
        {
            document.getElementById("profile").style.display="None";
        }
    </script>
</head>
<?php
    $allSales = "SELECT * FROM sales";
    $allStock = "SELECT * FROM stock";
    $allCustomer = "SELECT * FROM customer";
    $allSupplier = "SELECT * FROM supplier";

    $salesAmount=0;
    $stockAmount=0;
    $customerAmount=0;
    $supplierAmount=0;

    $allSalesQuery = $con->query($allSales);
    $allStockQuery = $con->query($allStock);
    $allCustomerQuery = $con->query($allCustomer);
    $allSupplierQuery = $con->query($allSupplier);

    while($row1 = mysqli_fetch_assoc($allSalesQuery))
    {
        $salesAmount=$salesAmount+$row1["amount"];
    }

    while($row2 = mysqli_fetch_assoc($allStockQuery))
    {
        $price= $row2["price"];
        $quantity = $row2["quantity"];
        $stockAmount=$stockAmount+($price*$quantity);
    }

    while($row3 = mysqli_fetch_assoc($allCustomerQuery))
    {
        $customerAmount = $customerAmount+1;
    }

    while($row4 = mysqli_fetch_assoc($allSupplierQuery))
    {
        $supplierAmount = $supplierAmount+1;
    }
?>
<body>
<div class="container">
    <a href="AR2-Main.php" style="color:seagreen;border-bottom: 3px solid seagreen">Home</a>
    <a href="AR2-Stock.php">Stock</a>
    <a href="#" onclick="window.open('AR-Bill.php')">Bill</a>
    <a href="AR2-Customer.php">Customer</a>
    <a href="AR2-Supplier.php">Supplier</a>
    <a href="AR2-Sales.php">Sales</a>
    <a href="AR2-SalesReport.php">Sales Report</a>
    <a href="" onclick="showProfile()"><?php session_start(); echo $_SESSION["user"];?></a>
    <a href="AR2-Signup.php">Create User</a>
    <a href="AR2-userDestroy.php">Logout</a>
</div>
<div class="container1">
    <label>AR2</label>
</div>
<div class="profileDetails" id="profile">
    <div style="text-align:center">
        <center>
            <?php
            $username = $_SESSION["loginuser"];

            $selectUserDetails="SELECT * FROM user WHERE username='$username'";

            $gotAll = $con->query($selectUserDetails);
            $row5 = mysqli_fetch_assoc($gotAll);

            ?>
            <form method="POST" action="AR2-Main.php">
                <input type="text" name="firstname" value="<?php echo $row5["firstname"];?>"><br/>
                <input type="text" name="lastname" value="<?php echo $row5["lastname"];?>"><br/>
                <input type="text" name="username" value="<?php echo $row5["username"];?>"><br/>
                <input type="email" name="email" value="<?php echo $row5["email"];?>"><br/>
                <input type="text" name="contactno" value="<?php echo $row5["contactno"];?>"><br/>
                <input type="text" hidden name="accountt" value="<?php echo $row5["accountype"];?>">
                <input type="password" name="password" value="<?php echo $row5["password"];?>"><br/>
                <input type="submit" name="btnSubmit" value="Update profile">
            </form>
        </center>
        <button onclick="hideProfile()">Hide Profile</button>
    </div>
    <?php

        if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["contactno"]) && isset($_POST["password"]) && isset($_POST["accountt"]))
        {
            $fname = $_POST["firstname"];
            $lname = $_POST["lastname"];
            $uname = $_POST["username"];
            $email = $_POST["email"];
            $contactno = $_POST["contactno"];
            $pass = $_POST["password"];
            $accountype = $_POST["accountt"];
        }

        if(isset($_POST["btnSubmit"]))
        {
            $updateUser = "UPDATE user SET firstname='$fname',lastname='$lname',email='$email',contactno='$contactno',password='$pass',accountype='$accountype' WHERE username='$uname'";

            if(mysql_query($updateUser))
            {
                echo '<script>';
                echo 'alert("Account Updated Successfully...")';
                echo '</script>';
            }
            else
            {
                echo '<script>';
                echo 'alert("Error Occured...")';
                echo '</script>';
            }
        }
    ?>
</div>
<div class="main">
    <label>Dashboard</label>
    <label><?php ;?></label>
</div>
<hr>
<br/>
<div class="subContainer" style="background-image:url(CSS/Icons/orders.png);background-size:100px;background-repeat: no-repeat">
    <label>Stock</label>
    <br/><br/>
    <label>Rs: <?php echo $stockAmount;?></label>
</div>
<div class="subContainer" style="background-image:url(CSS/Icons/orders.png);background-size:100px;background-repeat: no-repeat">
    <label>Sales</label>
    <br/><br/>
    <label>Rs: <?php echo $salesAmount;?></label>
</div>
<div class="subContainer" style="background-image:url(CSS/Icons/orders.png);background-size:100px;background-repeat: no-repeat">
    <label>Supplier</label>
    <br/><br/>
    <label>Total: <?php echo $supplierAmount;?></label>
</div>
<div class="subContainer" style="background-image:url(CSS/Icons/orders.png);background-size:100px;background-repeat: no-repeat">
    <label>Customer</label>
    <br/><br/>
    <label>Total: <?php echo $customerAmount;?></label>
</div>
<div>
<table class="tab" cellpadding="10">
    <tr>
        <th>Stock ID</th>
        <th>Stock Name</th>
        <th>Quantity</th>
    <tr/>
    <?php
        $selectAllStock="SELECT * FROM stock";

        $selected= $con->query($selectAllStock);

        while($row = mysqli_fetch_assoc($selected))
        {
            ?>
            <tr>
                <td><?php echo $row["stockid"];?></td>
                <td><?php echo $row["stockname"];?></td>
                <td><?php echo $row["quantity"];?></td>
            </tr>
            <?php
        }
    ?>
</table>
<table class="tab1" cellpadding="10">
    <tr>
        <th>Customer Name</th>
        <th>Credit Amount</th>
        <th>Paid Amount</th>
        <th>Payment Date</th>
    </tr>
    <tr>
        <?php
        $selectAllCustomer="SELECT * FROM customer WHERE amountobepaid>0";

        $selectedCustomer = $con->query($selectAllCustomer);


        while($row1 = mysqli_fetch_assoc($selectedCustomer))
        {
        ?>
    <tr>
        <td><?php echo $row1["customername"]; ?></td>
        <td><?php echo $row1["amountobepaid"]; ?></td>
        <td><?php echo $row1["amountpaid"]; ?></td>
        <td><?php echo $row1["paymentdate"]; ?></td>
    </tr>
    <?php
    }
    ?>
    </tr>
</table>
</div>
<br/><br/><br/><br/>
<footer style="position: relative;bottom:0;left:0;width:100%;margin-top:10px">
    <p style="padding-right:10px">Powered by Codesoft</p>
</footer>
</body>
</html>
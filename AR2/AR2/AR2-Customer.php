<?php
require "AR2-serverConnection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
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
        .subContainer label
        {
            font-size: 24px;
            color:white;
        }
        th
        {
            color:white;
            font-size:18px;
            padding:10px;
        }
        .tab
        {
            margin-top:10px;
            border:0.5px solid seagreen;
        }
        td
        {
            padding-left:10px;
        }
        input[type=text],input[type=email],textarea,input[type=date]
        {
            background-color: transparent;
            border:none;
            box-sizing: border-box;
            outline:none;
            padding:10px;
            width:100%;
            transition-duration:1.0s;
        }
        input[type=text]:hover,input[type=email]:hover,textarea:hover,input[type=date]:hover
        {
            border-bottom:1px solid seagreen;
        }
        input[type=submit]
        {
            border:2px solid seagreen;
            outline: none;
            padding:10px;
            border-radius: 5px;
            background-color: transparent;
            transition-duration: 1.0s;
        }
        input[type=submit]:hover
        {

            background-color: seagreen;
            color:white;
        }
        .newForm input[type=text], .newForm input[type=email],. newForm textarea
        {
            background-color: transparent;
            border:none;
            border-bottom:1px solid black;
            box-sizing: border-box;
            outline:none;
            padding:10px;
            width:100%;
            transition-duration:1.0s;
        }
        .newForm input[type=text]:hover, .newForm input[type=email]:hover, .newForm textarea:hover
        {
            border-bottom:1px solid seagreen;
        }
        input[type=search]
        {
            border:2px solid seagreen;
            padding:10px;
            border-radius:5px;
            outline:none;
            width:100%;
            transition-duration: 1.0s;
        }
        .moreInfo td
        {
            font-size:20px;
        }
    </style>
    <script type="text/javascript">
        document.getElementById("dat").value='Hello World';
    </script>
</head>
<body>
<div class="container">
    <a href="AR2-Main.php">Home</a>
    <a href="AR2-Stock.php">Stock</a>
    <a href="">Bill</a>
    <a href="AR2-Customer.php" style="color:seagreen;border-bottom: 3px solid seagreen">Customer</a>
    <a href="AR2-Supplier.php">Supplier</a>
    <a href="AR2-Sales.php">Sales</a>
    <a href="AR2-SalesReport.php">Sales Report</a>
    <a href=""><?php session_start(); echo $_SESSION["user"];?></a>
    <a href="AR2-userDestroy.php">Logout</a>
</div>
<div class="container1">
    <label>AR2</label>
</div>
<div class="main">
    <label>Customer</label>
    <label id="dat" style="float:right"></label>
</div>
<hr/>
<br/>
<?php
    if(isset($_POST["btnload"]))
    {
        $info=$_POST["infoSearch"];
        $selectAllCustomer = "SELECT * FROM customer WHERE customerid='$info'";

        $selectedCustomer = $con->query($selectAllCustomer);

        while ($row = mysqli_fetch_assoc($selectedCustomer))
        {
    ?>
            <table class="moreInfo">
                <tr>
                    <td>More Information about: <?php echo $row["customername"];?></td>
                    <td>Credit Amount: <?php echo $row["amountobepaid"];?></td>
                    <td>Amount Paid: <?php echo $row["amountpaid"];?></td>
                    <td>Last Shopped Date: <?php echo $row["lastdate"];?></td>
                    <td>Payment Settlement Date: <?php echo $row["paymentdate"];?></td>
                </tr>
            </table>
<?php
        }
    }
?>
<br/>
<?php
if(isset($_POST["cusid"]) && isset($_POST["cusname"]) && isset($_POST["shopname"]) && isset($_POST["address"]) && isset($_POST["email"]) && isset($_POST["con1"]) && isset($_POST["con2"]) && isset($_POST["amounttpad"]) && isset($_POST["amountpad"]) && isset($_POST["ldate"]) && isset($_POST["pdate"]))
{
    $custid=$_POST["cusid"];
    $custname=$_POST["cusname"];
    $shop=$_POST["shopname"];
    $add=$_POST["address"];
    $ema=$_POST["email"];
    $amtpad=$_POST["amounttpad"];
    $ampad=$_POST["amountpad"];
    $cont1=$_POST["con1"];
    $cont2=$_POST["con2"];
    $lastd=$_POST["ldate"];
    $paydate=$_POST["pdate"];
}

if(isset($_POST["btnupdate"]))
{
    $updateQuery="UPDATE customer SET customername='$custname',shopname='$shop',address='$add',email='$ema',contactno1='$cont1',contactno2='$cont2',amountobepaid='$amtpad',amountpaid='$ampad',lastdate='$lastd',paymentdate='$paydate' WHERE customerid='$custid'";

    if($con->query($updateQuery))
    {
        echo '<script>';
        echo $custname.'alert("Details Updated Successfully...")';
        echo '</script>';
    }
    else
    {
        echo '<script>';
        echo 'alert("Error occured while updating...")';
        echo '</script>';
    }
}
else if(isset($_POST["btndelete"]))
{
    $deleteQuery="DELETE FROM customer WHERE customerid='$custid'";

    if($con->query($deleteQuery))
    {
        echo '<script>';
        echo $custname.'alert("Details Deleted Successfully...")';
        echo '</script>';
    }
    else
    {
        echo '<script>';
        echo 'alert("Error occured while deleting...")';
        echo '</script>';
    }
}
else if(isset($_POST["btnadd"]))
{
    $custid1=$_POST["cusid1"];
    $custname1=$_POST["cusname1"];
    $shop1=$_POST["shopname1"];
    $add1=$_POST["address1"];
    $ema1=$_POST["email1"];
    $cont11=$_POST["con11"];
    $cont21=$_POST["con21"];

    $insertQuery="INSERT INTO customer VALUES('$custid1','$custname1','$shop1','$add1','$ema1','$cont11','$cont21','0','0','2017-01-01','2017-01-01')";

    if($con->query($insertQuery))
    {
        echo '<script>';
        echo $custname1.'alert("Details Deleted Successfully...")';
        echo '</script>';
    }
    else
    {
        echo '<script>';
        echo 'alert("Error occured while Adding...")';
        echo '</script>';
    }
}
?>
<form method="POST" action="AR2-Customer.php">
    <input type="search" placeholder="Enter Customer Name to find his/her Information" name="infoSearch"><br/><br/>
    <center>
        <input type="submit" style="width:10%;font-size:18px" value="Search" name="btnsearch">
        <input type="submit" style="width:10%;font-size:18px" value="Load" name="btnload">
        <input type="submit" style="width:10%;font-size:18px" value="Refresh" name="btnrefresh">
    </center>
</form>
<br/>
<table class="tab">
    <tr style="background-color: seagreen">
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>Shop Name</th>
        <th colspan="3">Address</th>
        <th>Email</th>
        <th>Contact No 1</th>
        <th>Contact No 2</th>
        <th colspan="2">Controls</th>
    <tr/>
    <tr>
        <form class="newForm" method="POST" action="AR2-Customer.php">
            <td>
                <input type="text" placeholder="Enter Customer ID" name="cusid1">
            </td>
            <td>
                <input type="text" placeholder="Enter Customer Name" name="cusname1">
            </td>
            <td>
                <input type="text" placeholder="Enter Shop Name" name="shopname1">
            </td>
            <td colspan="3">
                <textarea placeholder="Enter Address" name="address1"></textarea>
            </td>
            <td>
                <input type="email" placeholder="Enter E-mail" name="email1">
            </td>
            <td>
                <input type="text" placeholder="Enter Contact No 1" name="con11">
            </td>
            <td>
                <input type="text" placeholder="Enter Contact No 2" name="con21">
            </td>
            <td colspan="2">
                <input style="width:100%" type="submit" value="Add New Details" name="btnadd">
            </td>
        </form>
    </tr>
    <?php
    if(isset($_POST["btnsearch"]))
    {
        $info=$_POST["infoSearch"];
        $selectAllCustomer = "SELECT * FROM customer WHERE customername like '%$info%'";

        $selectedCustomer = $con->query($selectAllCustomer);

        while ($row = mysqli_fetch_assoc($selectedCustomer))
        {
            ?>
            <tr>
                <form method="POST" action="AR2-Customer.php">
                    <td>
                        <input type="text" value="<?php echo $row["customerid"]; ?>" name="cusid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["customername"]; ?>" name="cusname">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["shopname"]; ?>" name="shopname">
                    </td>
                    <td colspan="3">
                        <textarea cols="10" name="address"><?php echo $row["address"]; ?></textarea>
                    </td>
                    <td>
                        <input type="email" value="<?php echo $row["email"]; ?>" name="email">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["contactno1"]; ?>" name="con1">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["contactno2"]; ?>" name="con2">
                        <input type="text" hidden name="amounttpad" value="<?php echo $row["amountobepaid"]; ?>">
                        <input type="text" hidden name="amountpad" value="<?php echo $row["amountpaid"]; ?>">
                        <input type="date" hidden name="ldate" value="<?php echo $row["lastdate"]; ?>">
                        <input type="date" hidden name="pdate" value="<?php echo $row["paymentdate"]; ?>">
                    <td>
                        <input type="submit" name="btnupdate" value="Update">
                    </td>
                    <td>
                        <input type="submit" name="btndelete" value="Delete">
                    </td>
                </form>
            </tr>
            <?php
        }
    }
    else if(isset($_POST["btnrefresh"]))
    {
        $selectAllCustomer = "SELECT * FROM customer";

        $selectedCustomer = $con->query($selectAllCustomer);

        while ($row = mysqli_fetch_assoc($selectedCustomer)) {
            ?>
            <tr>
                <form method="POST" action="AR2-Customer.php">
                    <td>
                        <input type="text" value="<?php echo $row["customerid"]; ?>" name="cusid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["customername"]; ?>" name="cusname">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["shopname"]; ?>" name="shopname">
                    </td>
                    <td colspan="3">
                        <textarea cols="10" name="address"><?php echo $row["address"]; ?></textarea>
                    </td>
                    <td>
                        <input type="email" value="<?php echo $row["email"]; ?>" name="email">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["contactno1"]; ?>" name="con1">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["contactno2"]; ?>" name="con2">
                        <input type="text" hidden name="amounttpad" value="<?php echo $row["amountobepaid"]; ?>">
                        <input type="text" hidden name="amountpad" value="<?php echo $row["amountpaid"]; ?>">
                        <input type="date" hidden name="ldate" value="<?php echo $row["lastdate"]; ?>">
                        <input type="date" hidden name="pdate" value="<?php echo $row["paymentdate"]; ?>">
                    <td>
                        <input type="submit" name="btnupdate" value="Update">
                    </td>
                    <td>
                        <input type="submit" name="btndelete" value="Delete">
                    </td>
                </form>
            </tr>
            <?php
        }
    }
    else
    {
        $selectAllCustomer = "SELECT * FROM customer";

        $selectedCustomer = $con->query($selectAllCustomer);

        while ($row = mysqli_fetch_assoc($selectedCustomer))
        {
            ?>
            <tr>
                <form method="POST" action="AR2-Customer.php">
                    <td>
                        <input type="text" value="<?php echo $row["customerid"]; ?>" name="cusid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["customername"]; ?>" name="cusname">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["shopname"]; ?>" name="shopname">
                    </td>
                    <td colspan="3">
                        <textarea cols="10" name="address"><?php echo $row["address"]; ?></textarea>
                    </td>
                    <td>
                        <input type="email" value="<?php echo $row["email"]; ?>" name="email">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["contactno1"]; ?>" name="con1">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["contactno2"]; ?>" name="con2">
                        <input type="text" hidden name="amounttpad" value="<?php echo $row["amountobepaid"]; ?>">
                        <input type="text" hidden name="amountpad" value="<?php echo $row["amountpaid"]; ?>">
                        <input type="date" hidden name="ldate" value="<?php echo $row["lastdate"]; ?>">
                        <input type="date" hidden name="pdate" value="<?php echo $row["paymentdate"]; ?>">
                    <td>
                        <input type="submit" name="btnupdate" value="Update">
                    </td>
                    <td>
                        <input type="submit" name="btndelete" value="Delete">
                    </td>
                </form>
            </tr>
            <?php
        }
    }
    ?>
</table>
<br/>
<footer style="position: relative;bottom:0;left:0;width:100%;text-align:right">
    <p style="padding-right:10px">Powered by Codesoft</p>
</footer>
</body>
</html>
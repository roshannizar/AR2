<?php
require "AR2-serverConnection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AR2 - Supplier</title>
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
    <a href="#" onclick="window.open('AR-Bill.php')">Bill</a>
    <a href="AR2-Customer.php">Customer</a>
    <a href="AR2-Supplier.php" style="color:seagreen;border-bottom: 3px solid seagreen">Supplier</a>
    <a href="AR2-Sales.php">Sales</a>
    <a href="AR2-SalesReport.php">Sales Report</a>
    <a href=""><?php session_start(); echo $_SESSION["user"];?></a>
    <a href="AR2-userDestroy.php">Logout</a>
</div>
<div class="container1">
    <label>AR2</label>
</div>
<div class="main">
    <label>Supplier</label>
    <label id="dat" style="float:right"></label>
</div>
<hr/>
<br/>
<br/>
<?php
if(isset($_POST["supid"]) && isset($_POST["supname"]) && isset($_POST["shopname"]) && isset($_POST["address"]) && isset($_POST["email"]) && isset($_POST["con1"]) && isset($_POST["con2"]))
{
    $supid=$_POST["supid"];
    $supname=$_POST["supname"];
    $shop=$_POST["shopname"];
    $add=$_POST["address"];
    $ema=$_POST["email"];
    $cont1=$_POST["con1"];
    $cont2=$_POST["con2"];
}

if(isset($_POST["btnupdate"]))
{
    $updateQuery="UPDATE supplier SET suppliername='$supname',shopname='$shop',address='$add',email='$ema',contactno1='$cont1',contactno2='$cont2' WHERE supplierid='$supid'";

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
    $deleteQuery="DELETE FROM supplier WHERE supplierid='$supid'";

    if($con->query($deleteQuery))
    {
        echo '<script>';
        echo $supname.'alert("Details Deleted Successfully...")';
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
    $supid1=$_POST["supid1"];
    $supname1=$_POST["supname1"];
    $shop1=$_POST["shopname1"];
    $add1=$_POST["address1"];
    $ema1=$_POST["email1"];
    $cont11=$_POST["con11"];
    $cont21=$_POST["con21"];

    $insertQuery="INSERT INTO supplier VALUES('$supid1','$supname1','$shop1','$add1','$ema1','$cont11','$cont21')";

    if($con->query($insertQuery))
    {
        echo '<script>';
        echo $supname1.'alert("Details Added Successfully...")';
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
<form method="POST" action="AR2-Supplier.php">
    <input type="search" placeholder="Enter Supplier Name to find his/her Information" name="infoSearch"><br/><br/>
    <center>
        <input type="submit" style="width:10%;font-size:18px" value="Search" name="btnsearch">
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
        <form class="newForm" method="POST" action="AR2-Supplier.php">
            <td>
                <input type="text" placeholder="Enter Customer ID" name="supid1">
            </td>
            <td>
                <input type="text" placeholder="Enter Customer Name" name="supname1">
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
        $selectAllSupplier = "SELECT * FROM supplier WHERE suppliername like '%$info%'";

        $selectedSupplier = $con->query($selectAllSupplier);

        while ($row = mysqli_fetch_assoc($selectedSupplier)) {
            ?>
            <tr>
                <form method="POST" action="AR2-Supplier.php">
                    <td>
                        <input type="text" value="<?php echo $row["supplierid"]; ?>" name="supid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["suppliername"]; ?>" name="supname">
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
        $selectAllSupplier = "SELECT * FROM supplier";

        $selectedSupplier = $con->query($selectAllSupplier);

        while ($row = mysqli_fetch_assoc($selectedSupplier)) {
            ?>
            <tr>
                <form method="POST" action="AR2-Supplier.php">
                    <td>
                        <input type="text" value="<?php echo $row["supplierid"]; ?>" name="supid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["suppliername"]; ?>" name="supname">
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
        $selectAllSupplier = "SELECT * FROM supplier";

        $selectedSupplier = $con->query($selectAllSupplier);

        while ($row = mysqli_fetch_assoc($selectedSupplier)) {
            ?>
            <tr>
                <form method="POST" action="AR2-Supplier.php">
                    <td>
                        <input type="text" value="<?php echo $row["supplierid"]; ?>" name="supid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["suppliername"]; ?>" name="supname">
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
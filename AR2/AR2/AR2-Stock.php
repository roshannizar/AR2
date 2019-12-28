<?php
require "AR2-serverConnection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AR2 - Stock</title>
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
</head>
<body>
<div class="container">
    <a href="AR2-Main.php">Home</a>
    <a href="AR2-Stock.php" style="color:seagreen;border-bottom: 3px solid seagreen">Stock</a>
    <a href="#" onclick="window.open('AR-Bill.php')">Bill</a>
    <a href="AR2-Customer.php">Customer</a>
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
    <label>Stock</label>
    <label id="dat" style="float:right"></label>
</div>
<hr/>
<br/>

<br/>
<?php
if(isset($_POST["stockid"]) && isset($_POST["stockname"]) && isset($_POST["description"]) && isset($_POST["supplierid"]) && isset($_POST["quantity"]) && isset($_POST["price"]))
{
    $stockid=$_POST["stockid"];
    $stockname=$_POST["stockname"];
    $description=$_POST["description"];
    $supplierid=$_POST["supplierid"];
    $quantity=$_POST["quantity"];
    $price=$_POST["price"];
}

if(isset($_POST["btnupdate"]))
{
    $updateQuery="UPDATE stock SET stockname='$stockname',description='$description',supplierid='$supplierid',quantity='$quantity',price='$price' WHERE stockid='$stockid'";

    if($con->query($updateQuery))
    {
        echo '<script>';
        echo $stockname.'alert("Details Updated Successfully...")';
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
    $deleteQuery="DELETE FROM stock WHERE stockid='$stockid'";

    if($con->query($deleteQuery))
    {
        echo '<script>';
        echo $stockname.'alert("Details Deleted Successfully...")';
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
    $stockid=$_POST["stockid"];
    $stockname=$_POST["stockname"];
    $description=$_POST["description"];
    $supplierid=$_POST["supplierid"];
    $quantity=$_POST["quantity"];
    $price=$_POST["price"];

    $insertQuery="INSERT INTO stock VALUES('$stockid','$stockname','$description','$supplierid','$quantity','$price')";

    if($con->query($insertQuery))
    {
        echo '<script>';
        echo $stockname.'alert("Details added Successfully...")';
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
<form method="POST" action="AR2-Stock.php">
    <input type="search" placeholder="Enter Stock Name to find his/her Information" name="infoSearch"><br/><br/>
    <center>
        <input type="submit" style="width:10%;font-size:18px" value="Search" name="btnsearch">
        <input type="submit" style="width:10%;font-size:18px" value="Refresh" name="btnrefresh">
    </center>
</form>
<br/>
<table class="tab">
    <tr style="background-color: seagreen">
        <th>Stock ID</th>
        <th>Stock Name</th>
        <th colspan="3">Description</th>
        <th>Supplier ID</th>
        <th>Quantity</th>
        <th>Price</th>
        <th colspan="2">Controls</th>
    <tr/>
    <tr>
        <form class="newForm" method="POST" action="AR2-Stock.php">
            <td>
                <input type="text" placeholder="Enter Stock ID" name="stockid">
            </td>
            <td>
                <input type="text" placeholder="Enter Stock Name" name="stockname">
            </td>
            <td colspan="3">
                <textarea placeholder="Enter Description" name="description"></textarea>
            </td>
            <td>
                <input list="supplierid" name="supplierid">
                <datalist id="supplierid">
                    <?php
                    $selectAllSupplier = "SELECT * FROM supplier";

                    $selectedSupplier = $con->query($selectAllSupplier);

                    while($row4 = mysqli_fetch_assoc($selectedSupplier))
                    {
                        ?>
                            <option value="<?php echo $row4["supplierid"];?>">
                    <?php
                    }
                    ?>
                </datalist>
            </td>
            <td>
                <input type="text" placeholder="Enter Quantity" name="quantity">
            </td>
            <td>
                <input type="text" placeholder="Enter Price" name="price">
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
        $selectAllStock= "SELECT * FROM stock WHERE stockname like '%$info%'";

        $selectedStock = $con->query($selectAllStock);

        while ($row = mysqli_fetch_assoc($selectedStock)) {
            ?>
            <tr>
                <form method="POST" action="AR2-Stock.php">
                    <td>
                        <input type="text" value="<?php echo $row["stockid"]; ?>" name="stockid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["stockname"]; ?>" name="stockname">
                    </td>
                    <td colspan="3">
                        <textarea cols="10" name="description"><?php echo $row["description"]; ?></textarea>
                    </td>
                    <td>
                        <input list="supplierid" name="supplierid">
                        <datalist id="supplierid">
                            <?php
                            $selectAllSupplier = "SELECT * FROM supplier";

                            $selectedSupplier = $con->query($selectAllSupplier);

                            while($row4 = mysqli_fetch_assoc($selectedSupplier))
                            {
                            ?>
                            <option value="<?php echo $row4["supplierid"];?>">
                                <?php
                                }
                                ?>
                        </datalist>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["quantity"]; ?>" name="quantity">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["price"]; ?>" name="price">
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
        $selectAllStock = "SELECT * FROM stock";

        $selectedStock = $con->query($selectAllStock);

        while ($row = mysqli_fetch_assoc($selectedStock)) {
            ?>
            <tr>
                <form method="POST" action="AR2-Stock.php">
                    <td>
                        <input type="text" value="<?php echo $row["stockid"]; ?>" name="stockid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["stockname"]; ?>" name="stockname">
                    </td>
                    <td colspan="3">
                        <textarea cols="10" name="description"><?php echo $row["description"]; ?></textarea>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["supplierid"]; ?>" name="supplierid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["quantity"]; ?>" name="quantity">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["price"]; ?>" name="price">
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
        $selectAllStock = "SELECT * FROM stock";

        $selectedStock = $con->query($selectAllStock);

        while ($row = mysqli_fetch_assoc($selectedStock)) {
            ?>
            <tr>
                <form method="POST" action="AR2-Stock.php">
                    <td>
                        <input type="text" value="<?php echo $row["stockid"]; ?>" name="stockid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["stockname"]; ?>" name="stockname">
                    </td>
                    <td colspan="3">
                        <textarea cols="10" name="description"><?php echo $row["description"]; ?></textarea>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["supplierid"]; ?>" name="supplierid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["quantity"]; ?>" name="quantity">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["price"]; ?>" name="price">
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
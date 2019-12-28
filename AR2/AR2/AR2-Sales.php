<?php
require "AR2-serverConnection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AR2 - Sales</title>
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
    <a href="AR2-Supplier.php">Supplier</a>
    <a href="AR2-Sales.php" style="color:seagreen;border-bottom: 3px solid seagreen">Sales</a>
    <a href="AR2-SalesReport.php">Sales Report</a>
    <a href=""><?php session_start(); echo $_SESSION["user"];?></a>
    <a href="AR2-userDestroy.php">Logout</a>
</div>
<div class="container1">
    <label>AR2</label>
</div>
<div class="main">
    <label>Sales</label>
    <label id="dat" style="float:right"></label>
</div>
<hr/>
<br/>
<br/>
<?php
if(isset($_POST["salesid"]) && isset($_POST["stockid"]) && isset($_POST["customerid"]) && isset($_POST["quantity"]) && isset($_POST["price"]) && isset($_POST["amount"]) && isset($_POST["dtpdate"]))
{
    $salesid=$_POST["salesid"];
    $stockid=$_POST["stockid"];
    $customerid=$_POST["customerid"];
    $quantity=$_POST["quantity"];
    $price=$_POST["price"];
    $amount=$_POST["amount"];
    $dtpdate=$_POST["dtpdate"];
}

if(isset($_POST["btnupdate"]))
{
    $updateQuery="UPDATE sales SET stockid='$stockid',customerid='$customerid',quantity='$quantity',price='$price',amount='$amount',date='$dtpdate' WHERE salesid='$salesid'";

    if($con->query($updateQuery))
    {
        echo '<script>';
        echo $salesid.'alert("Details Updated Successfully...")';
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
    $deleteQuery="DELETE FROM sales WHERE salesid='$salesid'";

    if($con->query($deleteQuery))
    {
        echo '<script>';
        echo $salesid.'alert("Details Deleted Successfully...")';
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
    $salesid=$_POST["salesid"];
    $stockid=$_POST["stockid"];
    $customerid=$_POST["customerid"];
    $quantity=$_POST["quantity"];
    $price=$_POST["price"];
    $amount=$_POST["amount"];
    $dtpdate=$_POST["dtpdate"];
    $invoiceno=$_POST["invoiceno"];
    $ddate=date('m/d/Y');

    $insertQuery="INSERT INTO sales VALUES('$salesid','$stockid','$customerid','$quantity','$price','$amount','$dtpdate')";
    $insertBillQuery = "INSERT INTO bill VALUES('$stockid','$customerid','$invoiceno','$ddate','$dtpdate','$quantity','$price','$amount')";

    if($con->query($insertQuery))
    {
        echo '<script>';
        echo $salesid.'alert("Details Added Successfully...")';
        echo '</script>';

        if($con->query($insertBillQuery))
        {
            echo '<script>';
            echo $salesid.'alert("Send to bill Successfully...")';
            echo '</script>';
        }
        else
        {
            echo '<script>';
            echo 'alert("Error occured while sending to bill...")';
            echo '</script>';
        }
    }
    else
    {
        echo '<script>';
        echo 'alert("Error occured while Adding...")';
        echo '</script>';
    }
}
?>
<form method="POST" action="AR2-Sales.php">
    <input type="search" placeholder="Enter Sales ID to find Information" name="infoSearch"><br/><br/>
    <center>
        <input type="submit" style="width:10%;font-size:18px" value="Search" name="btnsearch">
        <input type="submit" style="width:10%;font-size:18px" value="Refresh" name="btnrefresh">
        <input type="submit" style="width:10%;font-size:18px" value="New Bill" name="btnnewbill">
    </center>
</form>
<br/>
<table class="tab">
    <tr style="background-color: seagreen">
        <th>Sales ID</th>
        <th>Stock ID</th>
        <th>Customer ID</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Amount</th>
        <th>Date</th>
        <th colspan="2">Controls</th>
    <tr/>
    <tr>
        <form class="newForm" method="POST" action="AR2-Sales.php">
            <td>
                <input type="text" placeholder="Enter Sales ID" name="salesid">
                <input type="text" hidden name="invoice">
            </td>
            <td>
                <input list="stockid" name="stockid">
                <datalist id="stockid">
                    <?php
                    $selectAllStock = "SELECT * FROM stock";

                    $selectedStock = $con->query($selectAllStock);

                    while($row5 = mysqli_fetch_assoc($selectedStock))
                    {
                    ?>
                    <option value="<?php echo $row5["stockid"];?>">
                        <?php
                        }
                        ?>
                </datalist>
            </td>
            <td>
                <input list="customerid" name="customerid">
                <datalist id="customerid">
                    <?php
                    $selectAllCustomer = "SELECT * FROM customer";

                    $selectedStock = $con->query($selectAllCustomer);

                    while($row4 = mysqli_fetch_assoc($selectedStock))
                    {
                    ?>
                    <option value="<?php echo $row4["customerid"];?>">
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
            <td>
                <input type="text" placeholder="Enter Amount" name="amount">
            </td>
            <td>
                <input type="date"  name="dtpdate">
            </td>
            <td colspan="2">
                <input style="width:100%" type="submit" value="Add New Details/Send to Bill" name="btnadd">
            </td>
        </form>
    </tr>
    <?php
    if(isset($_POST["btnsearch"]))
    {
        $info=$_POST["infoSearch"];
        $selectAllSales = "SELECT * FROM sales WHERE salesid='$info'";

        $selectedSales = $con->query($selectAllSales);

        while ($row = mysqli_fetch_assoc($selectedSales))
        {
            ?>
            <tr>
                <form method="POST" action="AR2-Sales.php">
                    <td>
                        <input type="text" value="<?php echo $row["salesid"]; ?>" name="salesid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["stockid"]; ?>" name="stockid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["customerid"]; ?>" name="customerid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["quantity"]; ?>" name="quantity">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["price"]; ?>" name="price">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["amount"]; ?>" name="amount">
                    </td>
                    <td>
                        <input type="date" value="<?php echo $row["date"]; ?>" name="dtpdate">
                    </td>
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
        $selectAllSales = "SELECT * FROM sales";

        $selectedSales = $con->query($selectAllSales);

        while ($row = mysqli_fetch_assoc($selectedSales))
        {
            ?>
            <tr>
                <form method="POST" action="AR2-Sales.php">
                    <td>
                        <input type="text" value="<?php echo $row["salesid"]; ?>" name="salesid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["stockid"]; ?>" name="stockid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["customerid"]; ?>" name="customerid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["quantity"]; ?>" name="quantity">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["price"]; ?>" name="price">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["amount"]; ?>" name="amount">
                    </td>
                    <td>
                        <input type="date" value="<?php echo $row["date"]; ?>" name="dtpdate">
                    </td>
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
    else if(isset($_POST["btnnewbill"]))
    {
        $deleteAllNewBill = "DELETE FROM bill";

        if($con->query($deleteAllNewBill))
        {
            echo '<script>';
            echo 'alert("New bill On process...")';
            echo '</script>';
        }
        else
        {
            echo '<script>';
            echo 'alert("Error when creating new bill...")';
            echo '</script>';
        }
    }
    else
    {
        $selectAllSales = "SELECT * FROM sales";

        $selectedSales = $con->query($selectAllSales);

        while ($row = mysqli_fetch_assoc($selectedSales))
        {
            ?>
            <tr>
                <form method="POST" action="AR2-Sales.php">
                    <td>
                        <input type="text" value="<?php echo $row["salesid"]; ?>" name="salesid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["stockid"]; ?>" name="stockid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["customerid"]; ?>" name="customerid">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["quantity"]; ?>" name="quantity">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["price"]; ?>" name="price">
                    </td>
                    <td>
                        <input type="text" value="<?php echo $row["amount"]; ?>" name="amount">
                    </td>
                    <td>
                        <input type="date" value="<?php echo $row["date"]; ?>" name="dtpdate">
                    </td>
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
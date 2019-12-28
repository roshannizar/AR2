<?php
    require 'AR2-serverConnection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AR2 - Bill</title>
    <style>
        body
        {
            background-image: url(AR2-AUTOMOTIVEwatermark.png);
            background-size: 100%;
            background-repeat: no-repeat;
        }
        .heading
        {
            width:100%;
            text-align: center;
            margin-top:20px;
        }
        .printInvoice
        {
            background-color: transparent;
            outline:none;
            width:100%;
            font-size:20px;
            font-family: calibri;
            padding:10px;
            border:2px solid black;
        }
        .printInvoice:hover
        {
            color:transparent;
            border:2px solid transparent;
        }
        .billTableDetails
        {
            width:100%;
            margin-top:50px;
            text-align:left;
        }
        .billTable
        {
            margin-top:30px;
        }
        .details
        {
            float:left;
            width:40%;
            padding-left:20px;
        }
        .details1
        {
            float:right;
            width:25%;
            margin-left:220px;
        }
    </style>
</head>
<body>
    <?php
        $selectAllBill1="SELECT * FROM stock s,bill b,customer c WHERE s.stockid=b.stockid AND c.customerid=b.customerid";
        $selectValues1 = $con->query($selectAllBill1);
        $row1 = mysqli_fetch_assoc($selectValues1)
    ?>
    <div class="heading">
        <img src="images/ar2%20logo.png" style="width:10%">
        <h1>AR2 - AUTOMOTIVES</h1>
        <h4>INVOICE</h4>
        <h4>Head Office - 162/32 Dematagoda Road Colombo - 09</h4>
        <label>Mobile: 0772001913</label><br/>
        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 0752001913</label>
    </div>
    <br/>
    <div class="details">
        <label>Customer Name: <?php echo $row1["customername"];?></label>
        <br/><br/>
        <label>Customer Address: <?php echo $row1["address"];?></label>
    </div>
    <div class="details1">
        <label>Invoice No: <?php echo $row1["invoiceno"];?></label>
        <br/><br/>
        <label>Invoice Date: <?php echo $row1["invoicedate"];?></label>
    </div>
    <div class="billTable">
        <br/>
        <table class="billTableDetails" cellspacing="10" cellpadding="10">
            <tr>
                <th>Part Number</th>
                <th colspan="2">Description</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total Amount</th>
            </tr>
                <?php
                    $selectAllBill="SELECT * FROM stock s,bill b,customer c WHERE s.stockid=b.stockid AND c.customerid=b.customerid";
                    $selectValues = $con->query($selectAllBill);
                    while($row = mysqli_fetch_assoc($selectValues))
                    {
                        ?>
                        <tr>
                            <td><?php echo $row["stockid"];?></td>
                            <td colspan="2"><?php echo $row["description"];?></td>
                            <td><?php echo $row["unitprice"];?></td>
                            <td><?php echo $row["quantity"];?></php></td>
                            <td><?php echo $row["amount"];?></td>
                        </tr>
                <?php
                    }
                ?>
            <?php

                echo '
                    <tr>
                        <td></td>
                        <td colspan="2"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>';
            ?>
            <tr>
                <td></td>
                <td colspan="2"></td>
                <td></td>
                <?php
                    $netamount = 0;
                    $selectAllBill="SELECT * FROM stock s,bill b,customer c WHERE s.stockid=b.stockid AND c.customerid=b.customerid";
                    $selectValues = $con->query($selectAllBill);
                    while($row2 = mysqli_fetch_assoc($selectValues))
                    {
                        $netamount = $netamount+$row2["amount"];
                    }

                ?>
                <td>Net Amount: </td>
                <td id="netamountvalue"><?php echo $netamount;?></td>
            </tr>
        </table>
    </div>
    <br/>
    <div>
        <button class="printInvoice" onclick="window.print()">Print Invoice</button>
        <h5>Amount in words: <input type="text" style="border:none;outline:none;width:80%;"><label id="valuenumber"></label></h5>
        <h5>Email: asheef.aaa@gmail.com</h5>
        <br/><br/><br/>
    </div>
    <div class="details">
        <h5>--------------------------------</h5>
        <h5>Checked By</h5>
        <br/>
        <label>Printed on: <?php echo date('m/d/Y');?></label>
    </div>
    <div class="details1">
        <h5>---------------------------------</h5>
        <h5>Goods Received By</h5>
    </div>
    <br/>
    <div class="details1">
        <h5>Powered By CODESOFT</h5>
    </div>
</body>
</html>
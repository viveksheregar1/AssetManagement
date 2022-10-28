<?php include "logincheck.php" ?>
<?php include "BasicHtml-Js.php" ?>
<?php
    include 'connection.php';
    $qry="select * from assetdb where username='".$username."'";
    $result=$cn->query($qry);
    $row=$result->fetch_assoc();
    $total=intval($row['banks'])+intval($row['stocks'])+intval($row['crypto'])+intval($row['npa'])+intval($row['mutual']);
    echo "<center>
            <h1 style='border:2px solid black; border-radius:25px; width:200px;'>
                ₹".$total."
            </h1>
            <h3>Net Value</h3>
            <table style='font-size: 30px;'>
                <tr align='center'>
                    <td>Bank</td>
                    <td>:</td>
                    <td>₹".$row['banks']."</td>
                </tr>
                <tr align='center'>
                    <td>Stocks</td>
                    <td>:</td>
                    <td>₹".$row['stocks']."</td>
                </tr>
                <tr align='center'>
                    <td>Crypto</td>
                    <td>:</td>
                    <td>₹".$row['crypto']."</td>
                </tr>
                <tr align='center'>
                    <td>NPA</td>
                    <td>:</td>
                    <td>₹".$row['npa']."</td>
                </tr>
                <tr align='center'>
                    <td>Mutual Fund</td>
                    <td>:</td>
                    <td>₹".$row['mutual']."</td>
                </tr>
            </table>
            <br>
            <form action='calculate.php' method='post'>
                <button name='edit' class='btn btn-outline-dark'>Edit Data</button>
            </form><br>
            <a href='details.php'>
                <button id='details' class='btn btn-outline-dark'>See Asset Details</button>
            </a>
        </center>";
    $cn->close();
?>

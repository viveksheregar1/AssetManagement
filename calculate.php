<?php include "logincheck.php" ?>
<?php include 'BasicHtml-Js.php' ?>
    

<?php
    //for edit button
if(isset($_POST['edit']))
{
    include 'connection.php';
    $qry="select * from assetdb where username='".$username."'";
    $result=$cn->query($qry);
    $row=$result->fetch_assoc();
    echo '
        <center>
            <form name="calculateform" id="calculateform" action="" method="post">
                <table style="font-size: 30px;">
                    <tr align="center">
                        <td>Banks</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="banks" name="banks" value='.$row["banks"].'>
                        </td>
                    </tr>
                    <tr align="center">
                       <td>Stocks</td>
                       <td>:</td>
                        <td>
                            <input type="text" id="stocks" name="stocks" value='.$row["stocks"].'>
                        </td>
                    </tr>
                    <tr align="center">
                        <td >Crypto</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="crypto" name="crypto" value='.$row["crypto"].'>
                        </td>
                    </tr>
                    <tr align="center">
                        <td>NPA</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="npa" name="npa" value='.$row["npa"].'>
                        </td>
                    </tr>
                    <tr align="center">
                        <td>Mutual funds</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="mutual" name="mutual" value='.$row["mutual"].'>
                        </td>
                    </tr>
                    <tr align="center" id="hiddentablerow" style="visibility:hidden;">
                        <td>Total</td>
                        <td>:</td>
                        <td>
                            <h1 id="total"></h1>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="saveconfirmed" value="submit">
                <input type="number" id="hiddentotal" name="hiddentotal" style="visibility: hidden;" value="0">
                <br>
                <button type="button" id="save" name="save" class="btn btn-outline-dark" onClick="confirmsave()" style="width:100px; visibility: hidden;">SAVE</button><br><br>
            </form>
            <button id="calculate" class="btn btn-outline-dark" onClick="calculate()" style="width:200px;">CALCULATE</button>
        </center>';
    $cn->close();
}
else
{
    //for calculate button
    echo '
        <center>
            <form name="calculateform" id="calculateform" action="" method="post">
                <table style="font-size: 30px;">
                    <tr align="center">
                        <td>Banks</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="banks" name="banks" value="0">
                        </td>
                    </tr>
                    <tr align="center">
                       <td>Stocks</td>
                       <td>:</td>
                        <td>
                            <input type="text" id="stocks" name="stocks" value="0">
                        </td>
                    </tr>
                    <tr align="center">
                        <td >Crypto</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="crypto" name="crypto" value="0">
                        </td>
                    </tr>
                    <tr align="center">
                        <td>NPA</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="npa" name="npa" value="0">
                        </td>
                    </tr>
                    <tr align="center">
                        <td>Mutual funds</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="mutual" name="mutual" value="0">
                        </td>
                    </tr>
                    <tr align="center" id="hiddentablerow" style="visibility:hidden;">
                        <td>Total</td>
                        <td>:</td>
                        <td>
                            <h1 id="total"></h1>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="saveconfirmed" value="submit">
                <br>
                <button id="save" name="save" class="btn btn-outline-dark" onClick="confirmsave()" style="width:100px; visibility: hidden;">SAVE</button><br><br>
            </form>
            <button id="calculate" class="btn btn-outline-dark" onClick="calculate()" style="width:200px;">CALCULATE</button>
        </center>';
}
?>

<?php
    //save data
    if(isset($_POST['saveconfirmed']))
    {
        $banks=trim($_POST['banks']);
        $stocks=trim($_POST['stocks']);
        $crypto=trim($_POST['crypto']);
        $npa=trim($_POST['npa']);
        $mutual=trim($_POST['mutual']);
        try
        {
            include 'connection.php';
            $qry="update assetdb set banks='".$banks."',stocks='".$stocks."',crypto='".$crypto."',npa='".$npa."',mutual='".$mutual."' where username='".$username."'";
            $result=$cn->query($qry);
            if($result)
                echo "<script>
                        alert('Data Saved');
                        window.open('home.php','_self');
                    </script>";
        }
        catch(Exception $e)
        {    echo $e;}
        $cn->close();
    }
?>
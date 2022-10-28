<?php include "logincheck.php" ?>
<?php include 'BasicHtml-Js.php' ?>

<html>
    <body>
    <br>
    <button class="assetbutton" onclick="assetdetails('banks')">Banks</button>&emsp;
    <button class="assetbutton" onclick="assetdetails('stocks')">Stocks</button>&emsp;
    <button class="assetbutton" onclick="assetdetails('crypto')">Crypto</button>&emsp;
    <button class="assetbutton" onclick="assetdetails('npa')">NPA</button>&emsp;
    <button class="assetbutton" onclick="assetdetails('mutual')">Mutual Funds</button>
    <form id="assetsubmitform" action="" method="post">
        <input type="text" id="assetcategory"  name="assetcategory" value=" " style="visibility:hidden;">
    </form>
</body>
</html>

<?php
    if(isset($_POST['assetcategory']))
    {
        include 'connection.php';
        $assetcategory=$_POST['assetcategory'];
        try
        {
            $total=0;
            echo "<center><font size='6'>";
            $qry="select * from assetdetailsdb where username='".$username."' and assetcategory='".$assetcategory."'";
            $result=$cn->query($qry);
            if($result->num_rows==0)
                echo "<h1> No data on this!</h1>";
            else
            {
                echo "<table style='font-size: 30px;'>
                        <tr >
                            <th><u>Name</u></th>
                            <th>&emsp; </th>
                            <th><u>Value</u></th>
                        </tr>";
                while($row=$result->fetch_assoc())
                {
                    echo "<tr>
                            <td>".$row['assetname']."</td>
                            <td>:</td>
                            <td>₹".$row['assetdetails']."</td>
                        </tr> ";
                    $total=$total+intval($row['assetdetails']);
                }
                echo "</table>
                     Total : <u>₹".$total."</u>
                    </center></font>";
            }
        }
        catch(Exception $e)
        { echo $e;}
        $cn->close();
        
        echo "<br>
            <center>
                <form name='editdetailsform' method='post' action=''>
                    <button name='editdata' class='btn btn-outline-dark' style='width:200px;'>Edit Details</button><br>  
                    <input type='text' name='assetcategory' value=".$assetcategory." style='visibility:hidden;'>   
                </form>
            </center>";
    }
?>



<?php

    //edit assets code showing form and buttons
    if(isset($_POST['editdata']))
    {
        echo '
        <script type="text/JavaScript">
            function editfunction(operation) 
            {
                document.getElementById("editdetails").style.visibility="visible";
                document.getElementById("operation").value=operation;
                document.getElementById("editdetailsbutton").innerHTML=operation;
                document.getElementById("buttonsgroup").style.visibility="hidden";
            }
        </script>
        <center>
            <div id="buttonsgroup">
                <button type="button" class="btn btn-outline-dark" onclick=editfunction("Add")>Add Data</button>&emsp;
                <button type="button" class="btn btn-outline-dark" onclick=editfunction("Delete")>Delete Data</button>&emsp;
                <button type="button" class="btn btn-outline-dark" onclick=editfunction("Alter")>Alter Data</button><br>
             </div>
            <form name="editdetails" id="editdetails" method="post" action="" style="visibility:hidden;">
                <h1 style="font-size: 30px;">Enter Details</h1>
                <font size="6">
                <table style="font-size: 25px;">
                    <tr>
                        <td>Enter Name</td>
                        <td>:</td>
                        <td><input type="text" name="assetname" value=" "></td>
                    </tr>
                    <tr>
                        <td>Enter Value</td>
                        <td>:</td>
                        <td><input type="text" name="assetvalue"  value=" "/></td>
                    </tr>
                </table>
                </font>
                <input type="text" name="assetcategory" value='.$_POST['assetcategory'].' style="visibility:hidden;"> 
                <input type="text" name="operation" id="operation" value=" " style="visibility:hidden;"><br>
                <button name="editdetailsbutton" id="editdetailsbutton" class="btn btn-outline-dark"></button><br><br>
            </form>
        </center>'; 
    }
?>

<?php
    // edit function 3 operations
    if(isset($_POST["editdetailsbutton"]))
    { 
        $operation=$_POST['operation'];
        $assetcategory=trim($_POST['assetcategory']);
        $assetname=trim($_POST['assetname']);
        $assetvalue=trim($_POST['assetvalue']);
        try
        {
            include 'connection.php';
            $qry="select * from assetdetailsdb where username='".$username."' and assetcategory='".$assetcategory."'and assetname='".$assetname."'";
            $result=$cn->query($qry);
            if($operation=="Add")
            {
                if($result->num_rows>=1)
                {
                    echo "<center><h1>record already exists</h1></center>";
                    $cn->close();
                }
                else
                {
                    $qry="insert into assetdetailsdb values('".$username."','".$assetcategory."','".$assetname."','".$assetvalue."')";
                    $result=$cn->query($qry);
                    if($result)
                    {
                        
                        $qry="select * from assetdetailsdb where username='".$username."' and assetcategory='".$assetcategory."'";
                        $result1=$cn->query($qry);
                        $total=0;
                        while($row=$result1->fetch_assoc())
                        {
                            $total=$total+intval($row['assetdetails']);
                        }
                        $qry="update assetdb set ".$assetcategory."='".$total."' where username='".$username."'";
                        $result=$cn->query($qry);
                        $cn->close();
                        echo "<form id='assetsubmit' method='post' action='details.php'>
                                    <input name='assetcategory' type='hidden' value=".$assetcategory.">
                            </form>
                            <script>
                                alert('Data Saved..!');
                                document.getElementById('assetsubmit').submit();
                            </script>";
                    }
                }
            }
            elseif($operation=="Delete")
            {   
                if($result->num_rows==0)
                {
                    echo "<center><h1>No Such Data</h1></center>";
                    $cn->close();
                }
                else
                {
                    $qry="delete from assetdetailsdb where username='".$username."' and assetcategory='".$assetcategory."'and assetname='".$assetname."'";
                    $result=$cn->query($qry);
                    if($result)
                    {
                        $qry="select * from assetdetailsdb where username='".$username."' and assetcategory='".$assetcategory."'";
                        $result1=$cn->query($qry);
                        $total=0;
                        while($row=$result1->fetch_assoc())
                        {
                            $total=$total+intval($row['assetdetails']);
                        }
                        $qry="update assetdb set ".$assetcategory."='".$total."' where username='".$username."'";
                        $result=$cn->query($qry);
                        $cn->close();
                        echo " <form id='assetsubmit' method='post' action='details.php'>
                                    <input name='assetcategory' type='hidden' value=".$assetcategory.">
                            </form>
                            <script>
                                alert('Data Deleted');
                                document.getElementById('assetsubmit').submit();
                            </script>";
                    }
                }
            }
            elseif($operation=="Alter")
            {
                if($result->num_rows>=1)
                {
                    $qry="update assetdetailsdb set assetdetails='".$assetvalue."' where username='".$username."' and assetcategory='".$assetcategory."' and assetname='".$assetname."'";
                    $result=$cn->query($qry);
                    if($result)
                    {
                        $qry="select * from assetdetailsdb where username='".$username."' and assetcategory='".$assetcategory."'";
                        $result1=$cn->query($qry);
                        $total=0;
                        while($row=$result1->fetch_assoc())
                        {
                            $total=$total+intval($row['assetdetails']);
                        }
                        $qry="update assetdb set ".$assetcategory."='".$total."' where username='".$username."'";
                        $result=$cn->query($qry);
                        $cn->close();
                        echo "<form id='assetsubmit' method='post' action='details.php'>
                                <input name='assetcategory' type='hidden' value=".$assetcategory.">
                            </form>
                            <script>
                                alert('Data Altered');
                                document.getElementById('assetsubmit').submit();
                            </script>";
                    }
                }
                else
                {
                    echo "<center><h1>NO Such Data</h1></center>";
                    $cn->close();
                }
            }
        }
        catch(Exception $e)
        {echo $e;}
    }
?>
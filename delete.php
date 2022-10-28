<?php include "logincheck.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="style1.css" rel="stylesheet">
    <script>
        function confirmdelete()
        {
            if(confirm("are you sure you want to Delete Account"))
                document.getElementById("deleteform").submit();
        }
        function showpassword()
        {
            var show=document.getElementById("password");
            if(show.type=="password")
                show.type="text";
            else
                show.type="password";
        }
    </script>
</head>
<body>
    <div class="menu">
    <center><h1>Asset Management</h1></center><br>
	<div class="login">
        <br>
        <center><h1>Account Deletion</h1></center>
        <br>
         Are you sure you want to delete account?
        <br><br>
		<form action="" method="post" id="deleteform">
            <input type="password" id="password" name="password" placeholder="Enter Password" required>
            <br><br>
            <input type="checkbox" onclick="showpassword()">&emsp;Show Password
            <br><br>
		</form>
        <button  name="delete" id="delete" onclick="confirmdelete()">Delete Account</button><br><br>
        <a  name="home" id="home" href="home.php" style="color: white; text-decoration: none; font-size:x-large;">Home</a><br><br>
    </div>
    </div>
</body>
</html>


<?php
if(isset($_POST['password']))
{
    include 'connection.php';
    $password=$_POST['password'];
    $qry="select password from assetdb where username='".$username."'";
    $result=$cn->query($qry);
    $row=$result->fetch_row();
    if($row[0]==md5($password))
    {
        
        $qry="delete from assetdb where username='".$username."'";
        $result=$cn->query($qry);
        $qry="delete from assetdetailsdb where username='".$username."'";
        $result=$cn->query($qry);
        echo "<script>
                alert('Account Deleted Successfully');
                window.open('index.php','_self');
            </script>";
    }
    else
    {
        echo "<div>
                <center><h1>Wrong Password..!</h1></center>
            </div>";
    }
    $cn->close();
}
?>
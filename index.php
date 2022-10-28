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
        function showpassword()
        {
            var show=document.getElementById("password");
            if(show.type=="password")
                show.type="text";
            else
                show.type="password";
        }
        function changetosignup() 
        {
            document.getElementById("login").innerHTML="Sign Up";
            document.getElementById("login").name="signup";
            document.getElementById("newuser").style.visibility="hidden";
        }
    </script>
</head>
<body>
    <div class="menu">
    <center><h1>Asset Management</h1></center><br>
	<div class="login">
        <center><h1>Welcome</h1></center>
		<form action="" method="post" id="loginform">
			User Name
            <input type="text" id="username" name="username" placeholder="Enter User Name" required><br><br>
			Passwrod
            <input type="password" id="password" name="password" placeholder="Enter Password" required>
            <br><br>
            <input type="checkbox" onclick="showpassword()">&emsp;Show Password
            <br><br>
            <button  name="login" id="login">Log In</button><br><br>
            <button name="newuser" id="newuser" class="assetbutton" onclick="changetosignup()" style="background-color: transparent; border: none;">New User?</button>
		</form>
    </div>
    </div>
</body>
</html>

<?php
    //login
    if(isset($_POST['login']))
    {
        $username=trim($_POST['username']);
        $password=trim($_POST['password']);
        include 'connection.php';
        $qry="select username from assetdb where username='".$username."'";
        $result=$cn->query($qry);
        if($result->num_rows==1)
        {
            $password=md5($password);
            // $qry="select username , password from assetdb where username='".$username."' and password='".$password."'";
            $qry="select password from assetdb where username='".$username."'";
            $result=$cn->query($qry);
            $row=$result->fetch_row();
            if($row[0]==$password)
            {
                session_start();
                $_SESSION['username']=$username;
                $_SESSION['password']=$password;
                echo "<script>
                            window.open('home.php','_self');
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
        else
        {
            echo "<div>
            <center><h1>Account not found..!</h1></center>
                </div>";
        }
    }
?>

<?php
    //signup
    if(isset($_POST['signup']))
    {
        $username=trim($_POST['username']);
        $password=md5(trim($_POST['password']));
        include 'connection.php';
        $qry="select username from assetdb where username='".$username."'";
        $result=$cn->query($qry);
        if($result->num_rows==1)
        {
            echo "<div>

                <center><h1>Account Already Exists with this Username</h1></center>
                </div>";
        }
        else
        {
            $qry="insert into assetdb values('".$username."','".$password."','0','0','0','0','0')";
            $result=$cn->query($qry);
            if($result)
            {
                session_start();
                $_SESSION['username']=$username;
                echo "<script>
                        window.open('home.php','_self');
                    </script>";
            }
        }
        $cn->close();

    }
?>
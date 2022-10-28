<script>
    function logoutfunction() 
    {  
        if(confirm("Do you want to Logout"))
            window.open('logout.php','_self');
    }

    function assetdetails(asset)
    {
        document.getElementById("assetcategory").value=asset;
        document.getElementById("assetsubmitform").submit();
    }

    function calculate()
    {
        var banks=parseInt(document.getElementById("banks").value);
        var stocks=parseInt(document.getElementById("stocks").value);
        var crypto=parseInt(document.getElementById("crypto").value);
        var npa=parseInt(document.getElementById("npa").value);
        var mutual=parseInt(document.getElementById("mutual").value);
        if(isNaN(banks))  banks=0;
        if(isNaN(stocks)) stocks=0;
        if(isNaN(crypto)) crypto=0;
        if(isNaN(mutual)) mutual=0;
        if(isNaN(npa))    npa=0;
        var total=banks+stocks+crypto+npa+mutual;
        document.getElementById("save").style.visibility="visible";
        document.getElementById("hiddentablerow").style.visibility="visible";
        document.getElementById("total").innerHTML="₹"+total;
    }
    function confirmsave()
    {
        if(confirm("Save Data"))
            document.getElementById("calculateform").submit();
    }
</script>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
        <title>Asset Management</title>
    </head>
    <body>
    <div class="menu">
        <div class="link">
           <div> <a href="home.php">Home</a>&emsp;</div>
           <div><a href="calculate.php">Calculate</a>&emsp;</div>
            <div><a href="details.php">Asset details</a>&emsp;</div>
        </div>
        <div class="logout">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: transparent; border: none; color:black; font-size: x-large;">
                    Settings
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" style=" background-color: rgba(255,255,255,0.4);">
                    <li><a class="dropdown-item active" href="#" style="color:black; font-size:medium;">Invite</a></li>
                    <li><a class="dropdown-item" href="delete.php" style="color:black; font-size:medium;">Delete Account</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" onClick="logoutfunction()" style="color:black; font-size:medium;">Log Out</a></li>
                </ul>
            </div>
        </div>
    </div>
    <br>
    </body>
</html>
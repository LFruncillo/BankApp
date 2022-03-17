<html>
    <head>
    <style>
        body
        {
        background-color: rgba(0,0,0,0.0) !important;
        }
    </style>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="bankapp.css">
    </head>
    <body>
    <h3 style="text-align:center">Welcome, please login.</h3>
    <div id="homeforms" class="home_forms">
        <div id="register" class="register_container" style="display: inline-block;">
            <form action="accactions.php" method="post">
                <input id="regname" class="reg_name" type="text" value="" placeholder="Name..." name="regaccname">
                <input id="regpassword" class="reg_password" type="password" value="" placeholder="Password..." name="regaccpass">
                <input type="checkbox" onclick="showRegPass()">Show Password
                <input class="btn btn-dark" type="submit" name="register" value="register">
            </form> 
        </div>

        <div id="login" class="login_container" style="display: inline-block;">
            <form action="accactions.php" method="post">
                <input id="logname" class="log_name" type="text" value="" placeholder="Name..." name="logaccname">
                <input id="logpassword" class="log_password" type="password" value="" placeholder="Password..." name="logaccpass">
                <input type="checkbox" onclick="showLogPass()">Show Password
                <input class="btn btn-dark" type="submit" name="login" value="login">
            </form> 
        </div>
    </div>
    </body>
</html>
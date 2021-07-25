<?php
    session_start();
?>
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
        <a href="account.php" style="text-align: center;">Back to account</a>
            <div id="accountinfo" class="account_info">
                <!-- Displays logged in users account information -->
                <?php
                    include_once 'db_connect.php';

                    if ($conn-> connect_error){
                        die("Connection failed:". $conn-> connect_error);
                    }

                    $name = $_SESSION['name'];

                    $query = "SELECT * FROM bank_accounts WHERE name = '$name'";
                    $result = mysqli_query($conn, $query);

                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_array($result)) {
                            echo "<tr><td>". $row["Name"] ."</td><td>". $row["Balance"] ."</td><td>". $row["Type"] ."</td></tr>";
                        }
                        echo "</table>";
                    }
                    else {
                        echo "no results";
                    }

                    $conn-> close();
                ?>
                <div id="accountsettings" class="account_settings" style="display: inline-block;">
                <form action="accactions.php" method="post">
                    <input id="changename" class="change_name" type="text" value="" placeholder="New name..." name="newname">
                    <input class="btn btn-dark" type="submit" name="changename" value="Update name">
                    <input id="changepassword" class="change_password" type="text" value="" placeholder="New password..." name="newpassword">
                    <input class="btn btn-dark" type="submit" name="changepassword" value="Update Password">
                </form>
                </div>
            </div>
    </body>
    <script src="bankapp.js"></script>
</html>
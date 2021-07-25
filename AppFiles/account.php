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
        <h3 style="text-align: center;">This is your account.</h3>
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
                <div id="balanceactions" class="balance_actions" style="display: inline-block;">
                <form action="accactions.php" method="post">
                    <input id="dbalamount" class="dbal_amount" type="number" value="" placeholder="Amount..." name="daccbalamount">
                    <input class="btn btn-dark" type="submit" name="deposit" value="deposit">
                    <input id="wbalamount" class="wbal_amount" type="number" value="" placeholder="Amount..." name="waccbalamount">
                    <input class="btn btn-dark" type="submit" name="withdraw" value="withdraw">
                
                <div id="payment" class="acc_pay" style="display: inline-block; display: none;">
                    <input id="payuser" class="pay_user" type="text" value="" placeholder="Name..." name="puser">
                    <input id="payamount" class="pay_amount" type="number" value="" placeholder="Amount..." name="pamount">
                    <input class="btn btn-dark" type="submit" name="pay" value="pay">
                </div>
                </form>
                </div>
                <input id="showpaybtn" class="btn btn-dark" type="submit" name="showpay" value="PAY" onclick="show('payment')">
                <a href="account_settings.php" style="text-align: center;">Settings</a>
                <a href="logout.php" style="text-align: center;">Log out</a>
            </div>
    </body>
    <script src="bankapp.js"></script>
</html>
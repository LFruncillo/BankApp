<?php
session_start();
include_once 'db_connect.php';

/* Stores a new account in the database */
if(isset($_POST['register']))
{
    $name = mysqli_real_escape_string($conn, $_POST["regaccname"]);
    $password = password_hash($_POST['regaccpass'], PASSWORD_BCRYPT);
    $balance = 0.00;
    $type = 'Standard';
    
    $sql = "INSERT INTO bank_accounts (name,password,balance,type)
    VALUES ('$name','$password','$balance','$type')";

    if (mysqli_query($conn, $sql)) {
        echo "Account created";
        header("Location: home.php"); /* Redirect browser */
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}

/* Logs the user into their account */
if(isset($_POST['login']))
{
    if(empty($_POST["logaccname"]) || empty($_POST["logaccpass"])) 
	{
		echo 'Both fields are required.'; 
	} else {
		$name = mysqli_real_escape_string($conn, $_POST["logaccname"]);
		$password = mysqli_real_escape_string($conn, $_POST["logaccpass"]);
		$query = "SELECT * FROM bank_accounts WHERE name = '$name'"; 
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_array($result))
			{
				if(password_verify($password, $row["Password"]))
				{
					$_SESSION["name"] = $name; 
					echo "Logged in";
					header("location:account.php");
				}
				else
				{
					echo 'Wrong details.';
				}
			}
		}
	}
}

/* Deposits specified amount into the users account */
if(isset($_POST['deposit']))
{
	$balance = mysqli_real_escape_string($conn, $_POST["daccbalamount"]);
	$name = $_SESSION['name'];

	$query = "SELECT * FROM bank_accounts WHERE name = '$name'"; 
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result)) {
			$dvalue = $balance;
			$currentbalance = $row['Balance'];
			$newbal = $dvalue + $currentbalance;
			$newbalquery = "UPDATE bank_accounts SET balance='$newbal' WHERE name='$name'";
			$result = mysqli_query($conn, $newbalquery);
			header("location:account.php");
		}
		}else {
			echo "Please input amount";
			header("location:account.php");
		}
}

/* Withdraws specified amount from the users account */
if(isset($_POST['withdraw']))
{
	$balance = mysqli_real_escape_string($conn, $_POST["waccbalamount"]);
	$name = $_SESSION['name'];

	$query = "SELECT * FROM bank_accounts WHERE name = '$name'"; 
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result)) {
			$wvalue = $balance;
			$currentbalance = $row['Balance'];
			$newbal = $currentbalance - $wvalue;
			$newbalquery = "UPDATE bank_accounts SET balance='$newbal' WHERE name='$name'";
			$result = mysqli_query($conn, $newbalquery);
			header("location:account.php");
		}
		}else {
			echo "Please input amount";
			header("location:account.php");
		}
}

/* Fetches specified amount from senders account and sends it to specified recipient */
if(isset($_POST['pay']))
{
	$balance = mysqli_real_escape_string($conn, $_POST["pamount"]);
	$recipient = mysqli_real_escape_string($conn, $_POST["puser"]);
	$name = $_SESSION['name'];

	$query = "SELECT * FROM bank_accounts WHERE name = '$name'";
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result)) {
			$pvalue = $balance;
			$currentbalance = $row['Balance'];
			$newbal = $currentbalance - $pvalue;
			$rquery = "SELECT * FROM bank_accounts WHERE name = '$recipient'";
			$result = mysqli_query($conn, $rquery);
			if(mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_array($result)) {
				$rcurrentbalance = $row['Balance'];
				$newrecbal = $rcurrentbalance + $pvalue;
				$newbalquery = "UPDATE bank_accounts SET balance='$newbal' WHERE name='$name'";
				$newrecbalquery = "UPDATE bank_accounts SET balance='$newrecbal' WHERE name='$recipient'";
				$result = mysqli_query($conn, $newbalquery);
				$result = mysqli_query($conn, $newrecbalquery);
				header("location:account.php");
				}
			}
		}
		}else {
			echo "Please input amount";
			header("location:account.php");
		}
}

/* Changes users name to specified username */
if(isset($_POST['changename']))
{
	$newname = mysqli_real_escape_string($conn, $_POST["newname"]);
	$name = $_SESSION['name'];

	$query = "SELECT * FROM bank_accounts WHERE name = '$name'"; 
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result)) {
			$newnamequery = "UPDATE bank_accounts SET name='$newname' WHERE name='$name'";
			$result = mysqli_query($conn, $newnamequery);
			session_destroy();
			header("location:home.php");
			
		}
		}else {
			echo "Please input new name";
			header("location:account_settings.php");
		}
}

/* Changes users password to specified new password */
if(isset($_POST['changepassword']))
{
	$newpassword = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);
	$name = $_SESSION['name'];

	$query = "SELECT * FROM bank_accounts WHERE name = '$name'"; 
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result)) {
			$newpassquery = "UPDATE bank_accounts SET password='$newpassword' WHERE name='$name'";
			$result = mysqli_query($conn, $newpassquery);
			session_destroy();
			header("location:home.php");
		}
		}else {
			echo "Please input new password";
			header("location:account_settings.php");
		}
}
?>
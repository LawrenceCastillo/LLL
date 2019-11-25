<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: index.html');
  exit();
}
// Include config
require_once "config.php";

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT auth.email, det.phone_number, det.zipcode, det.looking_for, t.type FROM accounts auth JOIN accounts_details det ON auth.account_id=det.account_id JOIN (SELECT type_of.account_id account_id, types.type type FROM type_of JOIN types ON types.type_id=type_of.type_id) t ON t.account_id=auth.account_id WHERE auth.account_id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($email, $phone_number, $zipcode, $looking_for, $type);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Profile Page</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  </head>
  <body class="loggedin">
    <nav class="navtop">
      <div>
	<h1>Website Title</h1>
	<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
	<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
      </div>
    </nav>
    <div class="content">
      <h2>Profile Page</h2>
      <div>
	<p>Your account details are below:</p>
	<table>
	  <tr>
	    <td>Username:</td>
	    <td><?=$_SESSION['name']?></td>
	  </tr>
	  <tr>
	    <td>Email:</td>
	    <td><?=$email?></td>
	  </tr>
          <tr>
            <td>Phone Number:</td>
            <td><?=$phone_number?></td>
          </tr>
	  <tr>
            <td>Zipcode:</td>
            <td><?=$zipcode?></td>
          </tr>
          <tr>
            <td>Looking For:</td>
            <td><?=$looking_for?></td>
	  </tr>
          <tr>
            <td>My Type:</td>
            <td><?=$type?></td>
          </tr>
        </table>
      </div>
    </div>
  </body>
</html>

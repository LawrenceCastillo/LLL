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

// Return main profile data, including type=null if quiz not submitted
$stmt = $con->prepare('
    SELECT auth.email, det.phone_number, det.zipcode, det.looking_for, t.type, min(pairings.type_id2) type_pair1, max(pairings.type_id2) type_pair2
    FROM accounts auth
    JOIN
      accounts_details det ON auth.account_id=det.account_id
    LEFT JOIN (
      SELECT type_of.account_id account_id, type_of.type_id, types.type type
      FROM type_of
      JOIN
        types ON types.type_id=type_of.type_id) t
      ON t.account_id=auth.account_id
    LEFT JOIN
  pairings ON pairings.type_id1=t.type_id
WHERE auth.account_id = ?');

$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($email, $phone_number, $zipcode, $looking_for, $type, $type_pair1, $type_pair2);
$stmt->fetch();
$stmt->close();

// Return compatible type 1
$stmt = $con->prepare('SELECT type FROM types WHERE type_id= ?');
$stmt->bind_param('i', $type_pair1);
$stmt->execute();
$stmt->bind_result($pair1);
$stmt->fetch();
$stmt->close();
// Return compatible type 2
$stmt = $con->prepare('SELECT type FROM types WHERE type_id= ?');
$stmt->bind_param('i', $type_pair2);
$stmt->execute();
$stmt->bind_result($pair2);
$stmt->fetch();
$stmt->close();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LikeLikeLove.com</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/screen.css">
  </head>

  <body>
    <div id="page">
      <header>
        <a id="top"></a>
        <a class="logo" title="LikeLikeLove.com" href="profile.php"><span>LikeLikeLove.com</span></a>
        <div class="hero">
        </div>
      </header>

      <h2 id="qpage">Hey there, <?=$_SESSION['name']?>!</h2>
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
          <tr>
            <td>My Compatible Types:</td>
	    <td><?=$pair1?>, <?=$pair2?> </td>
          </tr>
        </table>
      </div>

      <nav>
        <ul>
          <li><a class="navigation" href="logout.php">LOGOUT</a></li>
          <li><a class="navigation" href="quiz.php">TAKE THE QUIZ!</a></li>
          <li><a class="navigation" href="profile.php">PROFILE</a></li>
	  <li><a class="navigation" href="index.html">LOGIN</a></li>
	  <li><a class="navigation" href="register.html">REGISTER</a></li>
        </ul>
      </nav>

    </div>
  </body>
</html>

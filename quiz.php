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

$stmt = $con->prepare('SELECT * FROM questions');
// In this case we can use the account ID to get the account info.
//$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($question_id[][], $question[][]);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Quiz</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  </head>
  <body class="loggedin">
    <nav class="navtop">
      <div>
	      <h1>Like Like Love</h1>
	      <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
	      <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
      </div>
    </nav>
    <div class="content">
      <h2>Quiz</h2>
      <div>
	      <form action="entry.php" method="post" autocomplete="off">
          <p><?=$question[0][1]?></p>
          <select name="q2" placeholder="Select" multiple >
	          <option id="agree">Tend to Agree</option>
	          <option id="disagree">Tend to Disagree</option>
          <p><?=$question[1][1]?></p>
          <select name="q3" placeholder="Select" multiple >
	          <option id="agree">Tend to Agree</option>
	          <option id="disagree">Tend to Disagree</option>
          <p><?=$question[2][1]?></p>
          <select name="q4" placeholder="Select" multiple >
	          <option id="agree">Tend to Agree</option>
	          <option id="disagree">Tend to Disagree</option>
          <input type="submit" value="submit" >
        </form>
      </div>
    </div>
  </body>
</html>

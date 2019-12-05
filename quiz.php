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

$query = 'SELECT question FROM questions';
$result = mysqli_fetch_all($con->query($query), MYSQLI_ASSOC);
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
	  <?php for ( $i=0; $i < 8; $i++ ){ ?>
            <blockquote>
              <?php echo $result[$i]['question']; ?>
              <select name="<?php echo $i+1 ?>"  >
	        <option id="agree">Tend to Agree</option>
	        <option id="disagree">Tend to Disagree</option>
              </select>
            </blockquote>
          <?php } ?>
          <input type="submit" value="submit" >
        </form>
      </div>
    </div>
  </body>
</html>

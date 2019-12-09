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

$query = 'SELECT type, description FROM types';
$result = mysqli_fetch_all($con->query($query), MYSQLI_ASSOC);
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

      <h2 id="qpage">Personality Types based on "The Four Tendencies" by Gretchen Rubin</h2>
      <div>
	<?php for ( $i=0; $i < 4; $i++ ){ ?>
          <blockquote><b>
	    <?php echo $result[$i]['type'];?>: </b><?php echo $result[$i]['description']; ?>
          </blockquote>
        <?php } ?>
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

     <footer>
       This website was created for educational purposes only. No harm intended to the author of the book.<br>
       &copy; Lawrence Gabriel Castillo: New York- Based Software Engineer
       <!--This website created by Lawrence Gabriel Castillo-->
     </footer>

    </div>
  </body>
</html>

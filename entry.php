<?php
session_start();

// Include config file
require_once "config.php";

$id   = $_SESSION['id'];

foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";

  if ( $value == "Tend to Agree" ){ $choice_id = $key*2; }
  else if ( $value == "Tend to Disagree" ){ $choice_id = $key*2+1; }
    
  if ($stmt = $con->prepare('INSERT INTO chooses (account_id, choice_id) VALUES (?, ?)')) {
    $stmt->bind_param('ss', $id, $choice_id);
    $stmt->execute();
  } else { die ( 'Something went wrong!' ); }
  $stmt->close();
}

$con->close();
?>


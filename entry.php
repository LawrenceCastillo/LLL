<?php
session_start();

// Include config file
require_once "config.php";

$id    = $_SESSION['id'];
$count = 0;

foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }
/*
// Check which question was answered and which choice selected
if (!isset($_POST['q2'])){
  if ( $_POST['q2'] == "Tend to Agree" ){ $choice_id = 2*2; $count++; }
  else if ( $_POST['q2'] == "Tend to Disagree" ){ $choice_id = 2*2+1; $count++; }
}

if ($stmt = $con->prepare('INSERT INTO chooses (account_id, choice_id) VALUES (?, ?)')) {
  $stmt->bind_param('ss', $id, $choice_id);
  $stmt->execute();
} else { die ( 'Something went wrong!' ); }
$stmt->close();

if (!isset($_POST['q3'])){
  if ( $_POST['q3'] == "Tend to Agree" ){ $choice_id = 3*2; $count++; }
  else if ( $_POST['q3'] == "Tend to Disagree" ){ $choice_id = 3*2+1; $count++; }
}

if ($stmt = $con->prepare('INSERT INTO chooses (account_id, choice_id) VALUES (?, ?)')) {
  $stmt->bind_param('ss', $id, $choice_id);
  $stmt->execute();
} else { die ( 'Something went wrong!' ); }
$stmt->close();

if (!isset($_POST['q4'])){
  if ( $_POST['q4'] == "Tend to Agree" ) { $choice_id  = 4*2; $count++; }
  else if ( $_POST['q4'] == "Tend to Disagree" ){ $choice_id = 4*2+1; $count++; }
}

if ($stmt = $con->prepare('INSERT INTO chooses (account_id, choice_id) VALUES (?, ?)')) {
  $stmt->bind_param('ss', $id, $choice_id);
  $stmt->execute();
} else { die ( 'Something went wrong!' ); }
$stmt->close();

// Make sure the submitted registration values are not empty.
//if (empty($_POST['phonenumber']) || empty($_POST['zipcode']) || empty($_POST['lookingfor'])) {
  // One or more values are empty.
//  die ('Please complete the registration form');
//}

$con->close();
?>
 */

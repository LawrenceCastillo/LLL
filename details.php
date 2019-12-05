<?php
session_start();

// Include config file
require_once "config.php";

$id = $_SESSION['id'];


// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['phonenumber'], $_POST['zipcode'], $_POST['lookingfor'])) {
  // Could not get the data that should have been sent.
  die ('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['phonenumber']) || empty($_POST['zipcode']) || empty($_POST['lookingfor'])) {
  // One or more values are empty.
  die ('Please complete the registration form');
}

// Check for valid email
if (preg_match('/[0-9\-]+/', $_POST['phonenumber']) == 0) {
  die ('Phone number is not valid!');
}

// Check for valid zipcode
if (preg_match('/[0-9]+/', $_POST['zipcode']) == 0) {
  die ('Zipcode is not valid!');
}

if ($stmt = $con->prepare('INSERT INTO accounts_details (account_id, phone_number, zipcode, looking_for) VALUES (?, ?, ?, ?)')) {
  $stmt->bind_param('ssss', $id, $_POST['phonenumber'], $_POST['zipcode'], $_POST['lookingfor']);
  $stmt->execute();
  echo 'Entries successfully stored!';
} else {
  echo 'Could not prepare statement';
}
$stmt->close();

$con->close();
?>

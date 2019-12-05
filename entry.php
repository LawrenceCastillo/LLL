<?php
session_start();

// Include config file
require_once "config.php";

$id = $_SESSION['id'];


// Check which question was answered and which choice selected
if ($_POST['q2'] == "Tend to Agree") {
	$choice_id = 2*2;
	echo 'affirmative';
}
else if ($_POST['q2'] == "Tend to Disagree") {
  $choice_id = 2*2+1;
}

echo $choice_id;

// Now we check if the data was submitted, isset() function will check if the data exists.
//if (!isset($_POST['phonenumber'], $_POST['zipcode'], $_POST['lookingfor'])) {
  // Could not get the data that should have been sent.
//  die ('Please complete the registration form!');
//}
// Make sure the submitted registration values are not empty.
//if (empty($_POST['phonenumber']) || empty($_POST['zipcode']) || empty($_POST['lookingfor'])) {
  // One or more values are empty.
//  die ('Please complete the registration form');
//}

// Check for valid email
//if (preg_match('/[0-9\-]+/', $_POST['phonenumber']) == 0) {
//  die ('Phone number is not valid!');
//}

// Check for valid zipcode
//if (preg_match('/[0-9]+/', $_POST['zipcode']) == 0) {
//  die ('Zipcode is not valid!');
//}
/*
// Check valid char length
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
  die ('Password must be between 5 and 20 characters long!');
}
 */
/*
// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT account_id, password FROM accounts WHERE username = ?')) {
  // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
  $stmt->bind_param('s', $_POST['username']);
  $stmt->execute();
  $stmt->store_result();
  // Store the result so we can check if the account exists in the database.
  if ($stmt->num_rows > 0) {
    // Username already exists
    echo 'Username exists, please choose another!';
  } else {
    // Username doesnt exists, insert new account
    if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
    // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
      $stmt->execute();
      echo 'You have successfully registered, you can now login!';
    } else {
      // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
      echo 'Could not prepare statement!';
    }
  }
  $stmt->close();
} else {
  // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
  echo 'Could not prepare statement!';
}
 */

if ($stmt = $con->prepare('INSERT INTO chooses (account_id, choice_id) VALUES (?, ?)')) {
  $stmt->bind_param('ss', $id, $choice_id);
  $stmt->execute();
  echo 'Entries successfully stored!';
} else {
  echo 'Could not prepare statement';
}
$stmt->close();

$con->close();
?>

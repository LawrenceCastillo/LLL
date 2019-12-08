<?php
// Include config file
require_once "config.php";

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset(
	$_POST['username'], 
	$_POST['password'], 
	$_POST['email'], 
	$_POST['phonenumber'], 
	$_POST['zipcode'],
        $_POST['gender'],	
	$_POST['lookingfor'])) {
  // Could not get the data that should have been sent.
  die ('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || 
	empty($_POST['password']) || 
	empty($_POST['email']) || 
	empty($_POST['phonenumber']) || 
	empty($_POST['zipcode']) || 
	empty($_POST['gender']) ||
	empty($_POST['lookingfor'])) {
  // One or more values are empty.
  die ('Please complete the registration form');
}

// Check for valid email
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {  
  die ('Email is not valid!');
}
// Check for valid username
if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
  die ('Username is not valid!');
}
// Check valid char length
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
  die ('Password must be between 5 and 20 characters long!');
}
// Check for valid email
if (preg_match('/[0-9\-]+/', $_POST['phonenumber']) == 0) {      
  die ('Phone number is not valid!');
}
// Check for valid zipcode
if (preg_match('/[0-9]+/', $_POST['zipcode']) == 0) {   
  die ('Zipcode is not valid!');
}

/* CREATE USER ACCOUNT */

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

/* INPUT ADDITIONAL DETAILS */

// data formatting
//if ($_POST['gender'] == 'I am a female') {$gender = 'female';}
//else {$gender = 'male';}

//if ($_POST['lookingfor'] == 'Looking for a female') {$lookingfor = 'female';}
//else {$lookingfor = 'male';}

echo $gender $lookingfor;

if ($stmt = $con->prepare('INSERT INTO accounts_details (account_id, phone_number, zipcode, looking_for, gender) 
	VALUES ((
          SELECT account_id 
          FROM accounts
          WHERE username = ?), 
          ?, ?, ?, ?)')) {
  $stmt->bind_param('sssss', $_POST['username'], $_POST['phonenumber'], $_POST['zipcode'], $lookingfor, $gender);
  $stmt->execute();
  echo 'Entries successfully stored!';
} else {
  echo 'Could not prepare statement';
}
$stmt->close();

$con->close();
//header('Location: index.html');
?>

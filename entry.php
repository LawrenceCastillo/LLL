<?php
session_start();

// Include config file
require_once "config.php";

$id   = $_SESSION['id'];

foreach ($_POST as $key => $value){

  if ($value == "Tend to Agree" ){$choice_id = $key*2;}
  else if ($value == "Tend to Disagree" ){$choice_id = $key*2+1;}
    
  if ($stmt = $con->prepare('
      INSERT INTO chooses (account_id, choice_id) 
      VALUES (?, ?)')){
    $stmt->bind_param('ii', $id, $choice_id);
    $stmt->execute();
  } else { die ('Something went wrong!'); }
  $stmt->close();
}

$stmt = $con->prepare('
    SELECT x.type_id type_id
    FROM choices x
    JOIN (
      SELECT choice_id 
      FROM chooses 
      WHERE account_id = ? 
      ORDER BY choose_id DESC 
      LIMIT 8) o
    ON x.choice_id = o.choice_id');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
while($row_data = $result->fetch_assoc()) {
  $score += $row_data['type_id'];
}

/* Find Type from score */
if ($score < 24)      {$type = 2;}
else if ($score < 28) {$type = 3;}
else if ($score < 32) {$type = 4;}
else                  {$type = 5;} 

if ($stmt = $con->prepare('
    INSERT INTO type_of (account_id, type_id) 
    VALUES (?, ?)')){
  $stmt->bind_param('ii', $id, $type);
  $stmt->execute();
} else { die ('Failed to add type!'); }
$stmt->close();

$con->close();
header('Location: profile.php');
?>


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
    $stmt->bind_param('ss', $id, $choice_id);
    $stmt->execute();
  } else { die ('Something went wrong!'); }
  $stmt->close();
}

$query = '
    SELECT o.account_id account_id, x.type_id type_id 
    FROM chooses o 
    JOIN 
    choices x 
    ON x.choice_id = o.choice_id';
$result = mysqli_fetch_all($con->query($query), MYSQLI_ASSOC);

for ($i=0; $i < 43; $i++){
  if ($result[$i]['account_id'] == $id){$score += $result[$i]['type_id']; }
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
?>


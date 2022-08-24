<?php
  $db_host ='217.21.90.154';
  $db_user = 'u884122342_royal_prod';
  $db_password = 'R0y@l@2022';
  $db_db = 'u884122342_royal_prod';
  $db_port = 3306;

  $mysqli = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db,
	$db_port
  );
  $conn = mysqli_connect($db_host, $db_user, $db_password, $db_db,$db_port);
  if (!$conn) {
	  echo "Connection failed!";
  }
  else {
      //echo "connected To DB";
  }

  if ($mysqli->connect_error) {
    echo 'Error: '.$mysqli->connect_errno;
    echo '<br>';
    echo 'Error: '.$mysqli->connect_error;
    exit();
  }

  $mysqli->close();

?>
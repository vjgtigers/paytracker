<!DOCTYPE html>
<html>
<body>

<?php


//also need to remvoe cookie from db

$startTime = time();
$dttime = date("Y-m-d H:i:s",$startTime);
$fname = "logOut";
include '../config.php';

include '../recordTime.php';


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  recordUse($fname, $dttime, $startTime, time(), $userID, "connFail");
  die("Connection failed: " . $conn->connect_error);
}



if (isset($_COOKIE["XERWAILOGIN"])) {
    $amountCookie = $_COOKIE["XERWAILOGIN"];
    setcookie('XERWAILOGIN', '', time()-7000000, '/');


$result = $conn->execute_query('SELECT search_id FROM locationtracking.cookies_table WHERE cookie = ?', [$_COOKIE['XERWAILOGIN']]);
 while ($row = $result->fetch_assoc()) {
  $userID = $row["search_id"];
 }

    
$sql = "DELETE FROM locationtracking.cookies_table WHERE cookie='".  $amountCookie   .   "'";

if ($conn->query($sql) === TRUE) {
  recordUse($fname, $dttime, $startTime, time(), $userID, "logoutSuccess");
  echo "Logout sucessfull";
} else {
  recordUse($fname, $dttime, $startTime, time(), $userID, "logoutFail");
  echo "Error deleting record: " . $conn->error;
}

$conn->close();

header("Location: ../login?r=2");
die();
} else {
echo "not logged in, cant log out";
}




?>

</body>
</html>
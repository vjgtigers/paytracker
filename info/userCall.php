<?php
//$data = ["name" => "John Doe", "age" => 25, "cars" => ["Ford", "BMW", "Fiat"], ];
//header('Content-Type: application/json');
//echo json_encode($data);



if(isset($_COOKIE['XERWAILOGIN'])) {
  //echo json_encode("NOT_LOGGED_IN");
  //die;
} else {
  echo json_encode("NOT_LOGGED_IN");
  die;
}
$startTime = time();
$dttime = date("Y-m-d H:i:s",$startTime);
$fname = "userCall";

include '../config.php';
include '../recordTime.php';


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  recordUse($fname, $dttime, $startTime, time(), $userID, "connFail");
  die("Connection failed: " . $conn->connect_error);
}

$result = $conn->execute_query('SELECT search_id FROM locationtracking.cookies_table WHERE cookie = ?', [$_COOKIE['XERWAILOGIN']]);
 while ($row = $result->fetch_assoc()) {
  $userID = $row["search_id"];
 }


$result = $conn->execute_query('SELECT username FROM locationtracking.account_info WHERE user_id = ?', [$userID]);

if ($result->num_rows > 0) {
  //echo json_encode($result->num_rows);
  //output data of each row
   
    while($row = $result->fetch_assoc()) {
        $infodata2 = $row['username'];
        }


} else {
  recordUse($fname, $dttime, $startTime, time(), $userID, "success-0r");
  echo json_encode("0 results");
  $conn->close();
  exit;
}
recordUse($fname, $dttime, $startTime, time(), $userID, "success");
echo json_encode($infodata2);

$conn->close();





?>
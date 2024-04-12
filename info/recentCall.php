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
$fname = "recentCall";

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


$sql = "SELECT date_info, hours FROM past_payment_data where user_id='".$userID . "' AND date_info >= (CURDATE()-INTERVAL 7 DAY) order by id desc LIMIT 10";
$result = $conn->query($sql);

$infodata = array();
if ($result->num_rows > 0) {
  //echo json_encode($result->num_rows);
  //output data of each row
  
    while($row = $result->fetch_assoc()) {
        $infodata[] = $row;
        }


} else {
  recordUse($fname, $dttime, $startTime, time(), $userID, "success-0r");
  echo json_encode("0 results");
  exit;
}

recordUse($fname, $dttime, $startTime, time(), $userID, "success");
echo json_encode($infodata);

$conn->close();
?>
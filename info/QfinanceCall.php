<?php


if(isset($_COOKIE['XERWAILOGIN'])) {
  //echo json_encode("NOT_LOGGED_IN");
  //die;
} else {
  
  echo json_encode("NOT_LOGGED_IN");
  die;

}
$startTime = time();
$dttime = date("Y-m-d H:i:s",$startTime);
$fname = "quickFinance";

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
$result11 = $conn->execute_query('SELECT tax_rate_approx FROM locationtracking.account_info WHERE user_id = ?', [$userID]);
 while ($row = $result11->fetch_assoc()) {
  $tax_rate = $row["tax_rate_approx"];
 }
$tax_multi = (abs($tax_rate-100))/100;




$money = 0;
$hours = 0;
$result = $conn->execute_query('SELECT hours, hourly_pay FROM locationtracking.past_payment_data WHERE date_info >= (CURDATE()-INTERVAL 7 DAY) and user_id = ?', [$userID]);

$data2 =  array();
$infodata = array();
$nextwork = "";
if ($result->num_rows > 0) {
  //echo json_encode($result->num_rows);
  //output data of each row
  
    while($row = $result->fetch_assoc()) {
        $money = $money + ($row['hourly_pay'] * $row['hours']);
        $hours = $hours + $row['hours'];
        $infodata[] = $row;
        }


} else {
  recordUse($fname, $dttime, $startTime, time(), $userID, "success");
  echo json_encode("0 results");
  exit;
}
$result2 = $conn->execute_query('SELECT start_time FROM locationtracking.future_work_dates WHERE date_info = CURDATE() and user_id = ?', [$userID]);
if ($result2->num_rows > 0) {
  //echo json_encode($result->num_rows);
  //output data of each row
  
    while($row = $result2->fetch_assoc()) {

        $nextwork = $row['start_time'];
        }


} else {
  $nextwork = "No Work";
}



$data2[] = $money;
$data2[] = $hours;
$data2[] = $nextwork;
$data2[] = $tax_rate;
$data2[] = $tax_multi * $money;
$data2[] = ($tax_rate /100) * $money;



recordUse($fname, $dttime, $startTime, time(), $userID, "success");
echo json_encode($data2);

$conn->close();



?>
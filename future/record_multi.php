<?php


$array1 = $_POST['appt'];
$array2 = $_POST['appt2'];
$array3 = $_POST['date'];
if(isset($_COOKIE['XERWAILOGIN'])) {
  //echo json_encode("NOT_LOGGED_IN");
  //die;
} else {
  echo json_encode("NOT_LOGGED_IN");
  die;
}


foreach ($array1 as $key => $val) {
   echo $val;
}

foreach ($array2 as $key => $val) {
   echo $val;
}

foreach ($array3 as $key => $val) {
   echo $val;
}

$startTime = time();
$dttime = date("Y-m-d H:i:s",$startTime);
$fname = "recordFuture";

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



echo "<br>";
var_dump(count($array1));
echo "<br>";
$lenthg = count($array1);
for ($x = 0; $x <= $lenthg-1; $x++) {
  echo "The number is: $x <br>";
  $date1 =  $array3[$x];
  $firsttime = $array3[$x] . " " . $array1[$x];
  $secondtime = $array3[$x] . " " . $array2[$x];
  echo $array1[$x] . " ".  $array2[$x]  . " ".  $array3[$x]        .   "   ".  $firsttime    . "    " .   $secondtime    ."<br>";
  $sql = "INSERT INTO locationtracking.future_work_dates (date_info, start_time, end_time, user_id) VALUES ('$date1', '$firsttime', '$secondtime', '$userID')";
  $conn->query($sql);



}
$conn->close();
recordUse($fname, $dttime, $startTime, time(), $userID, "success");
header("Location: https://xerwai.com/paytracking/info");
die();


?>

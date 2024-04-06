<!DOCTYPE html>
<html>



<?php

if(isset($_COOKIE['XERWAILOGIN'])) {
  //echo json_encode("NOT_LOGGED_IN");
  //die;
} else {
  echo json_encode("NOT_LOGGED_IN");
  die;

}





echo 'version4<br>';
echo htmlspecialchars($_POST["date"]);
echo '<br>';
$w = htmlspecialchars($_POST["weekend"]);
$pay = htmlspecialchars($_POST["pay"]);

echo '<br>';
if ($w == "") {
    echo "not weekend";
    $weekend = 0;
} else {
    echo "weekend";
    $weekend = 1;

}





echo '<br>';
echo htmlspecialchars($_POST["hours"]);
echo '<br>';
echo 'If this page doesnt redirect something went horibbly wrong, please close the tab and try again.';

echo '<br>';


$startTime = time();
$dttime = date("Y-m-d H:i:s",$startTime);
$fname = "recordPage";
include '../../config.php';

include '../recordTime.php';

//db connection

//weekend set up top + hourly pay
$date = htmlspecialchars($_POST["date"]);
$hours = htmlspecialchars($_POST["hours"]);
//fetch data






$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  recordUse($fname, $dttime, $startTime, time(), $userID, "connFail");
  die("Connection failed: " . $conn->connect_error);
}



$result = $conn->execute_query('SELECT search_id FROM locationtracking.cookies_table WHERE cookie = ?', [$_COOKIE['XERWAILOGIN']]);
 while ($row = $result->fetch_assoc()) {
  $userID = $row["search_id"];
 }





$sql = "INSERT INTO past_payment_data (date_info, hours, weekend, user_id, hourly_pay)
VALUES ('$date', '$hours', '$weekend', '$userID', '$pay')";



if ($conn->query($sql) === TRUE) {
  recordUse($fname, $dttime, $startTime, time(), $userID, "recordSuccess");
  echo "New record created successfully";
} else {
  recordUse($fname, $dttime, $startTime, time(), $userID, "recordFail");
  echo "Error: " . $sql . "<br>" . $conn->error;
}

echo "45";


?>

<form id="myForm" action="../info/shortdata.php" method="post">
<?php
        echo '<input type="hidden" name="'.'userid'.'" value="'.$userid.'">';
?>
</form>
<script type="text/javascript">
    document.getElementById('myForm').submit();
</script>

<!--
<script type="text/JavaScript">
    location.replace("https://xerwai.com/paytracking/info/shortdata.php");
</script>
-->



</body>
</html>


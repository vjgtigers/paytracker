

<?php

$user = htmlspecialchars($_POST["username"]);
$pass = htmlspecialchars($_POST["password"]);


$startTime = time();
$dttime = date("Y-m-d H:i:s",$startTime);
$fname = "loginPage";
include '../config.php';

include '../recordTime.php';


$userID = $user;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  recordUse($fname, $dttime, $startTime, time(), $userID, "connFail");
  die("Connection failed: " . $conn->connect_error);
}

$user2 = "sdfhh9849hasodf98hfkajsldhf84hf8hawedfkhsp89h4f";
$pass2 = "89hdf98h378hf4uhndiufh9438ry4978fh49hf489hf984h";
$user_id = "sdnf873nbf";
$result = $conn->execute_query('SELECT username, password, user_id FROM locationtracking.account_info WHERE username = ?', [$user]);
 while ($row = $result->fetch_assoc()) {
  $user2 = $row["username"];
  $pass2 = $row["password"];
  $user_id = $row["user_id"];

}

if ($user == $user2 and $pass == $pass2) {

 $subject = uniqid('', true);
 $uuid = str_replace('.', 'xer', $subject);
 $cookie_name = "XERWAILOGIN";
 $cookie_value = "John Doe";
 setcookie($cookie_name, $uuid, time() + (86400 * 30), "/");

 $sql = "INSERT INTO locationtracking.cookies_table (cookie, search_id) VALUES ('$uuid', '$user_id')";
if ($conn->query($sql) === TRUE) {
  recordUse($fname, $dttime, $startTime, time(), $userID, "loginSuccess");
  echo "New record created successfully";
  $conn->close();
  header("Location: https://xerwai.com/paytracking/info");
  die();
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;


}

} else {
recordUse($fname, $dttime, $startTime, time(), $userID, "loginFail");
echo "login failed. please click here to try again.";


}
$conn->close();
?>
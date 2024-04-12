<!DOCTYPE html>
<html>
<body>

<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet" href="../../style.css">

</head>

<body>
<ul>
  <li><a href="https://xerwai.com">Home</a></li>
  <li><a href="../../locate">Location Tracking</a></li>
  <li><a href="../">Payment Info</a></li>
  <li><a href="../../help">Help</a></li>
</ul>



<?php
$w = htmlspecialchars($_POST["userid"]);
echo 'USERID:'.$w;
header("Location: index.php");
die();




echo "<br>";

include '../config.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, date_info, hours FROM past_payment_data WHERE user_id='".$w."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Date: " . $row["date_info"]. " - Hours " . $row["hours"] ."<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>


</body>
</html>
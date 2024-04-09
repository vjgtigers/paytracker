




<!DOCTYPE html>
<html>

<head>

<meta name="viewport" content="width=240,user-scalable=no" />

<style>
body {
  background-color: gray;
}

h1 {
  color: maroon;
  margin-left: 40px;
}
div, form, label, input, h2 {
  margin: auto;
  padding: 10px;
}


</style>
</head>

<body>

<p id="redirect_reason"></p>
<h2>Paytracking Login</h2>


<div>

<form action="./action_page.php" method="post">
  <input type="text" id="username" name="username" placeholder="Username"><br>
  <input type="password" id="password" name="password" placeholder="Password"><br><br>
  <input type="submit" value="Submit">
</form> 
</div>

<script>
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
console.log(urlParams.has('r'));
if (urlParams.has('r') == true) {

if (urlParams.get('r') == "1") {

document.getElementById("redirect_reason").innerHTML = 'Attempted to view info page without logging in. <br>Please login';

} else if (urlParams.get('r') == "2") {

document.getElementById("redirect_reason").innerHTML = 'Successfully logged out. <br>Please come again';

} else if (urlParams.get('r') == "3") {

document.getElementById("redirect_reason").innerHTML = 'Session no longer valid. Please log back in';

}

console.log("tset sucessuf");


}

</script>

</body>
</html>


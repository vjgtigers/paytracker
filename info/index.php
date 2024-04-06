<!DOCTYPE html>
<html>
<body>

<!DOCTYPE html>
<html>

<!-- change quick fiance to quick info and also display if there is work today-->
<!-- add individal box for work today. one line  - time - hr - expected pay? -->


<head>

<link rel="stylesheet" href="./style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>

<body>

<div id="navBar">
<ul>
  <li><a href="https://xerwai.com">Home</a></li>
  <li><a href="../">Payment Info</a></li>
  <li><a href="../account">Account Info</a></li>
  <li><a href="../../help">Help</a></li>
  <li id="right_align"><p>userid</p></li>
</ul>
</div>
<p id="fail_writer"></p>



<!-- Quick finance can show just 3 lines and they are tim euntill next pay and amount with an in progress for the week that is still being counted -->
<!-- prevent sql injections and divs inside divs to create boxes in teh boxes -->
<!-- text color for extended info with green and red -->


<div id="mainContainer">
  <div id="one" class='box_test'><p class="centerme">Quick Finance Information <br> Past 7 Days</p><p id="qf_info" class="centerme">Loading...</p></div>
  <div id="two" class="box_test"><p class="centerme">Upcoming Work Days</p><p id="future" class="centerme">Loading...</p></div>
  <div id="three" class="box_test"><p class="centerme">Recent Work Days (week)</p><p id="recent" class="centerme">Loading...</p></div>
  <div id="four" class="box_test"><p class="centerme">Extended Finance Info <br>YTD</p><p id="ef_info" class="centerme">Loading...</p></div>
  <div id="six" class="box_test"><p class="centerme">V 1.1.0</p><p class="centerme">Donations:<br> <a href="../donations">CLICK ME</a><br>----------<br>Developed by Vaughn Gugger<br><a href="https://github.com/vjgtigers/paytracker">Github</a><br></div>
</div>






<script>

$.getJSON("userCall.php", function(data){
 console.log(data);
document.getElementById("right_align").innerHTML="User: " + data;


});

console.log("RECENT WORK DAYS begin");
<!-- http://www.mustbebuilt.co.uk/jquery-introduction/ajax-getjson-jquery-get-jquery-post-load/ -->
$.getJSON('recentCall.php', function(data) {
    document.getElementById("recent").innerHTML= JSON.stringify(data);
if (data != "0 results" && data != "NOT_LOGGED_IN") {
    var br = "<br>";
    var str1 = ""
    for (var i=0; i < data.length; i++) {
        <!-- console.log("Date: "+data[i].date_info +" Hours: " + data[i].hours + br); -->
        
        str1 = str1.concat("Date: "+data[i].date_info +", Hours: " + data[i].hours + br);
}
    document.getElementById("recent").innerHTML= (str1);

} else if (data == "0 results") {
    document.getElementById("recent").innerHTML= ("No Recent Work Days");

} else if (data == "NOT_LOGGED_IN") {
    window.location.replace("https://xerwai.com/paytracking/login/?r=1");
    document.getElementById("recent").innerHTML= ("Not Logged In");

} else {
    document.getElementById("recent").innerHTML= ("Unknown Error");

}
console.log("RECENT WORK DAYS over in");
});
console.log("RECENT WORK DAYS over out");




console.log("FUTURE WORK DAYS begin");
<!-- http://www.mustbebuilt.co.uk/jquery-introduction/ajax-getjson-jquery-get-jquery-post-load/ -->
$.getJSON('futureCall.php', function(data) {
    document.getElementById("future").innerHTML= JSON.stringify(data);
console.log(data);
if (data != "0 results" && data != "NOT_LOGGED_IN") {
    var br = "<br>";
    var str1 = ""
    for (var i=0; i < data.length; i++) {
        length = parseFloat(data[i].length.split(':')[0]) + parseFloat(data[i].length.split(':')[1])/60;
        if (Number.isInteger(length)) {
           length = length + '';
           length = length.split(".");
} else {
    length = length.toPrecision(3);

}





        const date2 = Math.floor(new Date(data[i].date_info).getTime()) + 14400000
        var date_choice = "";
        var today = new Date()
        today = today.setHours(0,0,0,0);
        var tmrw = today + 86400000

    if (today ==  date2) {
        var date_choice = "TDY";
} else if (tmrw ==  date2) {
        var date_choice = "TMRW";


} else {
date_choice = data[i].date_info.slice(5)

}
time = (data[i].start_time).split(' ')[1];
time_split = time.split(':');
if (time_split[1] == "00" && time_split[2] == "00") {
time = time_split[0];
} else if (time_split[2] == "00") {
time = time_split[0] + ":" + time_split[1];

} else { time = time}




        str1 = str1.concat("Date: " + date_choice + ", Start: " + time + ", Len: " + length  + " <br>"       );
<!-- str1 = str1.concat(JSON.stringify(data[i])); -->

}
    document.getElementById("future").innerHTML= (str1);

} else if (data == "0 results") {
    document.getElementById("future").innerHTML= ("No Upcoming Work Days");

} else if (data == "NOT_LOGGED_IN") {
window.location.replace("https://xerwai.com/paytracking/login/?r=1");
document.getElementById("future").innerHTML= ("Not Logged In");
 

} else {
document.getElementById("future").innerHTML= ("Unknown Error " + data + " !");
 
}




console.log("FUTURE WORK DAYS over in");
});
console.log("FUTURE WORK DAYS over out");









console.log("QF begin");
<!-- http://www.mustbebuilt.co.uk/jquery-introduction/ajax-getjson-jquery-get-jquery-post-load/ -->
$.getJSON('QfinanceCall.php', function(data) {
    document.getElementById("qf_info").innerHTML= JSON.stringify(data);
if (data != "0 results" && data != "NOT_LOGGED_IN") {
    document.getElementById("qf_info").innerHTML= JSON.stringify(data);
    var str2 = '';
    console.log(data[5]);
    var str2 = str2.concat("Hours worked: "+data[1].toFixed(2) +
                            '<br>'+ "Gross: $"       +   '<span style="color: yellow; font-weight: 600">'   + data[0].toFixed(2) + '</span>' + 
                            "<br>"+ "Tax W/H: $" + '<span style="color: red; font-weight: 600">' + Math.round(data[5] * 100) / 100 + '</span>'+ 
                            "<br>" + "Net: $" +'<span style="color: green; font-weight: 600">' + data[4].toFixed(2) + '</span>' +"<br>" + data[2]);








    document.getElementById("qf_info").innerHTML= str2;
} else if (data == "0 results") {
    document.getElementById("qf_info").innerHTML= ("No Work In Past Week");

} else if (data == "NOT_LOGGED_IN") {
window.location.replace("https://xerwai.com/paytracking/login/?r=1");
document.getElementById("qf_info").innerHTML= ("Not Logged In");
 

} else {
document.getElementById("qf_info").innerHTML= ("Unknown Error " + data + " !");
 
}




console.log("QF over in");
});
console.log("QF over out");








console.log("EF begin");
<!-- http://www.mustbebuilt.co.uk/jquery-introduction/ajax-getjson-jquery-get-jquery-post-load/ -->
$.getJSON('LfinanceCall.php', function(data) {
    document.getElementById("ef_info").innerHTML= JSON.stringify(data);
if (data != "0 results" && data != "NOT_LOGGED_IN") {
    console.log(data);
    document.getElementById("ef_info").innerHTML= JSON.stringify(data);
    var str2 = '';
    var str2 = str2.concat("Hours worked: "+data[1].toFixed(2) +
                '<br>'+ "Gross: $"       +   '<span style="color: yellow; font-weight: 600">'   + data[0].toFixed(2) + '</span>' + 
				"<br>" + "Tax: $" +  '<span style="color: red; font-weight: 600">'   + data[4].toFixed(2) + '</span>' + 
				"<br>" + "Net: $" +  '<span style="color: green; font-weight: 600">'   + data[3].toFixed(2) + '</span>'

);






    document.getElementById("ef_info").innerHTML= str2;
} else if (data == "0 results") {
    document.getElementById("ef_info").innerHTML= ("No Past Info");

} else if (data == "NOT_LOGGED_IN") {
window.location.replace("https://xerwai.com/paytracking/login/?r=1");
document.getElementById("ef_info").innerHTML= ("Not Logged In");
 

} else {
document.getElementById("ef_info").innerHTML= ("Unknown Error " + data + " !");
 
}




console.log("EF over in");
});
console.log("EF over out");




































</script>



</body>
</html>

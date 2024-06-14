<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>City Information</title> <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-
rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script>
function city(event, input) { // Check if the Enter key is pressed
if (event.keyCode === 13) { // Trim and get the search term from the input
var searchIn = input.value.trim();
if (searchIn === "") { // If the search term is empty, clear the "data" div and return
document.getElementById("data").innerHTML = "";
return;
}
// Create an XMLHttpRequest object
const xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() { // Check if the request is complete and successful
if (this.readyState === 4 && this.status === 200) { // Update the "data" div with the response from the server
document.getElementById("data").innerHTML = this.responseText;
}
}; // Send a GET request to "data.php" with the search term as a query parameter
xhr.open("GET", "data.php?q=" + searchIn, true);
xhr.send();
}
}
</script>
</head>
<body>
<div class="container-fluid">
<div class="row">
<div class="col-md-1">&nbsp;</div>
<div class="col-md-10">
<h4 class="text-center">City Information</h4>
<div class="container">
<h4 class="text text-primary">
<div class="row">
<div class="col-md-4">Search Cities:</div>
<div class="col-md-8">
<input type="text" id="search" class="form-control" onkeyup="city(event, this)" />
</div>
</div>
</h4>
<hr />
<div id="data"></div>
</div>
</div>
<div class="col-md-1">&nbsp;</div>
</div>
</div>
</body>
</html>
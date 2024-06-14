<?php
$cityInput = $_GET['q']; // Get the search term from the query parameter 'q'
$curl = curl_init();
// Set the cURL options
curl_setopt_array($curl, [
CURLOPT_URL => "https://city-and-state-search-api.p.rapidapi.com/search?q=$cityInput",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => [
"X-RapidAPI-Host: city-and-state-search-api.p.rapidapi.com",
"X-RapidAPI-Key: 424c761662msh6f46569e66cfcd5p185bc7jsn3a44bcd041ed"
],
]);
$response = curl_exec($curl); // Execute the cURL request $error = curl_error($curl); // Get any cURL errors
curl_close($curl); // Close the cURL session
if ($error) { echo "cURL Error #:" . $error; // If there is an error, display the error message
} else { $c = json_decode($response, true); // If successful, decode the response JSON into an array
}
?>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<title>City Details</title>
</head>
<body>
<div class="container-fluid">
<table class="table">
<tr>
<th>ID</th>
<th>City Name</th>
<th>State Name</th>
<th>Country Name</th>
<th></th>
</tr>
<?php foreach ($c as $v) { ?>
<tr>
<td><?php echo $v['id']; ?></td>
<td><?php echo $v['name']; ?></td>
<td>
<?php
if (isset($v['state_name'])) {
echo $v['state_name'];
}
else {
echo 'No data available';
}
?>
</td>
<td>
<?php
if (isset($v['country_name'])) {
echo $v['country_name'];
}
else {
echo 'No data available';
}
?>
</td>
<td><a href="citydetails.php?q=<?php echo $v['id'];?>"><?php echo '<button type="button" class="btn btn-success">City Details</button>'; ?></a></td>
</tr>
<?php } ?>
</table>
</div>
</body>
</html>
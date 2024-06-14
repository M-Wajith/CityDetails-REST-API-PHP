<?php $city = $_GET['q']; // Get the city ID from the query parameter 'q'
$curl = curl_init();
// Set the cURL options
curl_setopt_array($curl, [
CURLOPT_URL => "https://city-and-state-search-api.p.rapidapi.com/cities/$city",
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
} else { $cityDetails = json_decode($response, true); // If successful, decode the response JSON into an array
}
function displayData($label, $value)
{
echo '<tr>
<th>' . $label . ':</th>
<th>' . $value . '</th>
</tr>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<title>City Details</title>
</head>
<body>
<div class="container-fluid">
<hr />
<h2 class="text-center">City Information</h2>
<hr />
<div>
<div class="row">
<div class="col-2">&nbsp;</div>
<div class="col-8">
<div class="clearfix">&nbsp;</div>
<table class="table table-striped">
<?php
$data = [
['City ID', $cityDetails['id']],
['City Name', $cityDetails['name']],
['State Name', $cityDetails['state_name'] ?? 'No data available'],
['Country Name', $cityDetails['country_name'] ?? 'No data available'],
];
foreach ($data as $row) {
displayData($row[0], $row[1]); // Display each data row using the displayData function
}
?>
<tr>
<th>Country Flag:</th>
<th>
<?php // Display the country flag image using the country code and name
echo "<img src='https://flagcdn.com/w320/" . strtolower($cityDetails['country_code']) . ".png' alt='" . $cityDetails['country_name'] . " Flag' width='100' height='50'>";
?>
</th>
</tr>
<tr>
<th colspan="2"> <!-- Embed a Google Maps iframe with the city's location -->
<iframe
width="100%"
height="250"
frameborder="1" style="border:1"
referrerpolicy="no-referrer-when-downgrade"
src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBaO3HAAYEDQw9mBMHxKpN8G2PHX4X5iuI&q=php echo urlencode($cityDetails['name'] . ', ' . $cityDetails['country_name']); ?>&zoom=12"
allowfullscreen>
</iframe>
</th>
</tr>
</table>
</div>
</div>
</div>
</div>
</body>
</html>
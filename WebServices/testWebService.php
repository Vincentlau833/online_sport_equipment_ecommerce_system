<!DOCTYPE html>
<html lang="en">
<head>
<title>Rest API Client Side Demo</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<h2>Rest API Client Side Demo</h2>
<form class="form-inline" action="" method="POST">
<div class="form-group">
<label for="name">Name</label>
<input type="text" name="productName" class="form-control"  placeholder="Enter Product Name" required/>
</div>
<button type="submit" name="submit" class="btn btn-default">Submit</button>
</form>
<p>&nbsp;</p>
<h3>
<?php
        if (isset($_POST['submit'])) {
          $productName = $_POST['productName'];

          $url = "http://localhost/SweatLab/WebServices/searchAPI.php?productName=" . $productName;

          $client = curl_init($url);
          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($client);

          $result = json_decode($response);

          print_r($result->data);
        }
        ?>
</h3>
</div>
</body>
</html>



<?php
include("databaseConnection.php");

echo '<head>
    <title>Frames | AudioVizzion</title>
    <link rel="stylesheet" type="text/css" href="devicepage.css">
    <link rel="stylesheet" type="text/css" href="fonts.css">
</head>

<body>
    <div class="background" style="background: url(images/device.jpg); background-size: cover;">
      <a href="homepage.html">
            <div class="home"></div>
        </a>
        <div class="container">';

// store values from the form into variables
$var_dName = $_POST['dName'];
$var_dDescrip = $_POST['dDescrip'];
$var_aStatus = $_POST['aStatus'];
$var_lensSerialNo = $_POST['lensSerialNo'];
$var_visionType = $_POST['visionType'];
$var_tint = $_POST['tint'];
$var_thinnessLevel = $_POST['thinnessLevel'];

// validation
if (empty($var_dName) or empty($var_dDescrip) or empty($var_lensSerialNo) or empty($var_tint)) {
  echo '<p class="error-message">"Please ensure that all fields are filled in!"</p>';
} else {
  $addDevice =
    "insert into 
            audio_vizzion.device (deviceCatalogName, deviceDescription, availabilityStatus)
            values ('" . $var_dName . "','" . $var_dDescrip . "', '" . $var_aStatus . "');";

  //run device SQL query
  $execAddDevice = mysqli_query($connection, $addDevice);

  // saving last auto incremented id to a variable
  $last_catalog_id = mysqli_insert_id($connection);
  $addLens =
    "insert into 
    audio_vizzion.visual_device (deviceCatalogId, lensFlag, lensSerialNb, lensVisionType, 
    lensTint, lensThinnessLevel, frFlag)
    values ('.$last_catalog_id.', '1', '".$var_lensSerialNo."', '".$var_visionType."', '".$var_tint."', '".$var_thinnessLevel."', '0');";

  // run hearing device SQL query
  $execAddLens = mysqli_query($connection, $addLens);

  if (mysqli_errno($connection) == 0) {
    echo "<p class='success-message'>A new hearing aid has been added successfully</p>";
    echo "<p class='details'>Added Name: " . $var_dName . "</p>";
    echo "<p class='details'>Added Description: " . $var_dDescrip . "</p>";
    echo "<p class='details'>Added Availability Status: " . $var_aStatus . "</p>";
    echo "<p class='details'>Added Serial Number: " . $var_lensSerialNo . "</p>";
    echo "<p class='details'>Added Vision Type: " . $var_visionType . "</p>";
    echo "<p class='details'>Added Tint : " . $var_tint . "</p>";
    echo "<p class='details'>Added Thinness Level : " . $var_thinnessLevel . "</p>";
  } else {
    echo '<p class="error-message" style="margin-top: 45%;">There is an error with the lens you entered."</p>';

    if (mysqli_errno($connection) == 1062) {
      echo '<p class="error-message">"The value entered for the new catalog id is not valid as it is already used."</p>';
    }

    if (mysqli_errno($connection) == 1064) {
      echo '<p class="error-message">"Values entered for the lens details are not valid."</p>';
    }
  }
}
echo '</div>
    </div>';
?>
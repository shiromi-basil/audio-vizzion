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
$var_frBrand = $_POST['frBrand'];
$var_frModel = $_POST['frModel'];

// validation
if (empty($var_dName) or empty($var_dDescrip) or empty($var_frBrand) or empty($var_frModel)) {
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
  $addFrame =
    "insert into 
    audio_vizzion.visual_device (deviceCatalogId, lensFlag, frFlag,
    frBrand, frModel)
    values ('.$last_catalog_id.', '0', '1', '" . $var_frBrand . "', '" . $var_frModel . "');";

  // run hearing device SQL query
  $execAddFrame = mysqli_query($connection, $addFrame);

  if (mysqli_errno($connection) == 0) {
    echo "<p class='success-message'>A new hearing aid has been added successfully</p>";
    echo "<p class='details'>Added Name: " . $var_dName . "</p>";
    echo "<p class='details'>Added Description: " . $var_dDescrip . "</p>";
    echo "<p class='details'>Added Availability Status: " . $var_aStatus . "</p>";
    echo "<p class='details'>Added Brand: " . $var_frBrand . "</p>";
    echo "<p class='details'>Added Model : " . $var_frModel . "</p>";
  } else {
    echo '<p class="error-message" style="margin-top: 45%;">There is an error with the frame you entered."</p>';

    if (mysqli_errno($connection) == 1062) {
      echo '<p class="error-message">"The value entered for the new catalog id is not valid as it is already used."</p>';
    }

    if (mysqli_errno($connection) == 1064) {
      echo '<p class="error-message">"Values entered for the frame details are not valid."</p>';
    }
  }
}
echo '</div>
    </div>';
?>
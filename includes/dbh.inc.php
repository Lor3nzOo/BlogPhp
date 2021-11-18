<?php

$serverName = "localhost:8585";
$dBUsername = "root";
$dBPassword = "";
$dBName = "medmelon";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn){
    die("Veza nije uspostavljena: ".mysqli_connect_error());
}

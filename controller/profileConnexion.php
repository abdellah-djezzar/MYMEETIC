<?php
require_once "Profile.php";

$profile = new Profile();
$result = $profile->organizeResponseConnexion();
echo json_encode($result);

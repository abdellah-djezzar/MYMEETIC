<?php
require_once "Profile.php";

$profile = new Profile();
$result = $profile->organizeResponsePersonnal();
echo json_encode($result);

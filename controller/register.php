<?php
require_once "Register.php";

$register = new Register();
$result = $register->organizeResponse();
echo json_encode($result);

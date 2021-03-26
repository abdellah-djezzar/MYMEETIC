<?php

require_once "Register.php";

$register = new Register();
$result = $register->connexionResponse();
echo json_encode($result);

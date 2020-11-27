<?php
session_start();
require_once ('vendor/autoload.php');
require_once ('app/Bootstrap/bootstrap.php');
$uri = trim($_SERVER['REQUEST_URI'] ,'/');
switch ($uri) {
  case 'convert':
    require_once ('app/Views/convert.php');
    break;
  case '':
    require_once ('app/Views/index.php');
    break;
  case 'result':
    require_once ('app/Views/result.php');
    break;
}
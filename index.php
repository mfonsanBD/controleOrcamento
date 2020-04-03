<?php 
session_start();
use \Core\Core;
require 'configuracao.php';
require 'routers.php';

require 'vendor/autoload.php';

$core = new Core();
$core->run();
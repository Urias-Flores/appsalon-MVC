<?php
require __DIR__ . '/../vendor/autoload.php';

$env = \Dotenv\Dotenv::createImmutable(__DIR__);
$env->safeLoad();

require 'funciones.php';
require 'database.php';

use Model\ActiveRecord;
ActiveRecord::setConnection($Connection);
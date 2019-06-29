<?php

require_once 'vendor/autoload.php';


include 'src/routes.php';
include 'src/Controllers/DatabaseController.php';


$db = new DatabaseController(getenv('SERVER'), getenv('DATABASE'), getenv('USERNAME'), getenv('PASSWORD') );
$db->connect();


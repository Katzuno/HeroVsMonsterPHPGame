<?php
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__.'/.env');

include 'src/Models/Hero.php';
include 'src/Models/Monster.php';
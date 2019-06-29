<?php

require_once 'vendor/autoload.php';
include 'config.php';

include 'src/routes.php';
include 'src/Controllers/DatabaseController.php';



$db = new DatabaseController(getenv('SERVER'), getenv('DATABASE'), getenv('USER'), getenv('PASSWORD') );
$db->connect();


include 'src/DatabaseMigrations/create_skill_table.php';
include 'src/DatabaseMigrations/create_hero_table.php';
include 'src/DatabaseMigrations/create_monster_table.php';


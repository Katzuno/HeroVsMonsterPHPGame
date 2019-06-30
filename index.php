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


include 'src/Controllers/HeroFactory.php';
echo '<br/><br/>';
//$hero = HeroFactory::create($db, 'Orderus', 70, 100, 70, 80, 45, 55, 40, 50, 10, 30);
$hero = HeroFactory::getHeroByName($db, 'Orderus');
echo '<br/><br/>';
print_r($hero);
echo '<br/><br/>';
$hero = HeroFactory::updateAttributes($db, $hero);
echo '<br/><br/>';
print_r($hero);
include 'src/Controllers/MonsterFactory.php';
echo '<br/>---------- MONSTER -------<br/>';
$monster = MonsterFactory::create($db, 'Wild Beast', 60, 90, 40, 60, 40, 60, 40, 60, 25, 40);
//$monster = MonsterFactory::getMonsterByName($db, 'Wild Beast');
echo '<br/><br/>';
print_r($monster);
echo '<br/><br/>';
$monster = MonsterFactory::updateAttributes($db, $monster);
echo '<br/><br/>';
print_r($monster);


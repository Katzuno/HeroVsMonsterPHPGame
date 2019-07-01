<?php
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__.'/.env');


include 'src/Controllers/DatabaseController.php';
$db = new DatabaseController(getenv('SERVER'), getenv('DATABASE'), getenv('USER'), getenv('PASSWORD') );
$db->connect();

include 'src/Models/Entity.php';
include 'src/Models/Hero.php';
include 'src/Models/Monster.php';
include 'src/Models/Battle.php';
include 'src/Models/Skill.php';

include 'src/DatabaseMigrations/create_skill_table.php';
include 'src/DatabaseMigrations/create_hero_table.php';
include 'src/DatabaseMigrations/create_monster_table.php';

include 'src/Controllers/SkillFactory.php';
include 'src/Controllers/HeroFactory.php';
include 'src/Controllers/MonsterFactory.php';
include 'src/Controllers/GameFactory.php';

include 'src/routes.php';



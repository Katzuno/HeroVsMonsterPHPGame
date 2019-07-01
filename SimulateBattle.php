<?php

echo '<br/><br/>';
//$hero = HeroFactory::create($db, 'Orderus', 70, 100, 70, 80, 45, 55, 40, 50, 10, 30);
$hero = HeroFactory::getHeroByName($db, 'Orderus');
$hero = HeroFactory::updateAttributes($db, $hero);
echo '<br/><br/>';
print_r($hero);
echo '<br/>---------- MONSTER -------<br/>';
//$monster = MonsterFactory::create($db, 'Wild Beast', 60, 90, 40, 60, 40, 60, 40, 60, 25, 40);
$monster = MonsterFactory::getMonsterByName($db, 'Wild Beast');
echo '<br/><br/>';
//print_r($monster);
echo '<br/><br/>';
$monster = MonsterFactory::updateAttributes($db, $monster);
echo '<br/><br/>';
print_r($monster);

// 0 means attack skill ; 1 means defend skill
//$skill1 = SkillFactory::create('Rapid Strike', 10, 1, 'Strike twice while it’s his turn to attack');
//$skill2 = SkillFactory::create('Magic Shield', 20,0, 'Takes only half of the usual damage when an enemy attacks');

//HeroFactory::addSkill($db, $hero, $skill1);
//HeroFactory::addSkill($db, $hero, $skill2);

HeroFactory::updateSkills($db, $hero);

echo "<br/> ============ BATTLE START ============== <BR/>";
$battle = new Battle($hero, $monster);
$battle->start();

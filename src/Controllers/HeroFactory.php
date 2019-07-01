<?php



class HeroFactory
{
    public static function create(DatabaseController $db, $name, $healthMin, $healthMax, $strengthMin, $strengthMax, $defMin, $defMax, $speedMin, $speedMax, $luckMin, $luckMax)
    {
        try
        {
        $sql = "INSERT INTO " . getenv('HERO_TABLE') . " (" . getenv('ENTITY_SQL_INSERT_COLUMNS') . ") VALUES (
            '$name', $healthMin, $healthMax, $strengthMin, $strengthMax,
            $defMin, $defMax, $speedMin, $speedMax, $luckMin, $luckMax
        )";

        $db->executeQuery($sql);

        if ( getenv('DEBUG_MODE') == 'true')
        {
            echo "<br/>Query is $sql<br/>";
        }

        $hero = new Hero($name, rand($healthMin, $healthMax), rand($strengthMin, $strengthMax), rand($defMin, $defMax), rand($speedMin, $speedMax), rand($luckMin, $luckMax));
        return $hero;
        }
        catch (PDOException $e)
        {
            echo 'Error: ' . $e->errorInfo;
            return 0;
        }
    }

    public static function getHeroByName(DatabaseController $db, $name)
    {
        try
        {
            $sql = "SELECT " . getenv('ENTITY_SQL_SELECT_ATTRIBUTE_COLUMNS') . " FROM " . getenv('HERO_TABLE') . " WHERE name = '$name' LIMIT 1";
            $hero_ranges= $db->select($sql)[0];
            $hero = new Hero($name, rand($hero_ranges['health_min'], $hero_ranges['health_max']), rand($hero_ranges['strength_min'], $hero_ranges['strength_max']), rand($hero_ranges['defence_min'], $hero_ranges['defence_max']), rand($hero_ranges['speed_min'], $hero_ranges['speed_max']), rand($hero_ranges['luck_min'], $hero_ranges['luck_max']));
            HeroFactory::updateSkills($db, $hero);
            return $hero;
        }
        catch (PDOException $e)
        {
            echo 'Error: ' . $e->errorInfo;
            return 0;
        }
    }
    public static function updateAttributes(DatabaseController $db, Hero $hero)
    {
        try
        {
            $sql = "SELECT " . getenv('ENTITY_SQL_SELECT_ATTRIBUTE_COLUMNS') . "
                    FROM " . getenv('HERO_TABLE') . " WHERE name = '" . $hero->getName() . "' LIMIT 1";

            $hero_ranges = $db->select($sql)[0];
            echo '<br/><br/>';
            //print_r($hero_ranges);
            echo '<br/><br/>';
            $hero->setHealth(rand($hero_ranges['health_min'], $hero_ranges['health_max']) );
            $hero->setStrength(rand($hero_ranges['strength_min'], $hero_ranges['strength_max']) );
            $hero->setDefence(rand($hero_ranges['defence_min'], $hero_ranges['defence_max']) );
            $hero->setLuck(rand($hero_ranges['luck_min'], $hero_ranges['luck_max']) );
            $hero->setSpeed(rand($hero_ranges['speed_min'], $hero_ranges['speed_max']) );
            return $hero;

        }
        catch (PDOException $e)
        {
            echo 'Error: ' . $e->errorInfo;
            return 0;
        }
    }

    public static function updateSkills(DatabaseController $db, Hero $hero)
    {
        try
        {
            // GET HERO ID
            $sql = "SELECT id FROM " . getenv('HERO_TABLE') . " WHERE name = '" . $hero->getName() . "' LIMIT 1";

            $heroId = HeroFactory::getHeroId($db, $hero);

            $sql = "SELECT name, chance, description, type, multiplier FROM " . getenv('SKILL_TABLE') . " WHERE hero_id = $heroId";

            $skills = $db->select($sql);
            echo "<br/><br/>";
            print_r($skills);
            foreach ($skills as $sk)
            {
                $skill = SkillFactory::create($sk['name'], $sk['chance'], $sk['type']);
                $skill->setDescription($sk['description']);
                $skill->setMultiplier($sk['multiplier']);
                $hero->addSkill($skill);
            }
            return $hero;

        }
        catch (PDOException $e)
        {
            echo 'Error: ' . $e->errorInfo;
            return 0;
        }
    }


    public static function addSkill(DatabaseController $db, Hero &$hero, Skill $skill)
    {
        try
        {
            // GET HERO ID

            $heroId = HeroFactory::getHeroId($db, $hero);

            $sql = "INSERT INTO  " . getenv('SKILL_TABLE') . "(name, chance, description, hero_id) VALUES ('" . $skill->getName() . "', " . $skill->getChance() . ", '" . $skill->getDescription() . "'," . $heroId . " )";

            $db->executeQuery($sql);

            $hero->addSkill($skill);
        }
        catch (PDOException $e)
        {
            echo 'Error: ' . $e->errorInfo;
        }
    }

    private static function getHeroId(DatabaseController $db, Hero $hero)
    {
        $sql = "SELECT id FROM " . getenv('HERO_TABLE') . " WHERE name = '" . $hero->getName() . "' LIMIT 1";

        $heroId = $db->select($sql)[0]['id'];
        return $heroId;
    }
}
<?php



class HeroFactory
{
    public static function create(DatabaseController $db, $name, $healthMin, $healthMax, $strengthMin, $strengthMax, $defMin, $defMax, $speedMin, $speedMax, $luckMin, $luckMax)
    {
        try
        {
        $sql = "INSERT INTO " . getenv('HERO_TABLE') . " (" . getenv('HERO__SQL_INSERT_COLUMNS') . ") VALUES (
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
            $sql = "SELECT " . getenv('HERO__SQL_SELECT_ATTRIBUTE_COLUMNS') . " FROM " . getenv('HERO_TABLE') . " WHERE name = '$name' LIMIT 1";
            $hero_ranges= $db->select($sql)[0];
            $hero = new Hero($name, rand($hero_ranges['health_min'], $hero_ranges['health_max']), rand($hero_ranges['strength_min'], $hero_ranges['strength_max']), rand($hero_ranges['defence_min'], $hero_ranges['defence_max']), rand($hero_ranges['speed_min'], $hero_ranges['speed_max']), rand($hero_ranges['luck_min'], $hero_ranges['luck_max']));
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
            $sql = "SELECT " . getenv('HERO__SQL_SELECT_ATTRIBUTE_COLUMNS') . "
                    FROM " . getenv('HERO_TABLE') . " WHERE name = '" . $hero->getName() . "' LIMIT 1";

            $hero_ranges = $db->select($sql)[0];
            echo '<br/><br/>';
            print_r($hero_ranges);
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
}
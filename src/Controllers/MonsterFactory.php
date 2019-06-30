<?php



class MonsterFactory
{
    public static function create(DatabaseController $db, $name, $healthMin, $healthMax, $strengthMin, $strengthMax, $defMin, $defMax, $speedMin, $speedMax, $luckMin, $luckMax)
    {
        try
        {
            $sql = "INSERT INTO " . getenv('MONSTER_TABLE') . " (" . getenv('ENTITY_SQL_INSERT_COLUMNS') . ") VALUES (
            '$name', $healthMin, $healthMax, $strengthMin, $strengthMax,
            $defMin, $defMax, $speedMin, $speedMax, $luckMin, $luckMax
        )";

            $db->executeQuery($sql);

            if ( getenv('DEBUG_MODE') == 'true')
            {
                echo "<br/>Query is $sql<br/>";
            }

            $monster = new Monster($name, rand($healthMin, $healthMax), rand($strengthMin, $strengthMax), rand($defMin, $defMax), rand($speedMin, $speedMax), rand($luckMin, $luckMax));
            return $monster;
        }
        catch (PDOException $e)
        {
            echo 'Error: ' . $e->errorInfo;
            return 0;
        }
    }

    public static function getMonsterByName(DatabaseController $db, $name)
    {
        try
        {
            $sql = "SELECT " . getenv('ENTITY_SQL_SELECT_ATTRIBUTE_COLUMNS') . " FROM " . getenv('MONSTER_TABLE') . " WHERE name = '$name' LIMIT 1";
            $monster_ranges= $db->select($sql)[0];
            $monster = new Monster($name, rand($monster_ranges['health_min'], $monster_ranges['health_max']), rand($monster_ranges['strength_min'], $monster_ranges['strength_max']), rand($monster_ranges['defence_min'], $monster_ranges['defence_max']), rand($monster_ranges['speed_min'], $monster_ranges['speed_max']), rand($monster_ranges['luck_min'], $monster_ranges['luck_max']));
            return $monster;
        }
        catch (PDOException $e)
        {
            echo 'Error: ' . $e->errorInfo;
            return 0;
        }
    }
    public static function updateAttributes(DatabaseController $db, Monster $monster)
    {
        try
        {
            $sql = "SELECT " . getenv('ENTITY_SQL_SELECT_ATTRIBUTE_COLUMNS') . "
                    FROM " . getenv('MONSTER_TABLE') . " WHERE name = '" . $monster->getName() . "' LIMIT 1";

            $monster_ranges = $db->select($sql)[0];
            echo '<br/><br/>';
            //($monster_ranges);
            echo '<br/><br/>';
            $monster->setHealth(rand($monster_ranges['health_min'], $monster_ranges['health_max']) );
            $monster->setStrength(rand($monster_ranges['strength_min'], $monster_ranges['strength_max']) );
            $monster->setDefence(rand($monster_ranges['defence_min'], $monster_ranges['defence_max']) );
            $monster->setLuck(rand($monster_ranges['luck_min'], $monster_ranges['luck_max']) );
            $monster->setSpeed(rand($monster_ranges['speed_min'], $monster_ranges['speed_max']) );
            return $monster;

        }
        catch (PDOException $e)
        {
            echo 'Error: ' . $e->errorInfo;
            return 0;
        }
    }
}
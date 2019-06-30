<?php

class SkillFactory
{
    /**
     * @param DatabaseController $db
     * @param $name
     * @param $chance
     * @param $type  BOOLEAN - 0 = attack, 1 = defend
     * @param string $desc
     * @return skill
     */
    public static function build (DatabaseController $db, $name, $chance, $type, $multiplier = 1, $desc = '')
    {
        $skill = new Skill($name, $chance, $type);
        $skill->setDescription($desc);
        $skill->setMultiplier($multiplier);
        $sql = "INSERT INTO " . getenv('SKILL_TABLE') . " (name, chance, description, type, multiplier) VALUES ('$name', $chance, '$desc', $type, $multiplier)";
        $db->executeQuery($sql);

        return $skill;
    }

    public static function create($name, $chance, $type, $multiplier = 1, $desc = '')
    {
        $skill = new Skill($name, $chance, $type);
        $skill->setDescription($desc);
        $skill->setMultiplier($multiplier);
        return $skill;
    }

}
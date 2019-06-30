<?php

class Hero extends Entity
{
    private $skills;

    /**
     * @return mixed
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param mixed $skills
     */
    public function setSkills($skills): void
    {
        $this->skills = $skills;
    }

    public function addSkill($skill): void
    {
        $this->skills[] = $skill;
    }

}
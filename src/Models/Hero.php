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

    public function emptySkills()
    {
        $this->skills = [];
    }

    /**
     * @param $type - Can be 0 for attack ; 1 for defend
     */
    public function useSkills($type)
    {
        foreach ($this->skills as $sk)
        {
            if ($sk->getType() == $type)
            {
                if (rand(1, 100) <= $sk->getChance())
                {
                    if ($type == 0)
                    {
                        echo "<br/>";
                        echo "Attacker used skill " . $sk->getName() . ". As a result it <b>" . $sk->getDescription() . "</b>";
                        echo "<br/>";
                        return $sk->getMultiplier();
                    }
                    else
                    {
                        echo "<br/>";
                        echo "Defender used skill " . $sk->getName() . ". As a result it <b>" . $sk->getDescription() . "</b>";
                        echo "<br/>";
                        return 1 / $sk->getMultiplier();
                    }
                }
                else
                {
                    return 1; // Don't change anything
                }
            }
        }
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->getName(),
            'health' => $this->getHealth(),
            'strength' => $this->getStrength(),
            'defence' => $this->getDefence(),
            'speed' => $this->getSpeed(),
            'luck' => $this->getLuck(),
            'skills' => $this->getSkills()
        ];
    }

}
<?php

class Battle
{
    private $hero;
    private $monster;
    public function __construct(Hero $hero, Monster $monster)
    {
        $this->hero = $hero;
        $this->monster = $monster;
    }

    public function start()
    {
        // Decide first attacker
        // Fight has the parameters ATTACKER, DEFENDER

        $round = 1;
        $choice = $this->decideFirstAtacker();
        while (  ($this->isDead($this->monster) == false)  && ($this->isDead($this->hero) == false))
        {
            echo "<BR/> ================ ROUND $round ================ <br/>";
            echo "<BR/> MONSTER HEALTH: " . $this->monster->getHealth() . "<BR/>";
            echo "<BR/> HERO HEALTH: " . $this->hero->getHealth() . "<BR/>";
            if ($round == 1) {

                if ($choice == 'H')
                {
                    $this->fight($this->hero, $this->monster);
                }
                else {
                    $this->fight($this->monster, $this->hero);
                }
            }
            else
            {
                if ($choice == 'H') // If in the previous round the Hero was the one who attacked, NOW THE MONSTER WILL ATTACK
                {
                    $this->fight($this->monster, $this->hero);
                    $choice = 'M';
                }
                else
                {
                    $this->fight($this->hero, $this->monster);
                    $choice = 'H';
                }
            }
            $round++;
        }

        if ($this->isDead($this->monster) )
        {
            echo "<br/>";
            echo "CONGRATULATIONS! You won";
        }
        else
        {
            echo "<br/>";
            echo "GAME OVER! You lost";
        }
    }

    private function isDead(Entity $entity)
    {
        if ($entity->getHealth() <= 0)
        {
            return true;
        }
        return false;
    }

    private function fight(Entity $attacker, Entity &$defender)
    {
        $damage = $attacker->getStrength() - $defender->getDefence();
        $defender->setHealth($defender->getHealth() - $damage);
        echo '<BR/>--------<BR/>';
        echo $attacker->getName() . " has attacked and did <b>" . $damage . "</b> to the defender " . $defender->getName();
        echo '<BR/>';
        echo 'Attacker health is: ' . $attacker->getHealth() . " || <b> Defender Health is: " . $defender->getHealth() . "</b>";
        echo '<BR/>';
    }

    /**
     * If return == 'H' => HERO attacks first
     * If return == 'M' =>
     * @return String
     */
    private function decideFirstAtacker()
    {
        if ($this->hero->getSpeed() > $this->monster->getSpeed())
        {
            return 'H';
        }
        else if ($this->hero->getSpeed() < $this->monster->getSpeed())
        {
            return 'M';
        }
        else
        {
            if ($this->hero->getLuck() > $this->monster->getLuck())
            {
                return 'H';
            }
            else if ($this->hero->getLuck() < $this->monster->getLuck())
            {
                return 'M';
            }
        }
    }

}
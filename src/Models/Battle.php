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

    public function start($maxRounds = 20)
    {
        // Decide first attacker
        // Fight has the parameters ATTACKER, DEFENDER

        $round = 1;
        $choice = $this->decideFirstAtacker();
        while (  ($this->isDead($this->monster) == false)  && ($this->isDead($this->hero) == false) && $round <= $maxRounds)
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
        else if ( $this->isDead($this->hero) )
        {
            echo "<br/>";
            echo "GAME OVER! You lost";
        }
        if ($round >= $maxRounds)
        {
            echo "<br/>";
            echo "IT'S A TIE! Maximum number of rounds has been simulated";
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

    /**
     * Parameter 1 means defend ; parameter 0 means attack
     * @param Entity $attacker
     * @param Entity $defender
     */
    private function fight(Entity $attacker, Entity &$defender)
    {
        $damage = $attacker->getStrength() - $defender->getDefence();
        echo '<BR/>--------<BR/>';
        if ($damage < 0)
        {
            $damage = 0;
        }
        echo "<i> Old damage: $damage </i>";
        if ($attacker instanceof Hero)
        {
            //echo "<br/><br/>Intra in INSTANCEOF attacker<br/><br/>";
            $damage = $damage * $attacker->useSkills(0);
        }
        else if ($defender instanceof Hero)
        {
            //echo "<br/><br/>Intra in INSTANCEOF defender<br/><br/>";
            $damage = $damage * $defender->useSkills(1);
        }

        $defender->setHealth($defender->getHealth() - $damage);

        echo $attacker->getName() . " has attacked and did <b>" . $damage . "</b> to the defender " . $defender->getName();
        echo '<BR/>';
        echo 'Attacker health is: ' . $attacker->getHealth() . " || <b> Defender Health is: " . $defender->getHealth() . "</b>";
        echo '<BR/>';
        echo '<BR/>--------<BR/>';
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
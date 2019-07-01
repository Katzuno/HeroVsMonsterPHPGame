<?php

class GameFactory
{
    public static function createGame(Hero $hero, Monster $monster)
    {
        return new Battle($hero, $monster);
    }

}
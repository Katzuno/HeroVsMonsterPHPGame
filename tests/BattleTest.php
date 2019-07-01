<?php

use PHPUnit\Framework\TestCase;

class HeroTest extends TestCase
{
    /**
     * I will create tests just as a sketch because 'strong-testing' all CRUD operations for a 2 days project is not reliable
     * I will check just for status 200 (success) that will assure me at least I don't have Internal Server Errors AND
     * assertSuccessfull on booleans that should return true
     */

    /** @test */
    public function it_will_create_hero()
    {
        $response = $this->post('api/battle/start', [
            "heroName" => "Orderus",
            "monsterName" => "Wild Beast",
            "maxRounds" => 20
        ]);

        $response->assertStatus(200);
        $response->assertSuccessful();
    }

    /** @test */
    public function it_will_get_hero_attributes()
    {
        $response = $this->get('api/hero/getAttributes/Orderus');

        $response->assertStatus(200);

    }
}
?>
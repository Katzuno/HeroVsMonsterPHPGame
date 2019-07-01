<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class BattleTest extends TestCase
{
    /**
     * I will create tests just as a sketch because 'strong-testing' all CRUD operations for a 2 days project is not reliable
     * I will check just for status 200 (success) that will assure me at least I don't have Internal Server Errors AND
     * assertSuccessfull on booleans that should return true
     */
    private $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost:8000/api/battle/'
        ]);
    }

    /** @test */
    public function it_will_start_battle()
    {
        $response = $this->client->post('start',
            [
            'json' =>
            [
            "heroName" => "Orderus",
            "monsterName" => "Wild Beast",
            "maxRounds" => 20
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

}
?>
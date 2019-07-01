<?php


use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class SkillTest extends TestCase
{
    /**
     * I will create tests just as a sketch because 'strong-testing' all CRUD operations for a 2 days project is not reliable
     * I will check just for status 200 (success) that will assure me at least I don't have Internal Server Errors AND
     * assertSuccessfull on booleans that should return true
     */

    protected $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost:8000/api/skill/'
        ]);
    }

    /** @test */
    public function it_will_create_hero()
    {
        $response = $this->client->post('create',
            [
                'json' =>
                    [
                        "name" => "SkillTEST",
                        "chance" => 5,
                        "type" => 1,
                        "multiplier" => 1,
                        "desc" => 'Good skill TEST'
                    ]
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());
    }
}
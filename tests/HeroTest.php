<?php

use PHPUnit\Framework\TestCase;

class HeroTest extends TestCase
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
            'base_uri' => 'http://localhost:8000/api/hero/'
        ]);
    }

    /** @test */
    public function it_will_create_hero()
    {
        $response = $this->client->post('create',
            [
                'json' =>
                [
                    "name" => "HeroTEST",
                    "healthMin" => 100,
                    "healthMax" => 130,
                    "strengthMin" => 100,
                    "strengthMax" => 130,
                    "defMin" => 100,
                    "defMax" => 130,
                    "speedMin" => 100,
                    "speedMax" => 130,
                    "luckMin" => 10,
                    "luckMax" => 20
                 ]
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function it_will_get_hero_attributes()
    {
        $response = $this->client->get('getAttributes/Orderus');

        $this->assertEquals(200, $response->getStatusCode());

    }

    /** @test */
    public function it_will_delete_hero()
    {
        $response = $this->client->post('delete/HeroTEST');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
?>
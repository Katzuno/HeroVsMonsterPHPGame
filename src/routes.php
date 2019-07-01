<?php
use MiladRahimi\PhpRouter\Router;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

$router = new Router();

$router->get('/', function () {
    return '<p>This is homepage!</p>';
});

$router->post('/api/hero/create', function ($request) use ($db) {
    try {
        $json = json_decode($request->getBody()->getContents() );
        $hero = HeroFactory::create($db, $json->name, $json->healthMin, $json->healthMax,
            $json->strengthMin, $json->strengthMax, $json->defMin, $json->defMax,
            $json->speedMin, $json->speedMax, $json->luckMin, $json->luckMax);
        $response = array(
            'success' => true,
            'hero' => $hero
        );
        return json_encode($response);
    }
    catch (Exception $e)
    {
        return json_encode($e->getMessage());
    }
});

$router->post('/api/monster/create', function ($request) use ($db) {
    try {
        $json = json_decode($request->getBody()->getContents() );
        $monster = MonsterFactory::create($db, $json->name, $json->healthMin, $json->healthMax,
            $json->strengthMin, $json->strengthMax, $json->defMin, $json->defMax,
            $json->speedMin, $json->speedMax, $json->luckMin, $json->luckMax);
        $response = array(
            'success' => true,
            'monster' => $monster
        );
        return json_encode($response);
    }
    catch (Exception $e)
    {
        return json_encode($e->getMessage());
    }
});

$router->post('/api/skill/create', function ($request) use ($db) {
    try {
        $json = json_decode($request->getBody()->getContents() );
        $skill = SkillFactory::build($db, $json->name, $json->chance, $json->type, $json->multiplier, $json->desc);
        $response = array(
            'success' => true,
            'monster' => $skill
        );
        return json_encode($response);
    }
    catch (Exception $e)
    {
        return json_encode($e->getMessage());
    }
});

$router->post('/api/hero/addSkill', function ($request) use ($db) {
    try {
        $json = json_decode($request->getBody()->getContents() );

        $skill = SkillFactory::build($db, $json->skillName, $json->chance, $json->type, $json->multiplier, $json->desc);
        $hero = HeroFactory::getHeroByName($db, $json->heroName);
        HeroFactory::addSkill($db, $hero, $skill);
        $response = array(
            'success' => true,
        );
        return json_encode($response);
    }
    catch (Exception $e)
    {
        return json_encode($e->getCode());
    }
});

$router->post('/api/battle/start', function ($request) use ($db) {
    try {
        $json = json_decode($request->getBody()->getContents() );
        // TODO: Return game story as json
        GameFactory::createGame(HeroFactory::getHeroByName($db, $json->heroName), MonsterFactory::getMonsterByName($db, $json->monsterName))->start($json->maxRounds);
        $response = array(
            'success' => true,
        );
        return json_encode($response);
    }
    catch (Exception $e)
    {
        return json_encode($e->getCode());
    }
});

$router->get('/api/hero/getAttributes/{heroName}', function ($heroName) use ($db) {
    try {
        $hero = HeroFactory::getHeroByName($db, $heroName);

        $response = array(
            'success' => true,
            'hero' => $hero
        );
        return json_encode($response);
    }
    catch (Exception $e)
    {
        return json_encode($e->getMessage());
    }
});
$router->dispatch();
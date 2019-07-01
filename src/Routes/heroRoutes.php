<?php

/**
 * @api {post} api/hero/create
 * @apiName addHero
 * @apiGroup Hero
 *
 * @apiParam {String} name
 * @apiParam {int} healthMin
 * @apiParam {int} healthMax
 * @apiParam {int} strengthMin
 * @apiParam {int} strengthMax
 * @apiParam {int} defMin
 * @apiParam {int} defMax
 * @apiParam {int} speedMin
 * @apiParam {int} speedMax
 * @apiParam {int} luckMin
 * @apiParam {int} luckMax
 * @apiSuccess {JSON} success:true, hero:[createdObject]
 */
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

/**
 * @api {post} api/hero/delete/:heroName
 * @apiName deleteHero
 * @apiGroup Hero
 *
 * @apiParam {String} name
 * @apiSuccess {JSON} success:true
 */
$router->post('/api/hero/delete/{heroName}', function ($heroName) use ($db) {
    try {
        HeroFactory::delete($db, HeroFactory::getHeroByName($db, $heroName));
        $response = array(
            'success' => true,
        );
        return json_encode($response);
    }
    catch (Exception $e)
    {
        return json_encode($e->getMessage());
    }
});
/**
 * @api {post} api/hero/addSkill
 * @apiName addSkill
 * @apiGroup Skill
 *
 * @apiParam {String} skillName
 * @apiParam {int} chance
 * @apiParam {int} type
 * @apiParam {int} multiplier
 * @apiParam {String} desc
 * @apiParam {String} heroName
 *
 * @apiSuccess {JSON} success:true
 */
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

/**
 * @api {get} api/hero/getAttributes/:heroName Request Hero attributes
 * @apiName get Hero Attributes
 * @apiGroup Hero
 *
 * @apiParam {String} heroName Hero Unique Name.
 *
 * @apiSuccess {JSON} hero : [ health, strength, defence, speed, luck]
 */
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

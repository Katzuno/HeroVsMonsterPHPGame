<?php

/**
 * @api {post} api/monster/create
 * @apiName addMonster
 * @apiGroup Monster
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
 * @apiSuccess {JSON} success:true, monster:[createdObject]
 */
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


/**
 * @api {get} api/monster/getAttributes/:monsterName Request monster attributes
 * @apiName get monster Attributes
 * @apiGroup monster
 *
 * @apiParam {String} monsterName monster Unique Name.
 *
 * @apiSuccess {JSON} monster : [ health, strength, defence, speed, luck]
 */
$router->get('/api/monster/getAttributes/{monsterName}', function ($monsterName) use ($db) {
    try {
        $monster = MonsterFactory::getMonsterByName($db, $monsterName);

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


/**
 * @api {post} api/monster/delete/:heroName
 * @apiName deleteMonster
 * @apiGroup Monster
 *
 * @apiParam {String} name
 * @apiSuccess {JSON} success:true
 */
$router->post('/api/monster/delete/{monsterName}', function ($monsterName) use ($db) {
    try {
        MonsterFactory::delete($db, MonsterFactory::getMonsterByName($db, $monsterName));
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
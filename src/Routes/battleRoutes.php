<?php
/**
* @api {post} api/battle/start
* @apiName start battle between a hero and a monster
* @apiGroup Battle
*
* @apiParam {String} heroName
* @apiParam {String} monsterName
*
* @apiSuccess {JSON} success:true
*/
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

?>
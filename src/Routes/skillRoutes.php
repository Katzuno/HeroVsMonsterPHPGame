<?php


/**
 * @api {post} api/skill/create
 * @apiName addSkill
 * @apiGroup Skill
 *
 * @apiParam {String} skillName
 * @apiParam {int} chance
 * @apiParam {int} type
 * @apiParam {int} multiplier
 * @apiParam {String} desc
 * @apiSuccess {JSON} success:true
 */
$router->post('/api/skill/create', function ($request) use ($db) {
    try {
        $json = json_decode($request->getBody()->getContents() );
        $skill = SkillFactory::build($db, $json->name, $json->chance, $json->type, $json->multiplier, $json->desc);
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
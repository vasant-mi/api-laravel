<?php

/**
 * Api v1 Routes File.
 *
 * @var $api \Dingo\Api\Routing\Router
 */

/**** TestController routes ****/
$api->get('test', 'TestController@testGet');
$api->post('test', 'TestController@testPost');
$api->delete('test', 'TestController@testDelete');

/**** NEEDS AUTHORIZATION ****/
$api->group(['middleware' => 'api.auth'], function (\Dingo\Api\Routing\Router $api) {

    /**** MeasurementController routes ****/
    $api->get('test1', 'TestController@testGetProtected');
    $api->post('test1', 'TestController@testPostProtected');
    $api->delete('test1', 'TestController@testDeleteProtected');

});

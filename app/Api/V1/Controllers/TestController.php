<?php

namespace App\Api\V1\Controllers;

use App\Api\ApiController;
use App\Api\V1\Transformers\UserTransformer;

/**
 * Class TestController
 * @package App\Api\V1\Controllers
 */
class TestController extends ApiController
{

    public function testGet()
    {
        return [
            'controller' => 'TestController',
            'method' => 'get'
        ];
    }

    public function testPost()
    {
        return [
            'controller' => 'TestController',
            'method' => 'post'
        ];
    }

    public function testDelete() {
      return [
        'controller' => 'TestController',
        'method' => 'delete'
      ];
    }

    public function testGetProtected() {
        return [
            'controller' => 'TestController',
            'method' => 'get',
            'protected' => true
        ];
    }

    public function testPostProtected() {
        return [
            'controller' => 'TestController',
            'method' => 'post',
            'protected' => true
        ];
    }

    public function testDeleteProtected() {
        return [
            'controller' => 'TestController',
            'method' => 'delete',
            'protected' => true
        ];
    }

}

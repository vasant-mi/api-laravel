<?php

namespace App\Api;

use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class ApiController
 * @package App\Api
 */
class ApiController  extends BaseController
{
    use Helpers, AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public final function error($message, $statusCode = 500, $previous = null)
    {
        $cors = [
            'Access-Control-Allow-Origin' => '*'
        ];
        throw new HttpException($statusCode, $message, $previous, $cors, 0);
    }

    /**
     * @param $api
     */
    public function validateRequest($api)
    {
        $version = app('request')->version();
        $rules = app('config')->get("api_validations.{$api}.{$version}.rules");
        if (!$rules) {
            $rules = app('config')->get("api_validations.{$api}.v1.rules");
        }
        $messages = app('config')->get("api_validations.{$api}.{$version}.messages");
        if (!$messages) {
            $messages = app('config')->get("api_validations.{$api}.v1.messages");
        }

        if ($rules && $messages) {
            $payload = app('request')->only(array_keys($rules));
            $validator = app('validator')->make($payload, $rules, $messages);

            if ($validator->fails()) {
                $this->error($validator->errors()->first(), 400);
            }
        }
    }
}

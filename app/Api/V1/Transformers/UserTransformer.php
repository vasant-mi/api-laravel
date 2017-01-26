<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer
 * @package App\Api\V1\Transformers
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * @param array $user
     * @return array
     */
    public function transform($user)
    {
        return [
            'id' => $user['id'],
            'name' => [
              'first' => $user['firstname'],
              'last' => $user['lastname']
            ]
        ];
    }
}

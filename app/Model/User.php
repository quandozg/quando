<?php

namespace App\Model;

use App\Domains\EmailAddressDomain;
use App\Domains\StringDomain;
use App\Exceptions\ConfigurationException;

class User extends AbstractModel
{
    const TABLE = 'Users';

    const PROPERTIES = [
        'firstName' => [
            'type' => StringDomain::class,
            'validator' => ['min' => 1, 'max' => 10],
            'required' => true,
        ],
        'lastName' => [
            'property' => 'lastName',
            'type' => StringDomain::class,
            'validator' => ['min' => 1, 'max' => 40],
            'required' => true,
        ],
        'email' => [
            'property' => 'email',
            'type' => EmailAddressDomain::class,
            'validator' => ['min' => 1, 'max' => 255],
            'required' => true,
        ],
    ];
}

<?php


namespace App\Exceptions;

use Exception;

class ConfigurationException extends Exception
{
    const FIELD_NOT_FOUND = 'Field not found in configuration';
    const FIELD_TYPE_MISSING = 'Field type not set in configuration';
}

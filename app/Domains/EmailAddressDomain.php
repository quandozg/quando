<?php

namespace App\Domains;

use App\Exceptions\FormatException;

class EmailAddressDomain extends StringDomain
{
    const FORMAT_ERROR = 'Email address is in wrong format';
    /**
     * EmailAddress constructor.
     * @param $value
     * @param null|array $validationRules ;
     * @throws FormatException
     */
    public function __construct($value, $validationRules = null)
    {
        $this->validatorRules = $validationRules ?? ['max' => 50, 'min' => 4];
        $this->setValue($value);
    }

    /**
     * @param $value
     * @throws FormatException
     */
    protected function validate($value)
    {
        // First check if failures are done on parent
        parent::validate($value);

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new FormatException(self::FORMAT_ERROR);
        }
    }
}

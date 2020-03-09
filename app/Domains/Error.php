<?php

namespace App\Domains;

use App\Exceptions\FormatException;

class Error extends DomainAbstract
{
    /**
     * @var int
     */
    private $errorCode;
    /**
     * @var StringDomain
     */
    private $errorMessage;

    /**
     * Error constructor.
     * @param $errorMessage
     * @param $errorCode
     * @throws FormatException
     */
    public function __construct($errorMessage, $errorCode)
    {
        $this->errorCode = $errorCode;
        $this->errorMessage = new StringDomain($errorMessage);
    }

    /**
     * @inheritDoc
     */
    public function toString(): StringDomain
    {
        return $this->errorMessage->toString();
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'errorCode' => $this->errorCode,
            'errorMessage' => $this->errorMessage,
        ];
    }

    /**
     * @inheritDoc
     */
    public function setValue($value): DomainAbstract
    {
        // TODO: Implement setValue() method.
    }

    /**
     * @param mixed $value
     */
    protected function validate($value)
    {

    }
}

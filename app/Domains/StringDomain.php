<?php


namespace App\Domains;


use App\Exceptions\FormatException;
use function strlen;
use function var_dump;

class StringDomain extends DomainAbstract
{
    const FORMAT_EXCEPTION = 'Value is not a string';
    const SIZE_EXCEPTION = 'Value size is not within set limits';

    /**
     * @param null|StringDomain $string
     * @param null|array $validatorRules
     * @throws FormatException
     */
    public function __construct($string = null, $validatorRules = null)
    {
        $this->validatorRules = $validatorRules ??
            [
                'min' => 0,
                'max' => 255,
            ];
        $this->setValue($string);
    }

    /**
     * No array representation available
     * @return array|bool
     */
    public function toArray()
    {
        return false;
    }

    public function toString(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return DomainAbstract
     * @throws FormatException
     */
    public function setValue($value): DomainAbstract
    {
        $this->validate($value);
        $this->value = $value;
        return $this;
    }

    /**
     * Validation of input
     * @param $value
     *
     * @throws FormatException;
     */
    protected function validate($value)
    {
        if (null === $value) {
            return;
        }
        if (!is_string($value) && !is_numeric($value)) {
            throw new FormatException(self::FORMAT_EXCEPTION);
        }
        if (isset($this->validatorRules['min']) && !($this->validatorRules['min'] <= strlen((string)$value))) {
            throw new FormatException(self::SIZE_EXCEPTION);
        }
        if (isset($this->validatorRules['max']) && !($this->validatorRules['max'] >= strlen((string)$value))) {
            throw new FormatException(self::SIZE_EXCEPTION);
        }
    }
}

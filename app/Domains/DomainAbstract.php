<?php


namespace App\Domains;


abstract class DomainAbstract
{
    /**
     * Actual value of the domain
     * @var mixed
     */
    protected $value;

    /**
     * Validation rules for domain
     * @var array
     */
    protected $validatorRules;

    /**
     * Return string representation of the Domain
     * @return string
     */
    public abstract function toString(): string;


    /**
     * Throws exceptions if value is not acceptable. Used before saving value.
     * @param mixed $value
     */
    protected abstract function validate($value);

    /**
     * Returns array representation of the Domain
     * @return array|bool
     */
    public abstract function toArray();

    /**
     * Sets value of the domain
     * @param $value
     * @return DomainAbstract
     */
    public function setValue($value): DomainAbstract
    {
        $this->validate($value);
        $this->value = $value;
        return $this;
    }

    /**
     * Returns stored value in native format
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Enable automatic casting to string
     * @return string
     */
    public function __toString()
    {
        return $this->toString() ?? '';
    }
}

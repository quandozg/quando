<?php


namespace App\Model;


use App\Exceptions\ConfigurationException;
use App\Exceptions\FormatException;
use ReflectionClass;
use function array_keys;

abstract class AbstractModel
{

    /**
     * Define properties in each model class to enable functionalities
     * [
     *   'fieldName' => [
     *     'type' => Domain Class,
     *     'required' => bool,
     *     'validator' => [validator rulesets]
     *     ],
     * ]
     */
    const PROPERTIES = [];

    /**
     * Store domain objects
     * @var array
     */
    protected $values = [];

    /**
     * Hold error information
     * @var array
     */
    protected $errors = [];

    /**
     * Hold error information
     * @var array
     */
    protected $required = [];


    /**
     * Model configuration information
     * @var array
     */
    protected $properties = [];

    /**
     * AbstractModel constructor.
     * @param array $properties
     * @param array $values
     * @throws FormatException
     * @throws ConfigurationException
     */
    public function __construct(array $values = [])
    {
        // Set properties
        $this->errors = [];
        $this->required = [];
        $properties = static::PROPERTIES;

        foreach ($properties as $key => $config) {
            $this->values[$key] = null;
            $this->required[$key] = $config['required'];
        }
        // Initialize values
        foreach ($properties as $key => $config) {
            // Check if required field data present
            if (!isset($values[$key]) && $config['required']) {
                $this->addError($key, 'Required field');
                continue;
            }
            // Catch all formatting errors, not configuration errors
            try {
                $this->__set($key, $values[$key]);
            } catch (FormatException $e) {
                $this->addError($key, $e->getMessage());
            }
        }
    }

    /**
     * Add new error to the list
     * @param $field
     * @param $message
     */
    public function addError($field, $message)
    {
        if (!isset($this->errors[$field])) {
        $this->errors[$field] = [];
    }
        $this->errors[$field][] = $message;
    }

    /**
     * Get error listed by field name
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Check if Model field is required
     * @return bool
     */
    public function isRequiredField($field): bool
    {
        return isset($this->required[$field]);
    }

    /**
     * Get array of required fields
     * @return array
     */
    public function getRequiredFields(): array
    {
        return array_keys($this->required);
    }

    public function isValid(): bool
    {
        return ([] === $this->errors);
    }

    /**
     * Get properties array, must return array of arrays containing property name, type as minimum
     * @return array
     */
    public function getProperties(): array
    {
        return static::PROPERTIES;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function getModel(): string
    {
        return static::TABLE;
    }

    /**
     * @param $name
     * @return mixed
     * @throws ConfigurationException
     */
    public function __get($name)
    {
        if (isset($this->values[$name])) {
            return $this->values[$name];
        }

        throw new ConfigurationException('Unknown field name.');
    }

    /**
     * @param $name
     * @return mixed
     * @throws ConfigurationException
     */
    public function getField($name)
    {
        if (isset($this->values[$name])) {
            return $this->values[$name];
        }

        throw new ConfigurationException('Unknown field name.');
    }
    /**
     * @param $name
     * @param $value
     * @return $this
     * @throws ConfigurationException
     * @throws FormatException
     */
    public function __set($name, $value)
    {
        $fieldData = $this->values[$name] ?? null;
        // Check if configuration is in place for the name
        if (null === static::PROPERTIES[$name]) {
            throw new ConfigurationException(ConfigurationException::FIELD_NOT_FOUND . '(' . $name . ')');
        }

        if (!isset(static::PROPERTIES[$name]['type'])) {
            throw new ConfigurationException(ConfigurationException::FIELD_TYPE_MISSING . '(' . $name . ')');
        }

        // If we already have a domain object attached, set value to it
        if (is_a($fieldData, static::PROPERTIES[$name]['type'], true)) {
            $fieldData.setValue($value);
            return $this;
        }

        $domain = static::PROPERTIES[$name]['type'];
        /** DomainAbstract $domain */
        $this->values[$name] = new $domain($value, static::PROPERTIES[$name]['validator'] ?? []);
    }
}


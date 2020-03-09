<?php

namespace App\Services\Database\Client;

use App\Domains\EmailAddressDomain;
use App\Domains\StringDomain;
use App\Exceptions\FormatException;
use App\Services\Database\DatabaseInterface;
use App\Model\AbstractModel;
use Exception;
use mysqli;
use function var_dump;

class MysqlClient implements DatabaseInterface
{

    protected $instance;

    public function getInstance(): DatabaseInterface
    {
        if (!($this->instance instanceof \mysqli)) {
            self::__construct();
        }
        return $this;
    }

    public function __construct()
    {
        $this->instance = new mysqli(
            getenv('mysqli_host'),
            getenv('mysqli_username'),
            getenv('mysqli_password'),
            getenv('mysqli_username')
        );
    }

    public function query($string): array
    {
        $result = $this->instance->query($string);

        if ($result instanceof \mysqli_result) {
            $response = [];
            while ($row = $result->fetch_assoc()) {
                $response[] = $row;
            }

            return $response;
        }

        return $result;
    }

    /**
     * @param AbstractModel $model
     * @return bool
     * @throws \App\Exceptions\ConfigurationException
     * @throws \ReflectionException
     */
    public function saveModel(AbstractModel $model): bool
    {

        $fields = $model->getProperties();
        try {
            foreach ($fields as $field => $configs) {
                    $insertFields[] = '`' . $field . '`';
                    $insertValues[] = self::format($configs, $model->getField($field), $this->instance);
            }

        } catch (FormatException $e) {
            throw new Exception('Cannot continue, configuration error', 400,$e);
        }
        $query = 'INSERT INTO `'. $model->getModel() .'` (' . implode(',', $insertFields) . ') VALUES (' .
            implode(',', $insertValues) . ')';
        return $this->instance->query($query);
    }

    /**
     * Generate proper formatting for mysql insert/update based on property type
     * @param $config
     * @param $value
     * @param $instance
     * @return int|string
     * @throws FormatException
     */
    private static function format($config, $value, $instance)
    {
        switch ($config['type']) {
            case EmailAddressDomain::class:
            case StringDomain::class:
                return '\'' . mysqli_escape_string($instance, (string)$value) . '\'';
            default:
                var_dump($config['type']);
                throw new FormatException('Unknown data type');
        }
    }
}

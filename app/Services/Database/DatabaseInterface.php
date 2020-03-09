<?php

namespace App\Services\Database;

use App\Model\AbstractModel;

interface DatabaseInterface
{
    /**
     * Query database using
     * @param string|array $query
     * @return array
     */
    public function query($query): array;

    /**
     * Save model
     * @param AbstractModel $abstractModel
     * @return bool
     */
    public function saveModel(AbstractModel $abstractModel): bool;

    /**
     * All database clients are singletons having getInstance as entry point to the client instance
     */
    public function getInstance(): self;
}

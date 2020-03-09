<?php

namespace App\Forms;

use App\Model\AbstractModel;

abstract class AbstractForm
{
    /**
     * @var AbstractModel
     */
    private $model;

    /**
     * Check if form is valid
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->getModel()->isValid();
    }

    /**
     * Get connected model
     * @return AbstractModel
     */
    public function getModel(): AbstractModel
    {
        return $this->model;
    }

    /**
     * setup Model used to work with form data
     * @param AbstractModel $model
     * @return AbstractForm
     */
    public function setModel(AbstractModel $model): AbstractForm
    {
        $this->model = $model;
        return $this;
    }

    /**
     * Get list of required fields
     * @return array
     */
    public function getRequiredFields(): array
    {
        $this->getModel()->getRequiredFields();
    }

    /**
     * Is field required
     * @param $field
     * @return bool
     */
    public function isRequiredField($field): bool
    {
        return $this->getModel()->isRequiredField($field);
    }

    public function getErrors()
    {
        return $this->getModel()->getErrors();
    }
}

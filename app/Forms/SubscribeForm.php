<?php


namespace App\Forms;


use App\Model\User;
use App\Validators\FormValidator;
use App\Validators\ValidatorInterface;

class SubscribeForm extends AbstractForm
{

    public function __construct($payload = null)
    {
        $this->setModel(new User($payload));
    }
}

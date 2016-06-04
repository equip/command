<?php

namespace Equip\Command;

final class TestedOptions extends Options
{
    protected $email;
    protected $password;
    protected $first_name;
    protected $last_name;

    public function required()
    {
        return [
            'email',
            'password',
        ];
    }
}

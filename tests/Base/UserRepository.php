<?php

use Softlabs\Base\Repository;

class UserRepository extends Repository
{
    public function __construct(User $user)
    {
        $this->store = $user;
    }
}
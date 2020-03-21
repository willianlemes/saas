<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Models\Person;
use Source\Models\User;

/**
 *
 */
class Realty extends Model
{
    public function __construct()
    {
        parent::__construct("properties", ["id"], ["proprietary", "finality", "kind", "price"]);
    }

    public function proprietary(): ?Person
    {
        if ($this->proprietary) {
            return (new Person())->findById($this->proprietary);
        }
        return null;
    }
}

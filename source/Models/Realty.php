<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Models\Person;

/**
 *
 */
class Realty extends Model
{
    public function __construct()
    {
        parent::__construct("properties", ["id"], ["proprietary", "finality", "kind", "price"]);
    }

    public function list()
    {
        $this->query = "SELECT properties.id, " .
                              "(SELECT name FROM person WHERE person.id = properties.proprietary) AS proprietary, " .
                              "properties.kind, " .
                              "properties.finality " .
                       "FROM properties";
        return $this;
    }

    public function proprietary(): ?Person
    {
        if ($this->proprietary) {
            return (new Person())->findById($this->proprietary);
        }
        echo "Passou";
        exit();
        return null;
    }
}

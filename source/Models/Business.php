<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Models\Person;
use Source\Models\Realty;

class Business extends Model
{
    public function __construct()
    {
        parent::__construct("business", ["id"], ["user_id","client_id","title","realty_id","stage","expected_closure"]);
    }

    public function client(): ?Person
    {
        if ($this->id_client) {
            return (new Person())->findById($this->id_client);
        }
        return null;
    }

    public function realty(): ?Realty
    {
        if ($this->id_realty) {
            return (new Realty())->findById($this->id_realty);
        }
        return null;
    }
}

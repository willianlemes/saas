<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Models\Person;
use Source\Models\Realty;

class Business extends Model
{
    const STATUS = [
      "contato" => "Contato",
      "visita" => "Visita",
      "proposta" => "Proposta",
      "negociacao" => "Negociação"
    ];

    public function __construct()
    {
        parent::__construct("business", ["id"], ["user_id","client_id","title","realty_id","status","expected_closure"]);
    }

    public function client(): ?Person
    {
        if ($this->client_id) {
            return (new Person())->findById($this->client_id);
        }
        return null;
    }

    public function realty(): ?Realty
    {
        if ($this->realty_id) {
            return (new Realty())->findById($this->realty_id);
        }
        return null;
    }

    public function status(): string
    {
        if ($this->status) {
            return Business::STATUS[$this->status];
        }
        return null;
    }
}

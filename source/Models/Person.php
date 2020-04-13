<?php

namespace Source\Models;

use Source\Core\Model;

class Person extends Model
{
    const PROFILES = [
                      "customer" => "Cliente",
                      "broker" => "Corretor",
                      "owner" => "Proprietário",
                      "interested" => "Interessado",
                      "other" => "Outro"
                    ];

    const TYPES = ["F" => "Física", "J" => "Jurídica"];

    public function __construct()
    {
        parent::__construct("person", ["id"], ["name"]);
    }

    public function photo(): ?string
    {
        if ($this->photo && file_exists(__DIR__ . "/../../" . CONF_UPLOAD_DIR . "/{$this->photo}")) {
            return $this->photo;
        }

        return null;
    }

    public function getProfile(): string
    {
        return Person::PROFILES[$this->profile];
    }

    public function getType(): string
    {
        return Person::TYPES[$this->type];
    }
}

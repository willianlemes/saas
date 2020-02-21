<?php

namespace Source\Models;

use Source\Core\Model;

class Person extends Model
{
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
}

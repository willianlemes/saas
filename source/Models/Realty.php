<?php

namespace Source\Models;

use Source\Core\Model;

/**
 *
 */
class Realty extends Model
{
    public function __construct()
    {
        parent::__construct("properties", ["id"], ["name"]);
    }
}

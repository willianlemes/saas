<?php

namespace Source\Core;

class Seeder
{
    protected $faker;

    public function __construct()
    {
        $faker = Faker::create();
    }
}

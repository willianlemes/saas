<?php

namespace Source\Seeders;

use Faker\Factory as Faker;
use Source\Models\Seeder;
use Source\Models\Business;

class BusinessSeeder extends Seeder
{
    public function __construct()
    {
        parent::__construct();
    }

    public function execute()
    {
        $business = new Business();

        for ($i=1; $i <= 10; $i++) {
            $business->title = $faker->name;

            $business->save();
        }
    }
}

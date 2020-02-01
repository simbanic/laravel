<?php

namespace Item;

use Faker\Factory as Faker;
use Carbon\Carbon;

class CreateProduct extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testProductFeature()
    {
        $faker          = Faker::create('App/Models/Product/Product');
        $name           = $faker->sentence();
        $sku            = implode($faker->paragraphs(5));
        $price          = $faker->paragraphs(5);
        $created_at     = Carbon::now();
        $updated_at     = Carbon::now();

        $this->tester->haveRecord(
            'App/Models/Product/Product',
            [
                'title' => $name,
                'sku' => $sku,
                'price' => $price,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ]
        );

        $this->tester->seeRecord(
            "products/$name",
            [
                'title' => $name,
                'sku' => $sku,
                'price' => $price,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ]
        );
    }
}

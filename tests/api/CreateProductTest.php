<?php

class CreateProductTest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function createProductViaAPI(ApiTester $I)
    {
        $faker          = Faker::create('App/Models/Product/Product');
        $name           = $faker->sentence();
        $sku            = implode($faker->paragraphs(5));
        $price          = $faker->paragraphs(5);
        $created_at     = Carbon::now();
        $updated_at     = Carbon::now();

        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');

        $I->sendPOST('/products', [
            'title' => $name,
            'sku' => $sku,
            'price' => $price,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        ]);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContains('{"result":"ok"}');
    }
}

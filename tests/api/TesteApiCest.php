<?php

class TesteApiCest
{
    public function tryCreateProductWithoutURLTest(ApiTester $I)
    {
        $I->wantTo('Teste para criar produto sem URL');
        $I->sendPOST('produtos/add',['url'=>'']);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"URL is required"}');
    }
}

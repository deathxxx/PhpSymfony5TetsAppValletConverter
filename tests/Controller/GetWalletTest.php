<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetWalletTest extends WebTestCase
{

    public function testGetUrl()
    {
        $client = static::createClient();

        $client->request('GET', '/api/wallets');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}

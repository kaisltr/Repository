<?php

namespace EspritClubsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EvenementControllerTest extends WebTestCase
{
    public function testAjoutevent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/AjoutEvent');
    }

    public function testListeevent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ListeEvent');
    }

    public function testChercherevent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ChercherEvent');
    }

}

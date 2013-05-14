<?php

use Silex\WebTestCase;

class PageTest extends WebTestCase {
    public function testRedirectToWelcome() {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        $response = $client->getResponse();

        $this->assertTrue($response->isRedirect('/Welcome'));
    }

    public function testShowPageOK() {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/Welcome');

        $response = $client->getResponse();

        $this->assertTrue($response->isOK());
    }

    public function createApplication() {
        $app = require __DIR__ . '/../app.php';
        $app['debug'] = true;
        $app['exception_handler']->disable();

        return $app;
    }
}

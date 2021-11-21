<?php

namespace App\Service;

use App\Entity\NewTokenCMK;
use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class NewTokenCrawler
{
    private ClientInterface $client;
    private Crawler $crawler;

    public function __construct(ClientInterface $client, Crawler $crawler)
    {
        $this->client = $client;
        $this->crawler = $crawler;
    }

    public function find(): NewTokenCMK
    {
        $response = $this->client->request('GET','/pt-br/new/');
        $html = $response->getBody();
        $this->crawler->addHtmlContent($html);
        $tokenArray = $this->crawler->filter('p.sc-1eb5slv-0.iworPT')->first();
        foreach ($tokenArray as $token) {
            $name = $token->textContent;
        }

        return new NewTokenCMK($name);
    }
}
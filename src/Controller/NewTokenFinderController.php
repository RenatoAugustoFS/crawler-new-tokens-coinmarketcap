<?php

namespace App\Controller;


use App\Repository\NewTokenCMKRepository;
use App\Service\NewTokenCrawler;
use App\Service\SendNotificationTelegram;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewTokenFinderController extends AbstractController
{
    private NewTokenCMKRepository $repository;
    private EntityManagerInterface $entityManager;
    private SendNotificationTelegram $sendMessage;

    public function __construct(NewTokenCMKRepository $repository, EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->sendMessage = new SendNotificationTelegram();
    }

    public function handle(): Response
    {
        $client = new Client(['base_uri' => 'https://coinmarketcap.com/']);
        $crawler = new Crawler();
        $tokenFinder = new NewTokenCrawler($client, $crawler);

        try {
            $token = $tokenFinder->find();
        } catch (\Exception $e) {
            $this->sendMessage->sendMessage($e->getMessage());
            exit();
        }

        if(!$this->repository->findOneBy(['name' => $token->name])){
            $this->entityManager->persist($token);
            $this->entityManager->flush();
            $this->sendMessage->sendMessage($token);
        }

        return new Response('', 200);
    }
}

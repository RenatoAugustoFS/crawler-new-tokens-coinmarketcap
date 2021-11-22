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
        return $this->render('new_token_finder/index.html.twig', []);
    }
}

<?php

namespace App\Controller;


use App\Repository\NewTokenCMKRepository;
use App\Service\NewTokenCrawler;
use Doctrine\ORM\EntityManager;
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

    public function __construct(NewTokenCMKRepository $repository, EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="finder")
     */
    public function handle(): Response
    {
        $client = new Client(['base_uri' => 'https://coinmarketcap.com/']);
        $crawler = new Crawler();
        $tokenFinder = new NewTokenCrawler($client, $crawler);
        $token = $tokenFinder->find();

        if(!$this->repository->findOneBy(['name' => $token->name])){
            $this->entityManager->persist($token);
            $this->entityManager->flush();
        }
    }
}

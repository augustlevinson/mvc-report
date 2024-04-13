<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\DeckOfCards;
use App\Card\DeckOfCardsWithJokers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DeckControllerJSON extends AbstractController
{
    #[Route("/api/deck", name: "deck_get", methods: ['GET'])]
    public function deck(): Response
    {
        $deck = new DeckOfCardsWithJokers();
        
        $data = [
            'deck' => $deck->getAllCardsArray(),
        ];

        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
    #[Route("/api/deck/shuffle", name: "deck_shuffle", methods: ['POST'])]
    public function shuffle(): Response
    {
        $deck = new DeckOfCardsWithJokers();
        
        $data = [
            'deck' => $deck->getAllCardsArray(),
        ];

        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}

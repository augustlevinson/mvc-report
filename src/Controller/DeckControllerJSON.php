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
    public function deck(SessionInterface $session): Response
    {
        if ($session->has("deck")) {
            $deck = $session->get("deck");
        } else {
            $deck = new DeckOfCardsWithJokers();
            $session->set("deck", $deck);
        }

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
    public function shuffle(SessionInterface $session): Response
    {
        $deck = new DeckOfCardsWithJokers();
        $shuffledDeck = clone $deck;
        $shuffledDeck->shuffleCards();
        $session->set("shuffled_deck", $shuffledDeck);

        $data = [
            "shuffledDeck" => $shuffledDeck->getAllCardsArray(),
        ];

        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/draw", name: "deck_draw", methods: ['POST'])]
    public function draw(SessionInterface $session): Response
    {
        if ($session->has("deck")) {
            $deck = $session->get("deck");
        } else {
            $deck = new DeckOfCardsWithJokers();
            $session->set("deck", $deck);
        }

        $drawnCard = $deck->drawNumber(1);
        $drawnCardSerialized = [];
        foreach ($drawnCard as $card) {
            $drawnCardSerialized[] = $card->toArray();
        }

        $data = [
            "drawnCard" => $drawnCardSerialized,
            "remainingCards" => $deck->getRemainingCards(),
        ];

        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/draw/{num<\d+>}", name: "deck_draw_number", methods: ['POST'])]
    public function drawNum(SessionInterface $session, int $num): Response
    {
        if ($session->has("deck")) {
            $deck = $session->get("deck");
        } else {
            $deck = new DeckOfCardsWithJokers();
            $session->set("deck", $deck);
        }

        $drawnCard = $deck->drawNumber($num);
        $drawnCardSerialized = [];
        if ($drawnCard != null) {
            foreach ($drawnCard as $card) {
                $drawnCardSerialized[] = $card->toArray();
            }
        }

        $data = [
            "drawnCard" => $drawnCardSerialized,
            "remainingCards" => $deck->getRemainingCards(),
        ];

        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}

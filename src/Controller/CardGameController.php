<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;
use App\Card\DeckOfCardsWithJokers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardGameController extends AbstractController
{
    #[Route("/game/card/deck", name: "card_deck")]
    public function deck(SessionInterface $session): Response
    {
        // Check if "deck" exists in session and create a new one if it doesn't
        if ($session->has("deck")) {
            $deck = $session->get("deck");
        } else {
            $deck = new DeckOfCardsWithJokers();
            $session->set("deck", $deck);
        }
        $data = [
            "cardDeck" => $deck
        ];

        // Render the template with the data
        return $this->render('card/deck.html.twig', $data);
    }

    #[Route("/game/card/deck/shuffle", name: "shuffle_deck")]
    public function shuffleDeck(SessionInterface $session): Response
    {
        // Check if "deck" exists in session and create a new one if it doesn't
        if ($session->has("deck")) {
            $deck = $session->get("deck");
        } else {
            $deck = new DeckOfCardsWithJokers();
            $session->set("deck", $deck);
        }

        $shuffledDeck = clone $deck;
        $shuffledDeck->shuffleCards();
        $session->set("shuffled_deck", $shuffledDeck);

        $data = [
            "cardDeck" => $deck,
            "shuffledDeck" => $shuffledDeck
        ];

        return $this->render('card/shuffled.html.twig', $data);
    }

    #[Route("/game/card/deck/draw", name: "draw_card")]
    public function draw(SessionInterface $session): Response
    {
        // Check if "deck" exists in session and create a new one if it doesn't
        if ($session->has("deck")) {
            $deck = $session->get("deck");
        } else {
            $deck = new DeckOfCardsWithJokers();
            $session->set("deck", $deck);
        }

        $drawnCard = $deck->drawNumber(1);
        $session->set("last_drawn", $drawnCard);

        if ($drawnCard == null) {
            $this->addFlash(
                'warning',
                'You are out of cards!'
            );
        }

        $data = [
            "cardDeck" => $deck,
            "drawnCard" => $drawnCard,
        ];

        return $this->render('card/draw.html.twig', $data);
    }

    #[Route("/game/card/deck/draw/{num<\d+>}", name: "draw_number")]
    public function drawNumber(SessionInterface $session, int $num): Response
    {
        // Check if "deck" exists in session and create a new one if it doesn't
        if ($session->has("deck")) {
            $deck = $session->get("deck");
        } else {
            $deck = new DeckOfCardsWithJokers();
            $session->set("deck", $deck);
        }

        $drawnCard = $deck->drawNumber($num);
        $session->set("last_drawn", $drawnCard);

        if ($drawnCard == null) {
            $this->addFlash(
                'warning',
                'You are out of cards!'
            );
        }

        $data = [
            "cardDeck" => $deck,
            "drawnCard" => $drawnCard,
        ];

        return $this->render('card/draw.html.twig', $data);
    }



    #[Route("/game/card/deck/generate", name: "generate_deck")]
    public function generateNewDeck(SessionInterface $session): Response
    {
        $deck = new DeckOfCardsWithJokers();

        $session->clear();
        $session->set("deck", $deck);

        $this->addFlash(
            'notice',
            'New deck generated.'
        );

        return $this->redirectToRoute('card');
    }
}

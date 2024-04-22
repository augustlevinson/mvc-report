<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Game21Controller extends AbstractController
{
    #[Route("/game/docs", name: "game_docs")]
    public function gameDocs(): Response
    {
        return $this->render('game21/docs.html.twig');
    }

    #[Route("/game/play", name: "game_play")]
    public function gamePlay(SessionInterface $session): Response
    {
        // Check if "deck" and "game21" exists in session, otherwise create new ones
        if ($session->has("game21")) {
            $game21 = $session->get("game21");
            $deck = $session->get("deck");
        } else {
            $game21 = new Game21();
            $session->set("deck", $deck);
            $deck = new DeckOfCards();
            $session->set("deck", $deck);
        }
        $data = [
            "cardDeck" => $deck,
            "game21" => $game21
        ];

        // Render the template with the data
        return $this->render('game21/play.html.twig');
    }
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

    // #[Route("/game/card/deck/shuffle", name: "shuffle_deck")]
    // public function shuffleDeck(SessionInterface $session): Response
    // {
    //     // Check if "deck" exists in session and create a new one if it doesn't
    //     if ($session->has("deck")) {
    //         $deck = $session->get("deck");
    //     } else {
    //         $deck = new DeckOfCardsWithJokers();
    //         $session->set("deck", $deck);
    //     }

    //     $shuffledDeck = clone $deck;
    //     $shuffledDeck->shuffleCards();
    //     $session->set("shuffled_deck", $shuffledDeck);

    //     $data = [
    //         "cardDeck" => $deck,
    //         "shuffledDeck" => $shuffledDeck
    //     ];

    //     return $this->render('card/shuffled.html.twig', $data);
    // }

    // #[Route("/game/card/deck/draw", name: "draw_card")]
    // public function draw(SessionInterface $session): Response
    // {
    //     // Check if "deck" exists in session and create a new one if it doesn't
    //     if ($session->has("deck")) {
    //         $deck = $session->get("deck");
    //     } else {
    //         $deck = new DeckOfCardsWithJokers();
    //         $session->set("deck", $deck);
    //     }

    //     $drawnCard = $deck->drawNumber(1);
    //     $session->set("last_drawn", $drawnCard);

    //     if ($drawnCard == null) {
    //         $this->addFlash(
    //             'warning',
    //             'You are out of cards!'
    //         );
    //     }

    //     $data = [
    //         "cardDeck" => $deck,
    //         "drawnCard" => $drawnCard,
    //     ];

    //     return $this->render('card/draw.html.twig', $data);
    // }

    // #[Route("/game/card/deck/draw/{num<\d+>}", name: "draw_number")]
    // public function drawNumber(SessionInterface $session, int $num): Response
    // {
    //     // Check if "deck" exists in session and create a new one if it doesn't
    //     if ($session->has("deck")) {
    //         $deck = $session->get("deck");
    //     } else {
    //         $deck = new DeckOfCardsWithJokers();
    //         $session->set("deck", $deck);
    //     }

    //     $drawnCard = $deck->drawNumber($num);
    //     $session->set("last_drawn", $drawnCard);

    //     if ($drawnCard == null) {
    //         $this->addFlash(
    //             'warning',
    //             'You are out of cards!'
    //         );
    //     }

    //     $data = [
    //         "cardDeck" => $deck,
    //         "drawnCard" => $drawnCard,
    //     ];

    //     return $this->render('card/draw.html.twig', $data);
    // }



    // #[Route("/game/card/deck/generate", name: "generate_deck")]
    // public function generateNewDeck(SessionInterface $session): Response
    // {
    //     $deck = new DeckOfCardsWithJokers();

    //     $session->clear();
    //     $session->set("deck", $deck);

    //     $this->addFlash(
    //         'notice',
    //         'New deck generated.'
    //     );

    //     return $this->redirectToRoute('card');
    // }
}

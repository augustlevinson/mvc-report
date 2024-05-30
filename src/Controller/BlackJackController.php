<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardHand;
use App\Card\DeckOfCards;
use App\Card\Player;
use App\Card\BlackJack;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BlackJackController extends AbstractController
{
    #[Route("/proj", name: "blackjack_home")]
    public function blackjackHome(): Response
    {
        return $this->render('blackjack/home.html.twig');
    }
    #[Route("/proj/about", name: "blackjack_about")]
    public function about(): Response
    {
        return $this->render('blackjack/about.html.twig');
    }

    #[Route("/proj/init", name: "blackjack_init", methods: ['POST'])]
    public function gameInit(Request $request, SessionInterface $session): Response
    {
        // Get the request data
        $requestData = $request->request->all();

        $players = [];

        foreach ($requestData as $key => $playerName) {
            if (str_starts_with($key, 'player')) {
                $players[] = $playerName;
            }
        }

        // Initiate "BlackJack" object.
        $game = new BlackJack($players);
        $session->set("blackjack", $game);

        $data = [
            "blackJack" => $game,
            'session' => $session->all()
        ];
        // Render the template with the data
        return $this->render('blackjack/play.html.twig', $data);
    }

    #[Route("/proj/play", name: "blackjack_play", methods: ['GET'])]
    public function gamePlay(Request $request, SessionInterface $session): Response
    {
        // Get the request data
        $requestData = $request->request->all();

        // Get "BlackJack" object.
        $blackJack = $session->get("blackjack");

        $data = [
            "blackJack" => $blackJack,
            'session' => $session->all()
        ];
        // Render the template with the data
        return $this->render('blackjack/play.html.twig', $data);
    }

    #[Route("/proj/dealer", name: "blackjack_dealer")]
    public function dealersTurn(SessionInterface $session): Response
    {
        // Get "BlackJack" object.
        $blackJack = $session->get("blackjack");

        $blackJack->dealerPlays();

        $data = [
            "blackJack" => $blackJack,
            'session' => $session->all()
        ];

        if ($blackJack->areAllPlayersStanding()) {
            return $this->redirectToRoute('blackjack_round_over');
        } else {
            return $this->render('blackjack/dealer.html.twig', $data);
        }
    }

    #[Route("/proj/round-finished", name: "blackjack_round_over")]
    public function roundOver(SessionInterface $session): Response
    {
        // Get "BlackJack" object.
        $blackJack = $session->get("blackjack");

        $blackJack->dealerPlays();
        $blackJack->determineWinnings();

        $data = [
            "blackJack" => $blackJack,
            'session' => $session->all()
        ];
        // Render the template with the data
        return $this->render('blackjack/finish.html.twig', $data);
    }

    #[Route("/proj/new-round", name: "blackjack_new_round")]
    public function newRound(SessionInterface $session): Response
    {
        // Get "BlackJack" object.
        $blackJack = $session->get("blackjack");

        $blackJack->newRoundReset();

        $data = [
            "blackJack" => $blackJack,
            'session' => $session->all()
        ];
        // Render the template with the data
        return $this->redirectToRoute("blackjack_play");
    }

    #[Route("/proj/hit-stand", name: "blackjack_hit_stand", methods: ['GET'])]
    public function hitStand(Request $request, SessionInterface $session): Response
    {
        // Get the request data
        $requestData = $request->request->all();

        // Get "BlackJack" object.
        $blackJack = $session->get("blackjack");

        $data = [
            "blackJack" => $blackJack,
            'session' => $session->all()
        ];
        // Render the template with the data
        return $this->render('blackjack/hit-stand-first.html.twig', $data);
    }

    #[Route("/bet", name: "blackjack_bets", methods: ["POST"])]
    public function setCurrentBets(Request $request, SessionInterface $session): Response
    {
        // Get the "blackjack" object from the session
        $blackJack = $session->get('blackjack');

        foreach ($blackJack->getPlayers() as $playerId => $player) {
            $bet = $request->request->get('bet_' . $player->getId());

            // Set the current bet
            $player->setCurrentBet($bet);

            // Set the balance
            $oldBalance = $player->getBalance();
            $player->setBalance($oldBalance - $bet);
        }

        if (count($blackJack->getDealer()->getCards()) == 0) {
            $blackJack->initRound();
        } else {
            $blackJack->dealRound();
        }

        // Redirect to the game page
        return $this->redirectToRoute('blackjack_hit_stand');
    }

    #[Route("/proj/hit-or-stand", name: "blackjack_hit_or_stand", methods: ['POST'])]
    public function hitOrStand(Request $request, SessionInterface $session): Response
    {
        // Get "BlackJack" object.
        $blackJack = $session->get("blackjack");

        // Get the form data
        $formData = $request->request->all();

        foreach ($formData as $key => $value) {
            if (str_starts_with($key, 'player_')) {
                $playerId = substr($key, 7); // Get the player ID
                $player = $blackJack->getPlayerById($playerId);

                if ($value == 'hit') {
                    if ($blackJack->isBlackJack($player)) {
                        $blackJack->setBlackJack($player);
                    } else {
                        $blackJack->playerHits($player);
                    }
                } else {
                    // Call the stand method on the player
                    $blackJack->playerStands($player);
                }
            }
        }

        foreach ($blackJack->getPlayers() as $player) {
            if ($blackJack->isBlackJack($player)) {
                $blackJack->setBlackJack($player);
            } elseif ($blackJack->isBust($player)) {
                $blackJack->setBust($player);
            }
        }

        // Save the updated "BlackJack" object in the session
        $session->set("blackjack", $blackJack);

        $data = [
            "blackJack" => $blackJack,
            'session' => $session->all()
        ];

        if ($blackJack->areAllPlayersStanding()) {
            return $this->redirectToRoute('blackjack_dealer');
        } else {
            return $this->render('blackjack/hit-stand.html.twig', $data);
        }
    }

}

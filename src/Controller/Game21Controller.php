<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardHand;
use App\Card\DeckOfCards;
use App\Card\Game21;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    #[Route("/game/init", name: "game_init")]
    public function gameInit(SessionInterface $session): Response
    {
        // Initiate "deck21", "game21" and bank and player hands.
        $game21 = new Game21();
        $session->set("game21", $game21);
        $deck = new DeckOfCards();
        $session->set("deck21", $deck);
        $playerHand = new CardHand();
        $session->set("playerHand", $playerHand);
        $bankHand = new CardHand();
        $session->set("bankHand", $bankHand);
        $game21->getScoreBoard();


        $data = [
            "cardDeck" => $deck,
            "game21" => $game21,
            "playerHand" => $playerHand,
            "bankHand" => $bankHand,
            "playerScore" => 0,
            "bankScore" => 0,
            'session' => $session->all()
        ];
        // Render the template with the data
        return $this->render('game21/play.html.twig', $data);
    }

    #[Route("/game/play", name: "game_play")]
    public function gamePlay(SessionInterface $session): Response
    {
        // Get variables from session
        $game21 = $session->get("game21");
        $deck = $session->get("deck21");
        $playerHand = $session->get("playerHand");
        $bankHand = $session->get("bankHand");
        $scoreBoard = $game21->getScoreBoard();

        $playerScore = join(' or ', $scoreBoard['Player']);
        $bankScore = join(' or ', $scoreBoard['Bank']);

        $data = [
            "cardDeck" => $deck,
            "game21" => $game21,
            "playerHand" => $playerHand,
            "bankHand" => $bankHand,
            "playerScore" => $playerScore,
            "bankScore" => $bankScore,
            'session' => $session->all()
        ];

        if (count($scoreBoard['Player']) == 2) {
            if ($scoreBoard['Player'][0] > 21 && $scoreBoard['Player'][1] >= 21) {
                return $this->redirectToRoute('game_bust');
            }
        } else {
            if ($scoreBoard['Player'][0] > 21) {
                return $this->redirectToRoute('game_bust');
            }
        }

        // Render the template with the data
        return $this->render('game21/play.html.twig', $data);
    }

    #[Route("/game/hit", name: "game_hit", methods: ['POST'])]
    public function hit(
        SessionInterface $session
    ): Response {
        $playerHand = $session->get("playerHand");
        $deck = $session->get("deck21");
        $game21 = $session->get("game21");
        $bankHand = $session->get("bankHand");

        $playerHand->addCard($deck->drawCard());
        $game21->countScore('Player', $playerHand);

        $scoreBoard = $game21->getScoreBoard();
        $session->set("scoreBoard", $scoreBoard);

        $data = [
            "cardDeck" => $deck,
            "game21" => $game21,
            "playerHand" => $playerHand,
            "bankHand" => $bankHand,
            "scoreBoard" => $scoreBoard,
            'session' => $session->all()
        ];

        return $this->redirectToRoute('game_play');
    }

    #[Route("/game/stand", name: "game_stand", methods: ['POST'])]
    public function stand(
        SessionInterface $session
    ): Response {
        $playerHand = $session->get("playerHand");
        $deck = $session->get("deck21");
        $game21 = $session->get("game21");
        $bankHand = $session->get("bankHand");

        $bankScore = $game21->bankDraws($deck, $bankHand);
        if (count($bankScore) == 2) {
            while ($bankScore[0] < 17 && $bankScore[1] < 17) {
                $bankScore = $game21->bankDraws($deck, $bankHand);
            }
        } else {
            while ($bankScore[0] < 17) {
                $bankScore = $game21->bankDraws($deck, $bankHand);
            }
        }

        $data = [
            "cardDeck" => $deck,
            "game21" => $game21,
            "playerHand" => $playerHand,
            "bankHand" => $bankHand,
            'session' => $session->all()
        ];

        return $this->redirectToRoute('game_over');
    }

    #[Route("/game/bust", name: "game_bust")]
    public function bust(): Response
    {

        return $this->redirectToRoute('game_over');
    }

    #[Route("/game/gameover", name: "game_over")]
    public function gameOver(SessionInterface $session): Response
    {
        // Get variables from session
        $game21 = $session->get("game21");
        $deck = $session->get("deck21");
        $playerHand = $session->get("playerHand");
        $bankHand = $session->get("bankHand");
        $scoreBoard = $game21->getScoreBoard();

        $playerScore = join(' or ', $scoreBoard['Player']);
        $bankScore = join(' or ', $scoreBoard['Bank']);

        $finalResult = $game21->winner();

        $data = [
            "cardDeck" => $deck,
            "game21" => $game21,
            "playerHand" => $playerHand,
            "bankHand" => $bankHand,
            "playerScore" => $playerScore,
            "bankScore" => $bankScore,
            "finalResult" => $finalResult,
            'session' => $session->all()
        ];

        // Render the template with the data
        return $this->render('game21/gameover.html.twig', $data);
    }

    #[Route("/api/game", name: "game_get", methods: ['GET'])]
    public function standings(SessionInterface $session): Response
    {
        if ($session->has("game21")) {
            $game21 = $session->get("game21");
        } else {
            $game21 = new game21();
            $session->set("game21", $game21);
        }

        $data = [
            'game21' => $game21->getScoreBoard(),
        ];

        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionController extends AbstractController
{
    #[Route("/session", name: "session")]
    public function printSession(SessionInterface $session): Response
    {
        $data = [
            'session' => $session->all()
        ];

        return $this->render('session.html.twig', $data);
    }

    #[Route("/session/delete", name: "session_clear")]
    public function clearSession(SessionInterface $session): Response
    {
        $session->clear();

        $this->addFlash(
            'notice',
            'Session cleared.'
        );

        return $this->redirectToRoute('session');
    }

}

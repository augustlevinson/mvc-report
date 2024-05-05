<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController
{
    #[Route('/lucky/hi')]
    public string $stringy = "strängen hej hej";
    public function hi(): Response
    {
        $number = random_int(0, 9);

        return new Response(
            '<html><body>Hi to you!</body></html>'
        );
    }

    #[Route("/api/quote")]
    public function jsonNumber(): Response
    {
        $number = random_int(0, 9);
        $quotes = [
            "The most courageous act is still to think for yourself. Aloud. - Coco Chanel",
            "You may not control all the events that happen to you, but you can decide not to be reduced by them. - Maya Angelou",
            "The question isn’t who’s going to let me; it’s who is going to stop me. - Ayn Rand",
            "The most effective way to do it, is to do it. - Amelia Earhart",
            "One’s life has value so long as one attributes value to the life of others, by means of love, friendship, indignation and compassion. - Simone de Beauvoir",
            "If you don’t like the road you’re walking, start paving another one. - Dolly Parton",
            "I raise up my voice—not so I can shout, but so that those without a voice can be heard...we cannot succeed when half of us are held back. - Malala Yousafzai",
            "Do not wait for leaders; do it alone, person to person. - Mother Teresa",
            "The most common way people give up their power is by thinking they don’t have any. - Alice Walker",
            "The question isn’t who is going to let me; it’s who is going to stop me. - Ayn Rand"
        ];

        $data = [
            'quote' => $quotes[$number],
            'timestamp' => date("c"),
            'date' => date("l jS \of F Y"),
        ];

        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

}

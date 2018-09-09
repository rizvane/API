<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CreditCardsController extends AbstractController
{
    /**
     * @Route("/credit/cards", name="credit_cards")
     */
    public function index()
    {
        return $this->render('credit_cards/index.html.twig', [
            'controller_name' => 'CreditCardsController',
        ]);
    }
}

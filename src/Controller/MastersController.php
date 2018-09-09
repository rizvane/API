<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MastersController extends AbstractController
{
    /**
     * @Route("/masters", name="masters")
     */
    public function index()
    {
        return $this->render('masters/index.html.twig', [
            'controller_name' => 'MastersController',
        ]);
    }
}

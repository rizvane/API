<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CompaniesController extends AbstractController
{
    /**
     * @Route("/companies", name="companies")
     */
    public function index()
    {
        return $this->render('companies/index.html.twig', [
            'controller_name' => 'CompaniesController',
        ]);
    }
}

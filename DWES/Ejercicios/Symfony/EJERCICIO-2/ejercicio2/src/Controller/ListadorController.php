<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListadorController extends AbstractController
{
    #[Route('/listador', name: 'app_listador')]
    public function index(): Response
    {
        return $this->render('listador/index.html.twig', [
            'controller_name' => 'ListadorController',
        ]);
    }
}

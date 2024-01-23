<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;


class ListadorController extends AbstractController
{
    #[Route("/listar", name: "app_listador")]
    public function listar(): Response
    {

        
    }
}

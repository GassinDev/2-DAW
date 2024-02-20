<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'hub')]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }

    #[Route('/verCanciones', name: 'verCanciones')]
    public function verCanciones(): Response
    {
        return $this->render('listaCanciones.html.twig');
    }

    #[Route('/verUsuarios', name: 'verUsuarios')]
    public function verUsuarios(): Response
    {
        return $this->render('listadoUsuarios.html.twig');
    }

    #[Route('/perfil', name: 'perfil')]
    public function perfil(): Response
    {
        return $this->render('perfil.html.twig');
    }
}

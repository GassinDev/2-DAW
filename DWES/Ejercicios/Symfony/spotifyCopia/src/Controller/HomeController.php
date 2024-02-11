<?php

namespace App\Controller;

use App\Entity\Song;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        return $this->render('home/index.html.twig', [
            'prop1' => 'Hola',
            'prop2' => 'Mundo',
        ]);
    }

    #[Route('/verCanciones', name: 'canciones')]
    public function mostrarElementos(EntityManagerInterface $entityManager): Response
    {
        $canciones = $entityManager->getRepository(Song::class)->findAll();

        return $this->render('song/listaCanciones.html.twig', [
            'canciones' => $canciones, 
        ]);
    }
}

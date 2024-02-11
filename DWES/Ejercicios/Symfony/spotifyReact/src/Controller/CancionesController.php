<?php

namespace App\Controller;

use App\Entity\Song;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CancionesController extends AbstractController
{
    #[Route("/api/canciones", name:"api_canciones_index", methods:"GET")]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $canciones = $entityManager->getRepository(User::class)->findAll();
        $json = json_encode($canciones);
        return new JsonResponse($json);
    }
}

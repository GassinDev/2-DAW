<?php

namespace App\Controller;

use App\Repository\SongRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class APISController extends AbstractController
{
    #[Route('api/ListadoCanciones', name: 'ListadoCanciones')]
    public function cancionesGet(SongRepository $songRepository): Response
    {
        $canciones = $songRepository->findAll();
        return $this->json($canciones);
    }

    #[Route('api/ListadoUsuarios', name: 'ListadoUsuarios')]
    public function usuariosGet(UserRepository $userRepository): Response
    {
        $usuarios = $userRepository->findAll();
        return $this->json($usuarios);
    }
}

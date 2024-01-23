<?php

namespace App\Controller;

use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VinylController
{
    #[Route('/home')]
    public function index(): Response
    {
        $message = '¡Bienvenido!';

        return new Response($message);
    }

    #[Route('/saveStudent1')]
    public function new (EntityManagerInterface $entityManager) : Response{
        $s = new Student();
        $s->setName('Juan');
        $s->setEdad(12);
        $s->setDescripcion("El más loco");

        $entityManager->persist($s);
        $entityManager->flush();
        
        return new Response(sprintf("Funciona"));
        
    }
}



<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GreetingController extends AbstractController
{
    #[Route('/home/{slug}')]
    public function greeting(string $slug = null): Response
    {
        $greet = '';
        if ($slug) {
            if (preg_match('/^[a-zA-ZñÑ]+$/', $slug) && !str_contains($slug, '?')) {
                $greet = "Buenas tardes $slug";
            } else {
                $greet = "ERROR - CARÁCTER INVÁLIDO EN EL NOMBRE";
            }
        } else {
            $greet = 'Buenas tardes amigo';
        }
        
        return $this->render('/greet.html.twig', ["saludo" => $greet, "nombre" => $slug]);
    }

}


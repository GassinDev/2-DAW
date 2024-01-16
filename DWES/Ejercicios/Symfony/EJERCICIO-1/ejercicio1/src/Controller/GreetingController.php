<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GreetingController
{
    #[Route('/home/{slug}')]
    public function index(string $slug = null): Response
    {
        $greet = '';
        if($slug){
            if(preg_match('/^[a-zA-ZñÑ]+$/', $slug) && str_contains("?",$slug) === false){
                $greet = sprintf("<h1>Buenas tardes %s</h1>", $slug);
            }else{
                $greet = "ERROR - CARÁCTER INVÁLIDO EN EL NOMBRE";
            }
            
        }else{
            $greet = sprintf('<h1>Buenas tardes amigo!</h1>');
        }

        return new Response($greet);
    }
}


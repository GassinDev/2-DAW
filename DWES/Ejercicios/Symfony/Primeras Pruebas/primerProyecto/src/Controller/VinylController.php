<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class VinylController extends AbstractController
{
    #[Route('/')]
    public function homepage(): Response
    {
        return $this->render('vinyl/homepage.html.twig', ['title' => 'Hello world!',]);
    }

    #[Route('/browse/{slug}')]
    public function browse(string $slug=null): Response
    {
        $title = str_replace('-',' ',$slug);
        return new Response('Genre: ' .$title);
    }


}

?>
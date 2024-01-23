<?php

namespace App\Controller;

use App\Entity\Producto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/saveProducto')]
    public function new (EntityManagerInterface $entityManager) : Response{
        $s = new Producto();
        $s->setNombre("Leche");
        $s->setDescripcion("Bebida 100% de Vaca");
        $s->setPrecio(1.50);
        $s->setCantidad(4);

        $entityManager->persist($s);
        $entityManager->flush();
        
        return new Response(sprintf("Funciona"));
        
    }

    #[Route('/getProducto')]
    public function consulta(EntityManagerInterface $entityManager): Response
    {
        $productoRespository = $entityManager->getRepository(Producto::class);
        $producto = $productoRespository->findAll();
        dd($producto);
    
        return new Response(sprintf(
            'CONSULTA CON ÉXITO',
        ));
    
    }
}

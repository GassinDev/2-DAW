<?php

namespace App\Controller;

use App\Entity\Producto;
use App\Form\BuscaProduType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProductoType;
use Doctrine\DBAL\Types\FloatType;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'title' => 'Mi tienda',
        ]);
    }

    #[Route('/formProdu', name: 'formularioProducto')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $producto = new Producto();
        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($producto);
            $entityManager->flush();

            return $this->redirectToRoute('save');
        }

        return $this->render('form.html.twig', [
            'form' => $form->createView(),
        ]);
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

    #[Route('/saveProducto', name: 'save')]
    public function guardado(): Response
    {

        return $this->render('save.html.twig', [
            'message' => "Producto añadido con éxito",
        ]);
    }

    #[Route("/listarProductos", name: 'listado')]
    public function listar(EntityManagerInterface $entityManager): Response
    {

        $productoRepository = $entityManager->getRepository(Producto::class);
        $producto = $productoRepository->findAll();

        return $this->render('listar.html.twig', [
            'arrayproducto' => $producto,
        ]);
    }

    #[Route("/buscarProducto", name: 'buscar')]
    public function buscarProducto(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BuscaProduType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $nombreProducto = $form->get('nombre')->getData();

            $productoRepository = $entityManager->getRepository(Producto::class);

            $productoEncontrado = $productoRepository->findOneBy(['nombre' => $nombreProducto]);

            if ($productoEncontrado) {

                return $this->render('mostrar_producto.html.twig', [
                    'producto' => $productoEncontrado,
                ]);
            } else {

                $this->addFlash('error', 'El producto no se encontró.');
                return $this->redirectToRoute('buscar');
            }
        }

        return $this->render('buscar.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}

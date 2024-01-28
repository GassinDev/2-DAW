<?php

namespace App\Controller;

use App\Entity\Producto;
use App\Form\BuscaProduType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProductoType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

$session = new Session();
$session->start();

if (!$session->has('carrito')) {
    $carrito = [];
    $session->set('carrito', $carrito);
}



$session->set('name', 'Drak');

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

    #[Route("/agregarProdu", name: 'agregar_al_carrito')]
    public function agregarAlCarrito(Request $request, SessionInterface $session, EntityManagerInterface $entityManager): Response
    {
        // Get the product ID and quantity from the form
        $productoId = $request->request->get('producto_id');
        $cantidad = (int) $request->request->get('cantidad', 1);

        // Check if the quantity is valid
        if (!is_numeric($cantidad) || $cantidad < 1) {
            $this->addFlash('error', 'Cantidad inválida.');
            return $this->redirectToRoute('listado');
        }

        // Find the product in the database
        $productoRepository = $entityManager->getRepository(Producto::class);
        $productoEncontrado = $productoRepository->find($productoId);

        // Get the current cart from the session
        $carrito = $session->get('carrito', []);

        // Check if the product is already in the cart and update its quantity
        $encontrado = false;
        foreach ($carrito as &$item) {
            if ($item['producto_id'] === $productoId) {
                $item['cantidad'] += $cantidad;
                $encontrado = true;
                break;
            }
        }

        // If the product was not in the cart, add it
        if (!$encontrado) {
            $carrito[] = [
                'producto_id' => $productoId,
                'nombre' => $productoEncontrado->getNombre(),
                'cantidad' => $cantidad,
                'precio' => $productoEncontrado->getPrecio(),
            ];
        }

        // Save the updated cart in the session
        $session->set('carrito', $carrito);

        // Redirect a success message
        return $this->render('agregar.html.twig', [
            'message' => "Producto añadido al carrito",
        ]);
    }


    #[Route("/verCarrito", name: 'carrito')]
    public function carrito(SessionInterface $session): Response
    {
        $carrito = $session->get('carrito', []);

        $totalPrecio = 0;
        foreach ($carrito as $item) {
            $totalPrecio += $item['precio'] * $item['cantidad'];
        }

        return $this->render('carrito.html.twig', [
            'carrito' => $carrito,
            'totalPrecio' => $totalPrecio
        ]);
    }

    #[Route("/eliminar", name: 'eliminar_producto')]
    public function eliminar(Request $request, SessionInterface $session): Response
    {
        $carrito = $session->get('carrito', []);
        $producto_id = $request->request->get('producto_id');

        foreach ($carrito as $key => $producto) {

            if ($producto['producto_id'] == $producto_id) {
                unset($carrito[$key]);
                break;
            }
        }

        $session->set('carrito', $carrito);

        return $this->redirectToRoute('carrito');
    }

    #[Route("/{any}")]
    public function noEncontrada(): Response
    {
        return $this->render('notFound.html.twig');
    }
}

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

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
         // Render the base template with title
        return $this->render('base.html.twig', [
            'title' => 'Mi tienda',
        ]);
    }

    #[Route('/formProdu', name: 'formularioProducto')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Handle form submission for creating new product
        $producto = new Producto();
        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest($request);

        // If form is submitted and valid, save the product
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($producto);
            $entityManager->flush();

            return $this->redirectToRoute('save');
        }

        // Render the form template
        return $this->render('form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/getProducto')]
    public function consulta(EntityManagerInterface $entityManager): Response
    {
        // Retrieve all products from database
        $productoRespository = $entityManager->getRepository(Producto::class);
        $producto = $productoRespository->findAll();

         // Output the products (for debugging)
        dd($producto);

        // Return success response
        return new Response(sprintf(
            'CONSULTA CON ÉXITO',
        ));
    }

    #[Route('/saveProducto', name: 'save')]
    public function guardado(): Response
    {

        // Render the save template with success message
        return $this->render('save.html.twig', [
            'message' => "Producto añadido con éxito",
        ]);
    }

    #[Route("/listarProductos", name: 'listado')]
    public function listar(EntityManagerInterface $entityManager): Response
    {
        // Retrieve all products from database and render the list template
        $productoRepository = $entityManager->getRepository(Producto::class);
        $producto = $productoRepository->findAll();

        return $this->render('listar.html.twig', [
            'arrayproducto' => $producto,
        ]);
    }

    #[Route("/buscarProducto", name: 'buscar')]
    public function buscarProducto(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Handle product search form submission
        $form = $this->createForm(BuscaProduType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Retrieve product name from form
            $nombreProducto = $form->get('nombre')->getData();

            // Retrieve product name from form
            $productoRepository = $entityManager->getRepository(Producto::class);

            $productoEncontrado = $productoRepository->findOneBy(['nombre' => $nombreProducto]);

            // If product is found, render the product template; otherwise, redirect with error message
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
        // Retrieve cart from session and calculate total price
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
        // Retrieve cart from session
        $carrito = $session->get('carrito', []);
        // Retrieve product ID to remove
        $producto_id = $request->request->get('producto_id');

        // Remove product from cart
        foreach ($carrito as $key => $producto) {

            if ($producto['producto_id'] == $producto_id) {
                unset($carrito[$key]);
                break;
            }
        }

         // Save updated cart in session
        $session->set('carrito', $carrito);

        return $this->redirectToRoute('carrito');
    }

    #[Route("/{any}")]
    public function noEncontrada(): Response
    {
        // Render not found template for any unmatched routes
        return $this->render('notFound.html.twig');
    }
}

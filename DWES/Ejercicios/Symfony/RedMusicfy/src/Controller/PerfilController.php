<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/perfil')]
class PerfilController extends AbstractController
{
    #[Route('/{id}', name: 'app_perfil_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_perfil_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/edit/{id}', name: 'edit', methods: ['POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager, UserRepository $userRepository, string $id): Response
    {
        $user = $userRepository->find($id);

        // Obtener datos del formulario de la solicitud
        $username = $request->request->get('username');
        $email = $request->request->get('email');

        // Actualizar los datos del usuario
        $user->setUsername($username);
        $user->setEmail($email);

        // Persistir los cambios en la base de datos
        $entityManager->flush();

        // Redireccionar a una página de confirmación o a donde sea apropiado
        $this->addFlash('success', 'Perfil actualizado con éxito!');
        return $this->redirectToRoute('perfil');
    }

    #[Route('/changePhoto/{id}', name: 'changePhoto', methods: ['POST'])]
    public function changePhoto(Request $request, User $user, EntityManagerInterface $entityManager, UserRepository $userRepository, string $id): Response
    {
        $user = $userRepository->find($id);

        // Obtener datos del formulario de la solicitud
        $photo = $request->files->get('profile-picture');

        if ($photo instanceof UploadedFile) {
            // Generar un nombre único para la foto
            $newFilename = uniqid() . '.' . $photo->guessExtension();

            // Mover el archivo cargado al directorio de destino
            try {
                $photo->move(
                    $this->getParameter('images_directory'), // Directorio de destino configurado en services.yaml
                    $newFilename
                );
            } catch (FileException $e) {
                // Manejar el error si ocurre alguna excepción al mover el archivo
                // Por ejemplo, mostrar un mensaje de error o registrar el error
            }

            $user->setFotoPerfil($newFilename);

            $entityManager->flush();

            $this->addFlash('success', 'Perfil actualizado con éxito!');
            return $this->redirectToRoute('perfil');
        }
    }
}

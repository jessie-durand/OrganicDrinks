<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * Login de connexion avec vérification
     * @Route("admin/login", name="admin_login")
     */

    public function index(AuthenticationUtils $authenticationUtils): Response
    {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('admin/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * Permet de redirigé selon le rôle de l'utilisateur soit dashbord pour l'interne
     * soit les pages admin pour l'admin
     * @Route ("/choose-user-type", name="_choice")
     */
    public function chooseUserType()
    {
        if ($this->isGranted("ROLE_ADMIN")) {
            return $this->redirectToRoute("admin");
        } elseif ($this->isGranted("ROLE_USER")) {
            return $this->redirectToRoute("home");
        }
    }
}

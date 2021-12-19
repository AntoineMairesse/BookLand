<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BookLandController extends AbstractController
{
    public function accueil(): Response
    {
        return $this->render('book_land/accueil.html.twig');
    }

    public function afficher_liste_auteurs()
    {
        return $this->render('auteur/index.html.twig');
    }

    public function afficher_liste_livres()
    {
        return $this->render('livre/index.html.twig');
    }

    public function afficher_liste_genres()
    {
        return $this->render('genre/index.html.twig');
    }
}

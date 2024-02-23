<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SelectController extends AbstractController
{
    #[Route('/select-character1/{name}', name: 'select_character1')]
    public function selectCharacter1(Request $request, string $name): Response
    {
        // Enregistrer l'ID du personnage sélectionné en session
        $request->getSession()->set('selected_character1_name', $name);

        // Redirection vers la page de jeu
        return $this->redirectToRoute('choiceJ2.index');
    }

    #[Route('/select-character2/{name}', name: 'select_character2')]
    public function selectCharacter2(Request $request, string $name): Response
    {
        // Enregistrer l'ID du personnage sélectionné en session
        $request->getSession()->set('selected_character2_name', $name);

        // Redirection vers la page de jeu
        return $this->redirectToRoute('setGame.index');
    }
}

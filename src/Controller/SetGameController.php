<?php

namespace App\Controller;

use App\Personnage\Mage;
use App\Personnage\Guerrier;
use App\Personnage\Pretre;
use App\Personnage\Archer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SetGameController extends AbstractController
{
    #[Route('/setGame','setGame.index')]
    public function index(Request $request, SessionInterface $session): Response
    {
        // Récupérer l'ID du personnage sélectionné depuis la session
        $selectedCharacter1 = $request->getSession()->get('selected_character1_name');
        $selectedCharacter2 = $request->getSession()->get('selected_character2_name');

        if (empty($selectedCharacter1) || empty($selectedCharacter2)) {
            return $this->redirectToRoute('start_page');
        } else {
            if ($selectedCharacter1 == 'mage') {
                $player1 = new Mage();
            }
            if ($selectedCharacter1 == 'guerrier') {
                $player1 = new Guerrier();
            }
            if ($selectedCharacter1 == 'pretre') {
                $player1 = new Pretre();
            }
            if ($selectedCharacter1 == 'archer') {
                $player1 = new Archer();
            }
            if ($selectedCharacter2 =='mage') {
                $player2 = new Mage();
            }
            if ($selectedCharacter2 == 'guerrier') {
                $player2 = new Guerrier();
            }
            if ($selectedCharacter2 == 'pretre') {
                $player2 = new Pretre();
            }
            if ($selectedCharacter2 == 'archer') {
                $player2 = new Archer();
            }
        }

        $session->set('player1', [
            'name' => $player1->getName(),
            'pv' => $player1->getPv(),
            'initial_pv' => $player1->getPv(),
            'def' => $player1->getDef(),
            'att' => $player1->getAtt(),
        ]);

        $session->set('player2', [
            'name' => $player2->getName(),
            'pv' => $player2->getPv(),
            'initial_pv' => $player2->getPv(),
            'def' => $player2->getDef(),
            'att' => $player2->getAtt(),
        ]);

        $session->set('tour', 1);

    return $this->redirectToRoute('game_page');
    }
}
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

class GameController extends AbstractController
{ 
    #[Route('/game', name: 'game_page')]
    public function gamePage(Request $request, SessionInterface $session): Response
    {
        // Vérifier si les personnages des joueurs sont définis en session
        $player1 = $session->get('player1');
        $player2 = $session->get('player2');

        // Si les personnages ne sont pas définis, rediriger vers la page de sélection des personnages
        if (!$player1 || !$player2) {
            return $this->redirectToRoute('start_page');
        }

        $PourcentagePvJ1 = ($player1['pv'] / $player1['initial_pv'])* 100;
        $PourcentagePvJ2 = ($player2['pv'] / $player2['initial_pv'])* 100;

        // Afficher les informations des joueurs
        return $this->render('pages/game.html.twig', [
            'player1name' => $player1['name'],
            'player1pv' => $player1['pv'],
            'player1def' => $player1['def'],
            'player1att' => $player1['att'],
            'player2name' => $player2['name'],
            'player2pv' => $player2['pv'],
            'player2def' => $player2['def'],
            'player2att' => $player2['att'],
            'player1' => $player1,
            'player2' => $player2,
            'tour' => $session->get('tour'),
            'pourcentage_pv_j1' => $PourcentagePvJ1,
            'pourcentage_pv_j2' => $PourcentagePvJ2
        ]);
    }

    #[Route('/attaquer/{Player}', name: 'attaquer')]
    public function attaquer(Request $request, string $Player, SessionInterface $session): Response
    {
        $player1 = $session->get('player1');
        $player2 = $session->get('player2');

        if ($Player == 'player1') {
            $player1Att = $player1['att'];
            $player2Def = $player2['def'];
            $player2Vie = $player2['pv'];
    
            $newPvPlayer2 = $player2Vie - ($player1Att - ($player1Att * $player2Def));
    
            $player2['pv'] = $newPvPlayer2;
            $session->set('player2', $player2);
            $session->set('tour', 2);
        }
    
        if ($Player == 'player2') {
            $player2Att = $player2['att'];
            $player1Def = $player1['def'];
            $player1Vie = $player1['pv'];
            
            $newPvPlayer1 = $player1Vie - ($player2Att - ($player2Att * $player1Def));
    
            $player1['pv'] = $newPvPlayer1;
            $session->set('player1', $player1);
            $session->set('tour', 1);
        }
        
        return $this->redirectToRoute('game_page');
    }    

    #[Route('/attaque_speciale/{Perso}/{Player}/{OtherPlayer}', name: 'attaque_speciale')]
    public function attaqueSpeciale(Request $request, string $Perso, string $Player, string $OtherPlayer, SessionInterface $session): Response
    {
        $player = $session->get($Player);
        $otherplayer = $session->get($OtherPlayer);

        if ($Perso == 'Guerrier') {
            $player['def'] = 0.3;
            $player['att'] = 25;
        }

        if ($Perso == 'Pretre') {
            $newPV = $player['pv'] + 30;
            if ($player['pv'] <= 80) {
                $player['pv'] = $newPV;
            } else {
                $player['pv'] = 80;
            }
        }

        if ($Perso == 'Archer') {
            $ramdom = rand(2, 5);
            $otherplayer['pv'] -= 12 * $ramdom;
        }

        if ($Perso == 'Mage') {
            $otherplayer['pv'] -= 40;
        }
    }

    $session->set($Player, $player);
    $session->set($OtherPlayer, $otherplayer);
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class StartController extends AbstractController 
{
    #[Route('/','start_page', methods: ['GET'])]
    public function index(SessionInterface $session): Response 
    {
        $session->invalidate();
        
        var_dump($session->get('selected_character1_name'));
        var_dump($session->get('selected_character2_name'));
        return $this->render('pages/start.html.twig');
    }
}

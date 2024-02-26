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
        
        return $this->render('pages/start.html.twig');
    }
}

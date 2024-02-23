<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChoiceJ2Controller extends AbstractController 
{
    #[Route('/choiceJ2','choiceJ2.index', methods: ['GET'])]
    public function index(): Response 
    {
        return $this->render('pages/choicej2.html.twig');
    }
}
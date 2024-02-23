<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChoiceJ1Controller extends AbstractController 
{
    #[Route('/choiceJ1','choiceJ1.index', methods: ['GET'])]
    public function index(): Response 
    {
        return $this->render('pages/choicej1.html.twig');
    }
}
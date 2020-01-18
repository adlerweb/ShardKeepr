<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FootprintController extends AbstractController
{
    /**
     * @Route("/footprint", name="footprint")
     */
    public function index()
    {
        return $this->render('footprint/index.html.twig', [
            'controller_name' => 'FootprintController',
        ]);
    }
}

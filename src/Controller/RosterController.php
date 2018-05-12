<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RosterController extends Controller
{
    /**
     * @Route("/roster", name="roster")
     */
    public function index()
    {
        return $this->render('roster.html.twig');
    }
}

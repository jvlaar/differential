<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReleaseController extends Controller
{
    /**
     * @Route("/release", name="release")
     */
    public function release()
    {
        return $this->render('release.html.twig');
    }

    /**
     * @Route("/releases", name="releases")
     */
    public function releases()
    {
        return $this->render('releases.html.twig');
    }
}

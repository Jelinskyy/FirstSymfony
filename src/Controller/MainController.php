<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PostRepository;

class MainController extends AbstractController
{
    /**
    * @Route("/", name="index")
    */
    public function index()
    {
        return $this->render("main/index.html.twig");
    }
}

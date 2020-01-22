<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    public function index()
    {
        return $this->render("main/index.html.twig");
    }

    public function show(Request $request)
    {
        $name = $request->get('id');
        return $this->render("main/show.html.twig", compact('name'));
    }
}

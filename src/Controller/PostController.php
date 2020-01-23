<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;

class PostController extends AbstractController
{
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->findAll();
        $controller_name = 'PostsController';

        dump($posts);

        return $this->render('post/index.html.twig', compact(['posts', 'controller_name']));
    }

    public function create()
    {
        $post = new Post();
        $post->setTitle('new Title');

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response('post was created');
    }

    public function show($id, PostRepository $postRepository)
    {
        $post = $postRepository->find($id);
        dd($post);

        return $this->render('post/index.html.twig', compact(['post']));
    }
}

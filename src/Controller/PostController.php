<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class PostController extends AbstractController
{
    /**
    * @Route("/post", name="post_index")
    */
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->findAll();
        $controller_name = 'PostsController';

        return $this->render('post/index.html.twig', compact(['posts', 'controller_name']));
    }

    /**
    * @Route("/post/create", name="post_create")
    */
    public function create()
    {
        $post = new Post();
        $post->setTitle('new Title');

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response('post was created');
    }

    /**
    * @Route("/show/{id}", name="post_show")
    * @ParamConverter("post", class="App\Entity\Post")
    */
    public function show(Post $post)
    {
        dd($post);

        return $this->render('post/show.html.twig', compact('post'));
    }
    /**
    * @Route("/delete/{id}", name="post_delete", methods={"DELETE"})
    * @ParamConverter("post", class="App\Entity\Post")
    */
    public function delete(Post $post)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($post);
        $em->flush();

        $this->addFlash('success', 'Post was removed');

        return $this->redirect($this->generateUrl('post_index'));
    }
}

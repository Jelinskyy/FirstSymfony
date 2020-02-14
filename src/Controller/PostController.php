<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Form\PostType;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AbstractController
{
    /**
    * @Route("/", name="post_index")
    */
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->findAll();
        $controller_name = 'PostsController';

        return $this->render('post/index.html.twig', compact(['posts', 'controller_name']));
    }

    /**
    * @Route("/create", name="post_create")
    */
    public function create(Request $request)
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();

            /** @var UploadedFile $file */
            $file = $request->files->get('post');
            $file = $file['attachment'];

            if ($file) {
                $filename = md5(uniqid()) . '.' . $file->guessClientExtension();
                $file->move(
                    $this->getParameter('uploads_dir') ,
                    $filename
                );

                $post->setImage($filename);
            }

            $em -> persist($post);
            $em -> flush();

            $this->addFlash('success', "post: {$post->getTitle()}, was created");
            return $this->redirect($this->generateUrl("post_index"));
        }


        return $this->render('post/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
    * @Route("/show/{id}", name="post_show")
    * @ParamConverter("post", class="App\Entity\Post")
    */
    public function show(Post $post)
    {
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

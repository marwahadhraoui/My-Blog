<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Faker\Factory;
class HomeController extends AbstractController
{
    /**
     * @Route("/blog", name="home")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repo->findAll();

        $cat = $this->getDoctrine()->getRepository(Category::class);
        $categories = $cat->findAll();
        return $this->render('home/index.html.twig', [
            'posts'=>$posts,
            'categories' =>$categories
        ]);
    }

    /**
     * @Route("/posts/{id}", name="show_post")
     */
    public function show(Post $post)
    {
        return $this->render('home/post.html.twig', [
            'post'=>$post
        ]);
    }

 


     /**
     * @Route("/base", name="base")
     */
    public function base(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repo->findAll();

        $cat = $this->getDoctrine()->getRepository(Category::class);
        $categories = $cat->findAll();
        
        return $this->render('base.html.twig', [
            'posts'=>$posts,
            'categories' =>$categories
        ]);
    }

    /**
     * @Route("/contact",name="contact")
     */
    public function contact()

    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repo->findAll();

        $cat = $this->getDoctrine()->getRepository(Category::class);
        $categories = $cat->findAll();
        return $this->render('home/contact.html.twig', [
            'posts'=>$posts,
            'categories' =>$categories
        ]);
    }  

    /**
     * @Route("/")
     */
    public function homepage()
    {
        return $this->render('index.html.twig');
    } 

   
    
    
}

<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(ManagerRegistry $doctrine)
    {
         $em = $doctrine->getManager();
         $contact = new Contact();
         $contact->setNom($_GET['nom']);
         $contact->setPrenom($_GET['prenom']);
         $contact->setAdresse($_GET['email']);
         $contact->setSujet($_GET['sujet']);
         $contact->setMessage($_GET['message']);
         $em->persist($contact);
         $em->flush();
        return $this->render('contact/index.html.twig');
           
       
    }
}

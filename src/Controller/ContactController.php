<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(ManagerRegistry $doctrine, MailerInterface $mailer)
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
        $html = "<p>Bonjour ".$_GET['nom']." ".$_GET['prenom'].", on a bien reçu votre message et on revient vers vous au plus vite!</p>";
        //sendmail
        $email = (new Email())
        ->from('mailert63@gmail.com')
        ->to($_GET['email'])
        ->cc('mailert63@gmail.com')
        ->subject('Contact')
        ->html($html);
        $mailer->send($email);
        return $this->render('contact/index.html.twig');
           
       
    }
}

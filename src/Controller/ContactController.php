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
        $contact->setNom($_POST['nom']);
        $contact->setPrenom($_POST['prenom']);
        $contact->setAdresse($_POST['email']);
        $contact->setSujet($_POST['sujet']);
        $contact->setMessage($_POST['message']);
        $em->persist($contact);
        $em->flush();
        $html = "<p>Bonjour ".$_POST['nom']." ".$_POST['prenom'].", on a bien reçu votre message et on revient vers vous au plus vite!</p>";
        //sendmail
        $email = (new Email())
        ->from('mailert63@gmail.com')
        ->to($_POST['email'])
        ->cc('mailert63@gmail.com')
        ->subject('Contact')
        ->html($html);
        $mailer->send($email);
        return $this->render('contact/succes.html.twig');
           
       
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;




class MailController extends AbstractController
{
    /**
     * @Route("/mail", name="mail")
     */
    public function index(MailerInterface $mailer): Response
    {
        //regular email : add text or html content
        $email = (new Email())
        ->from('mailerstage@gmail.com')
        ->to('fourattjouini@gmail.com')
        ->cc('hadhraouimarwa21@gmail.com')
        ->subject('A7la ness')
        //use this to send only text
        //->text('Sending emails is fun again!')
        //use this to send html content
        ->html('<p>See Twig integration for better HTML integration!</p>');
        
        //email with a template
        $TemplatedEmail = (new TemplatedEmail())
        ->from('mailerstage@gmail.com')
        ->to('fourattjouini@gmail.com')
        ->cc('hadhraouimarwa21@gmail.com')
        ->subject('A7la ness')
        //use this to send only text
        //->text('Sending emails is fun again!')
        //use this to send html content
        //->html('<p>See Twig integration for better HTML integration!</p>')
        //use this for html templates
        ->htmlTemplate('mail/mail.html.twig')
        ->context([
            'price' => 7500,
            'username' => 'fourat',
        ]);
        $mailer->send($TemplatedEmail);
        dd("the email was sent");
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use App\Service\MailerService;

class PaymentController extends AbstractController
{
    /**
     * @Route("/payment", name="payment")
     */
    public function index(): Response
    {
        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
        ]);
    }
    /**
     * @Route("/payHotel", name="payment")
     */
    public function handleHotelPayment(MailerInterface $mailer, ContainerInterface $container){
        //send mail here
        $ms = new MailerService($container);
        $ms->sendHotelMail($mailer);
        //redirect to confirmation screen
        return $this->render('payment/confirmed.html.twig', [
        ]);
    }
    /**
     * @Route("/payService", name="payment")
     */
    public function handleServicePayment(MailerInterface $mailer, ContainerInterface $container){
        //send mail here
        $ms = new MailerService($container);
        $ms->sendServiceMail($mailer);
        //redirect to confirmation screen
        return $this->render('payment/confirmed.html.twig', [
        ]);
    }


    

}

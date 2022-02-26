<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Entity\Reservation;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Chambre::class);
        $chambres = $repo->findAll();

        return $this->render('reservation/index.html.twig', [
            'chambres' => $chambres,
        ]);
    }


    /**
     * @Route("/check", name="check")
     */
    public function check(ManagerRegistry $doctrine)
    {
        // dd($_GET['checkIn']);
        $checkIn= \DateTime::createFromFormat('Y-m-d', $_GET['checkIn']);
        $checkOut=\DateTime::createFromFormat('Y-m-d', $_GET['checkOut']);
        if($checkOut<$checkIn){
            return new Response('<h1>Check out invalid !<h1>');
        }else{
        $entityManager = $doctrine->getManager();
        $reservation = new Reservation();
        $chambreId = $_GET['room'];
        $repo = $this->getDoctrine()->getRepository(Chambre::class);
        $chambre = $repo->find($chambreId);
        $reservation->setCheckIn(\DateTime::createFromFormat('Y-m-d', $_GET['checkIn']));
        $reservation->setCheckOut(\DateTime::createFromFormat('Y-m-d', $_GET['checkOut']));
        $reservation->setRoom($chambre);
        $reservation->setAdult($_GET['adult']);
        $reservation->setChildren($_GET['children']);
        $entityManager->persist($reservation);
        $entityManager->flush();
        $id = $reservation->getId();
        $session = new Session();
        $session->start();
        $session->set('id', $id);


        return $this->redirectToRoute('hotel');
        }   
    }
}

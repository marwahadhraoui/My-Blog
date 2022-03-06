<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\Reservation;
use App\Entity\ReservationHotel;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class HotelController extends AbstractController
{
    /**
     * @Route("/hotel", name="hotel")
     */
    public function index(ManagerRegistry $doctrine)

    {
        $repo = $this->getDoctrine()->getRepository(Hotel::class);
        $hotels = $repo->findBy(['disponible'=>true]);
        $session = new Session();
        $id = $session->get('id');
        
        return $this->render('hotel/index.html.twig', [
            'hotels' => $hotels,
            'id' => $id
        ]);
    }

     /**
     * @Route("/setInfo", name="setInfo",methods={"GET","POST"})
     */
    public function setInfo(ManagerRegistry $doctrine)

    {
        $session = new Session();
        $idH=$session->get('idHotel');
        $hotel = $this->getDoctrine()->getRepository(Hotel::class);
        $h = $hotel->findOneBy(['id' => $idH]);
        $nomHotel =$h->getNom();
        $prixNuitee = $h->getPrixNuitee();
        $em = $doctrine->getManager();
       
        $id = $session->get('id');
        $repo = $this->getDoctrine()->getRepository(Reservation::class);
        $check = $repo->findOneBy(['id' =>$id]);
        $reservationH = new ReservationHotel();
        $reservationH->setNomClient($_POST['nom']);
        $reservationH->setPrenomClient($_POST['prenom']);
        $reservationH->setVille($_POST['ville']);
        $reservationH->setAdresseClient($_POST['adresse']);
        $reservationH->setCodePostal($_POST['codeP']);
        $reservationH->setTelephone($_POST['telephone']);
        $reservationH->setEmail($_POST['email']);
        $reservationH->setChecks($check);
        $reservationH->setHotel($h);

        $em->persist($reservationH);
        $em->flush();
        $session->set('reservation_hotel', $reservationH);
        //redirect to Paiment
        return $this->render("payment/paymentHotel.html.twig",[
            'nomHotel' => $nomHotel,
            'prixNuitee' => $prixNuitee
        ]
    );



    }
}

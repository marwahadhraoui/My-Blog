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
     * @Route("/setInfo", name="setInfo")
     */
    public function setInfo(ManagerRegistry $doctrine)

    {
        $idH=$_GET['idHotel'];
        $hotel = $this->getDoctrine()->getRepository(Hotel::class);
        $h = $hotel->findOneBy(['id' => $idH]);
        $nomHotel =$h->getNom();
        $prixNuitee = $h->getPrixNuitee();
        $em = $doctrine->getManager();
        $session = new Session();
        $id = $session->get('id');
        $repo = $this->getDoctrine()->getRepository(Reservation::class);
        $check = $repo->findOneBy(['id' =>$id]);
        $reservationH = new ReservationHotel();
        $reservationH->setNomClient($_GET['nom']);
        $reservationH->setPrenomClient($_GET['prenom']);
        $reservationH->setVille($_GET['ville']);
        $reservationH->setAdresseClient($_GET['adresse']);
        $reservationH->setCodePostal($_GET['codeP']);
        $reservationH->setTelephone($_GET['telephone']);
        $reservationH->setEmail($_GET['email']);
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

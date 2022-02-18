<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\Client;
use App\Entity\ReservationService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    /**
     * @Route("/service/{id}", name="service")
     */
    public function index($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Service::class);
        $service = $repo->find($id);

        return $this->render('service/index.html.twig', [
            'service' => $service,
        ]);
    }


    /**
     * @Route("/reserver/", name="reserver",methods={"GET"})
     */
    public function reserver(ManagerRegistry $doctrine)

    {
        $entityManager = $doctrine->getManager();


        //récuperer l'id du service
        $serviceId = $_GET['serviceId'];

        //création de l'objet service
        $service = new Service();

        //création de l'objet client
        $reservationService = new ReservationService();

        //recupérer les données du service selectionnné
        $repo = $this->getDoctrine()->getRepository(Service::class);
        $service_info = $repo->find($serviceId);
        // diminuer la quantité de stock
        $service_info->setStock(($service_info->getStock()) - 1);
       

            //set les données du client
            $reservationService->setNomClient($_GET['nom']);
            $reservationService->setPrenomClient($_GET['prenom']);
            $reservationService->setMail($_GET['mail']);
            $reservationService->setTelephone($_GET['telephone']);
            $reservationService->setService($service_info);


            $entityManager->persist($reservationService);
            $entityManager->flush();
            //redirect to second form
            return $this->render('payment/index.html.twig', [
                'service' => $service_info,
            ]);
       
    }
}

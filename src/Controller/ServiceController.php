<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\Client;
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
        $service =new Service();

        //création de l'objet client
        $client = new Client();

        //recupérer les données du service selectionnné
        $repo =$this->getDoctrine()->getRepository(Service::class);
        $service_info = $repo->find($serviceId);

        //set les données du client
        $client->setNom($_GET['nom']);
        $client->setPrenom($_GET['prenom']);
        $client->setMail($_GET['mail']);
        $client->setTelephone($_GET['telephone']);
        $client->addService($service_info);
        
       
        $entityManager->persist($client);
        $entityManager->flush();
        //redirect to second form

        return $this->render('payment/index.html.twig', [
            'service' => $service_info,
        ]);
    }
}

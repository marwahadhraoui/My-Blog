<?php
namespace App\Service;

use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\ReservationHotel;
use App\Entity\ReservationService;
use App\Entity\Reservation;
use App\Service\MailerService;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\ContainerInterface;



class MailerService 
{
    private $templating;

    public function __construct(ContainerInterface $container)
    {
        $this->templating = $container->get('twig');
        $this->kernel = $container->get('kernel');
    }
    public function sendHotelMail($mailer)
    {

        //get reservation_hotel from session
        $session = new Session();
        $ResaH = $session->get('reservation_hotel');
        //create pj
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);
        //nom service
        $nomhotel = $ResaH->getHotel()->getNom();
        $nomService = "Séjour au ".$nomhotel;
        //description service
        $check = $ResaH->getChecks();
        $checkIn = date('Y-m-d', strtotime($check->getCheckIn()->date));
        $checkOut = date('Y-m-d', strtotime($check->getCheckOut()->date));
        $daysBetween = round((strtotime($checkOut) - strtotime($checkIn)) / (60 * 60 * 24));
        $descriptionService = "Du: ".$checkIn." Au: ".$checkOut;
        //prix nuitée
        $pu = $ResaH->getHotel()->getPrixNuitee();
        //quantity
        $qty = $daysBetween;
        //prepare html
        $html = $this->templating->render('pdf/invoice_hotel.html.twig', [
            'id' => $ResaH->getId(),
            'nomService' => $nomService,
            'description' => $descriptionService,
            'pu' => $pu,
            'qty' => $qty,
            'creationDate' => date('Y-m-d'),
            'nomClient' =>$ResaH->getNomClient()." ".$ResaH->getPrenomClient(),
            'nomHotel' => $nomhotel,
            'adresseClient' =>$ResaH->getAdresseClient(),
            'emailClient' => $ResaH->getEmail()
        ]);
        $dompdf->loadHtml($html);
        $dompdf->render();
        //save binary data
        $output = $dompdf->output();
        //pdf save location
        $publicDirectory = $this->kernel->getProjectDir() . '/public/invoices/';
        $filename = "invoice_hotel_".$nomhotel."_".$ResaH->getId().".pdf";
        $pdfFilepath =  $publicDirectory . $filename;
        file_put_contents($pdfFilepath, $output);

        //send the mail
        $TemplatedEmail = (new TemplatedEmail())
        ->from('mailert63@gmail.com')
        ->to($ResaH->getEmail())
        ->cc('mailert63@gmail.com')
        ->subject('A7la ness')
        ->htmlTemplate('mail/mail.html.twig')
        ->context([
            'price' => 7500,
            'username' => 'fourat',
        ])
        //add pj
        ->attachFromPath($pdfFilepath);

        //send the email
        $mailer->send($TemplatedEmail);
    }

    public function sendServiceMail($mailer)
    {
        //based on sendHotelMail
        //to-do
        $session = new Session();
        $ResaS = $session->get('reservationService');
        //create pj
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);
        //nom service
        $nomService = $ResaS->getService()->getNom();
        //prix service
        $pu = $ResaS->getService()->getPrix();
        //quantity
        $qty = 1;
        //prepare html
        $html = $this->templating->render('pdf/invoice_service.html.twig', [
            'id' => $ResaS->getId(),
            'nomService' => $nomService,
            'pu' => $pu,
            'qty' => $qty,
            'creationDate' => date('Y-m-d'),
            'nomClient' =>$ResaS->getNomClient()." ".$ResaS->getPrenomClient(),
            'nomService' => $nomService,
            'emailClient' => $ResaS->getMail()
        ]);
        $dompdf->loadHtml($html);
        $dompdf->render();
        //save binary data
        $output = $dompdf->output();
        //pdf save location
        $publicDirectory = $this->kernel->getProjectDir() . '/public/invoices/';
        $filename = "invoice_service_".$nomService."_".$ResaS->getId().".pdf";
        $pdfFilepath =  $publicDirectory . $filename;
        file_put_contents($pdfFilepath, $output);
        //send the mail
        $TemplatedEmail = (new TemplatedEmail())
        ->from('mailert63@gmail.com')
        ->to($ResaS->getMail())
        ->cc('mailert63@gmail.com')
        ->subject('A7la ness')
        ->htmlTemplate('mail/mail.html.twig')
        ->context([
            'price' => 7500,
            'username' => 'fourat',
        ])
        //add pj
        ->attachFromPath($pdfFilepath);

        //send the email
        $mailer->send($TemplatedEmail);
    }
}
?>
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Service\MailerService;

class PdfController extends AbstractController
{
    /**
     * @Route("/pdf", name="pdf")
     */
    public function index(): Response
    {
        //add options such as font
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        //create the pdf object
        $dompdf = new Dompdf($pdfOptions);
        //add the html content
        $html = $this->renderView('pdf/invoice_hotel.html.twig', [
            'id' => 1,
            'nomService' => "mon service",
            'description' => "description du service",
            'pu' => 100,
            'qty' => 10,
            'creationDate' => date('Y-m-d'),
            'dueDate' => date('Y-m-d', strtotime("+1 months", strtotime(date('Y-m-d'))))
        ]);
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        //$dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        //save to disk
        //save binary data
        $output = $dompdf->output();
        //pdf save location
        $publicDirectory = $this->getParameter('kernel.project_dir') . '/public/invoices/';
        $filename = "myfile.pdf";
        $pdfFilepath =  $publicDirectory . $filename;
        file_put_contents($pdfFilepath, $output);
        
        // Output the generated PDF to Browser (force download)
        // $dompdf->stream("mypdf.pdf", [
        //     "Attachment" => true
        // ]);

        // Output the generated PDF to Browser (inline view)(testing purposes)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }
}

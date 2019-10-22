<?php

namespace App\Controller;

use App\Entity\Competition;
use App\Repository\CompetitionRepository;
use App\Services\ExcelExtract;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function index()
    {
        return $this->render('index/index.html.twig');
    }


    /**
     * @Route("/remove", name="remove")
     * @return Response
     */
    public function remove()
    {
        $f = new Filesystem();
        $f->remove('../public/assets/doc/partie.json');
        $f->remove('../public/assets/doc/Fichier.xlsx');

        return $this->redirectToRoute("index");
    }


    /**
     * @Route("/view", name="view")
     * @param ExcelExtract $excelExtract
     * @return Response
     */
    public function view(ExcelExtract $excelExtract)
    {
        $fichierJoueurs = $excelExtract::ExceltoPhp('../public/assets/doc/Fichier.xlsx');
        $tableauJoueurs = $excelExtract::phpToJson($fichierJoueurs);
        $tempsTrous = [14, 15, 13, 17, 17, 16, 14, 19, 12, 15, 14, 18, 16, 13, 14, 17, 13, 15];

        $info_compet = $this->getDoctrine()->getManager()->getRepository(Competition::class)->findOneBy(['id' => 8]);


        return $this->render('index/view.html.twig', [
            'info_compet' => $info_compet,
            'parties' => $tableauJoueurs,
            'trous' => $tempsTrous,
        ]);
    }

    /**
     * @Route ("/generatepdf", name="pdf")
     * @throws Html2PdfException
     */
    public function pdfGenerator()
    {
        // TODO :: recuperer d'abord les infos nom competition et date depuis la db
        $nomCompet = $this->getDoctrine()->getManager()->getRepository(CompetitionRepository::class)->findOneBy(['nom_compet' => 'sss']);
        dd($nomCompet);
        $dateCompet = $this->getDoctrine()->getManager()->getRepository(CompetitionRepository::class)->findOneBy(['name' => 'date_compet']);
        $pdfFile = new Html2Pdf('L', 'A4', 'fr');
        $pdfFile->writeHTML(/*mettre le tableau ici*/);
        $nomPDF = str_replace(' ', '_', $nomCompet." du ".$dateCompet."_AwuziWazatus");
        $pdfFile->output($nomPDF.".pdf");
    }
}
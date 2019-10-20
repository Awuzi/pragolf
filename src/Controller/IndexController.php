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
        $hello = 'Hello world';

        return $this->render('index/index.html.twig', [
            'hello' => $hello,
        ]);
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
     */
    public function view()
    {
        $fichierJoueurs = ExcelExtract::ExceltoPhp('../public/assets/doc/Fichier.xlsx');
        $tableauJoueurs = ExcelExtract::phpToJson($fichierJoueurs);
        $trous = array(14, 15, 13, 17, 17, 16, 14, 19, 12, 15, 14, 18, 16, 13, 14, 17, 13, 15);
        $heureDepart = 7;
        $minDepart = 30;
        $nomCompet = $this->getDoctrine()->getRepository(Competition::class)->findBy(['nomCompet']);
        dd($nomCompet);

        //(ExcelExtract::toHtmlTab());

        return $this->render('index/view.html.twig', [
            'joueurs' => $tableauJoueurs,
            'trous' => $trous,
            'h' => $heureDepart,
            'm' => $minDepart,
        ]);
    }

    /**
     * @Route ("/generatepdf", name="pdf")
     * @throws Html2PdfException
     */
    public function pdfGenerator()
    {
        // TODO :: recuperer d'abord les infos nom competition et date depuis la db
        $nomCompet = $this->getDoctrine()->getManager()->getRepository(CompetitionRepository::class)->findOneBy(['name' => 'nom_compet']);
        $dateCompet = $this->getDoctrine()->getManager()->getRepository(CompetitionRepository::class)->findOneBy(['name' => 'date_compet']);
        $pdfFile = new Html2Pdf('L', 'A4', 'fr');
        $pdfFile->writeHTML(/*mettre le tableau ici*/);
        $nomPDF = str_replace(' ', '_', $nomCompet." du ".$dateCompet."_AwuziWazatus");
        $pdfFile->output($nomPDF.".pdf");
    }
}
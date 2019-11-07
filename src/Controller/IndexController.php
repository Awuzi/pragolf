<?php

namespace App\Controller;

use App\Entity\Competition;
use App\Services\ExcelExtract;
use PhpOffice\PhpSpreadsheet\Exception;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IndexController extends AbstractController
{

    //TODO request la bdd avec id correspondant du golf pour recuperer les 18 trous
    private $tempsTrous = [14, 15, 13, 17, 17, 16, 14, 19, 12, 15, 14, 18, 16, 13, 14, 17, 13, 15];


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
        $f->remove('../public/assets/doc/Fichier.xlsx');

        return $this->redirectToRoute("index");
    }


    /**
     * @Route("/view", name="view")
     * @param ExcelExtract $excelExtract
     * @return Response
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function view(ExcelExtract $excelExtract)
    {
        $tableauJoueurs = $excelExtract::phpToJson($excelExtract::ExceltoPhp('../public/assets/doc/Fichier.xlsx'));
        $tempsTrous = $this->tempsTrous;
        $info_compet = $this->getDoctrine()->getManager()->getRepository(Competition::class)->findOneBy([], ['id' => 'DESC']);

        return $this->render('index/view.html.twig', [
            'info_compet' => $info_compet,
            'parties' => $tableauJoueurs,
            'trous' => $tempsTrous,
        ]);
    }

    /**
     * @Route ("/pdf", name="pdf")
     * @param ExcelExtract $excelExtract
     * @throws Exception
     * @throws Html2PdfException
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function pdfGenerator(ExcelExtract $excelExtract)
    {
        $tableauJoueurs = $excelExtract::phpToJson($excelExtract::ExceltoPhp('../public/assets/doc/Fichier.xlsx'));
        $tempsTrous = $this->tempsTrous;
        $info_compet = $this->getDoctrine()->getManager()->getRepository(Competition::class)->findOneBy([], ['id' => 'DESC']);

        $template = $this->renderView('index/pdf.html.twig', [
            'info_compet' => $info_compet,
            'parties' => $tableauJoueurs,
            'trous' => $tempsTrous,
        ]);

        $pdfFile = new Html2Pdf('L', 'A4', 'fr');
        $pdfFile->writeHTML($template);
        $pdfFile->output("compet.pdf");
    }
}
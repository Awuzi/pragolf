<?php

namespace App\Controller;

use App\Services\ExcelExtract;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $fichierJoueurs = ExcelExtract::ExceltoPhp('../public/assets/doc/Fichier.xlsx');
        $tableauJoueurs = ExcelExtract::phpToJson($fichierJoueurs);

        return $this->render('index/index.html.twig', [
            'joueurs' => $tableauJoueurs,
        ]);
    }
}
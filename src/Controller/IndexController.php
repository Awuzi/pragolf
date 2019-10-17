<?php

namespace App\Controller;

use \App\Services\MyReadFilter;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $tableauJoueurs = MyReadFilter::uploadExcelFile();
        return $this->render('index/index.html.twig', [
            'joueur' => $tableauJoueurs,
            'controller_name' => 'IndexController',
        ]);
    }

}

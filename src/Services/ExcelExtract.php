<?php

namespace App\Services;


use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

class ExcelExtract implements IReadFilter
{

    public static function ExceltoPhp($excelFile)
    {
        $reader = new Xlsx();
        $reader->setReadFilter(new ExcelExtract()); //remplace ExcelExtract par le nom de ta classe
        $reader->setReadDataOnly(true);

        $spreadsheet = $reader->load($excelFile);
        $workSheet = $spreadsheet->getActiveSheet();

        $nomCompet = $workSheet->getCell('B10')->getValue(); // Récupère le nom de la compétition
        $nbJoueurs = $workSheet->getCell('B166')->getValue(); // Récupèe le nombre de joueurs
        $dateCompetition = $workSheet->getCell('E63')->getValue(); // Récupère la date de la compétition
        $infoCompetition = [$nomCompet, $nbJoueurs, $dateCompetition];
        for ($i = 1; $i < 175; $i++) {
            $nom = $workSheet->getCell('B'.$i)->getValue();
            $couleur = $workSheet->getCell('I'.$i)->getValue();
            if ($nom !== null && $couleur !== null && $couleur !== "Rep.") {
                $joueurs[$couleur][] = $nom;
            }
        }

        foreach ($joueurs as $couleur => $joueur) { // Tri de joueurs; créations des parties
            $joueursRestant = count($joueur);
            unset($joueursGroup3);

            foreach ($joueur as $nom) {

                $joueursGroup3[] = $nom;

                if (($joueursRestant == 4 or $joueursRestant == 2) && (count($joueursGroup3) == 2)) {
                    $parties[] = array($couleur, $joueursGroup3);
                    $joueursRestant -= 2;
                    unset($joueursGroup3);

                } elseif ($joueursRestant == 3 && (count($joueursGroup3) == 3)) {
                    $parties[] = array($couleur, $joueursGroup3);
                    $joueursRestant -= 3;
                    unset($joueursGroup3);

                } elseif ($joueursRestant > 4 && (count($joueursGroup3) > 2)) {
                    $parties[] = array($couleur, $joueursGroup3);
                    $joueursRestant -= 3;
                    unset($joueursGroup3);
                }
            }
        }
        array_push($parties, $infoCompetition);


        return self::phpToJson($parties);
    }


    public static function phpToJson($file)
    {

        $newFile = new Filesystem();
        $path = "../public/assets/doc/partie.json";
        $newFile->touch($path); //creation du fichier partie.json
        //creation du fichier json et ecriture des infos
        $filename = '../public/assets/doc/partie.json';
        $newJsonFile = new File($filename);
        $newJsonFile->openFile('w+')->fwrite(json_encode($file, JSON_UNESCAPED_UNICODE));
        //recuperation du fichier pour extraction en tableau php
        $file = file_get_contents('../public/assets/doc/partie.json');
        $jsonfile = json_decode($file);

        return $jsonfile;
    }

    public function readCell($column, $row, $worksheetName = '')
    {
        // Read title row and rows 9 - 175
        return ($row > 9 && $row < 175) ? true : false;
    }
}

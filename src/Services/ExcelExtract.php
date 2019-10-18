<?php

namespace App\Services;


use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
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
        $dateCompet = $workSheet->getCell('E63')->getValue(); // Récupère la date de la compétition

        for ($i = 1; $i < 175; $i++) {
            $nom = $workSheet->getCell('B'.$i)->getValue();
            $couleur = $workSheet->getCell('I'.$i)->getValue();
            if ($nom !== null && $couleur !== null && $couleur !== "Rep.") {
                $joueurs[$couleur][] = $nom;
            }
        }

        foreach ($joueurs as $couleur => $joueur) { // Tri de joueurs; créations des parties

            $nbJoueursCouleur = count($joueur);
            $addJoueurs = false;
            unset($joueurToAdd);

            foreach ($joueur as $nom) {
                $joueurToAdd[] = $nom;

                if (($nbJoueursCouleur == 4 or $nbJoueursCouleur == 2) && (count($joueurToAdd) == 2)) {

                    $parties[] = array($couleur, $joueurToAdd);
                    $nbJoueursCouleur = $nbJoueursCouleur - 2;
                    unset($joueurToAdd);
                } elseif ($nbJoueursCouleur == 3 && (count($joueurToAdd) == 3)) {

                    $parties[] = array($couleur, $joueurToAdd);
                    $nbJoueursCouleur = $nbJoueursCouleur - 3;
                    unset($joueurToAdd);
                } elseif ($nbJoueursCouleur > 4 && (count($joueurToAdd) > 2)) {

                    $parties[] = array($couleur, $joueurToAdd);
                    $nbJoueursCouleur = $nbJoueursCouleur - 3;
                    unset($joueurToAdd);
                }
            }
        }
        array_push($parties, $nomCompet, $dateCompet, $nbJoueurs);

        return self::phpToJson($parties);
    }


    public static function phpToJson($file)
    {
        //creation du fichier json et ecriture des infos
        $filename = '../public/assets/doc/partie.json';
        $f = new File($filename);
        $f->openFile('w+')->fwrite(json_encode($file, JSON_UNESCAPED_UNICODE));
        //recuperation du fichier pour extraction en tableau php
        $file = file_get_contents('../public/assets/doc/partie.json');
        $jsonfile = json_decode($file);

        return $jsonfile;
    }

    public function readCell($column, $row, $worksheetName = '')
    {
        // Read title row and rows 20 - 30
        return ($row > 9 && $row < 175) ? true : false;
    }
}

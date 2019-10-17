<?php

namespace App\Services;


use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class MyReadFilter implements IReadFilter
{
    public static function uploadExcelFile()
    {
        $reader = new Xlsx();
        $reader->setReadFilter(new MyReadFilter());
        $file = "export_liste_des_departs.xlsx";
        $spreadsheet = $reader->load($file);

        $workSheet = $spreadsheet->getActiveSheet();

        $joueurs = [];
        $colonneNoms = $workSheet->getCell('B10')->getValue(); // Récupère le nom de la compétition
        $nbJoueurs = $workSheet->getCell('B166')->getValue(); // Récupèe le nombre de joueurs
        $dateCompet = $workSheet->getCell('E63')->getValue(); // Récupère la date de la compétition

        echo $colonneNoms." Nb joueurs : ".$nbJoueurs." Date Compet : ".$dateCompet;

        for ($i = 12; $i <= 170; ++$i) {
            $colonneNoms = $workSheet->getCell('B'.$i)->getValue();
            if (!empty($colonneNoms) &&
                ($colonneNoms != "Nom et Prénom") &&
                ($colonneNoms != "TROPHEE SENIORS DU COUDRAY") &&
                ($colonneNoms != "Liste des inscrits") &&
                ($colonneNoms != "Page 1 / 3") &&
                ($colonneNoms != "Page 2 / 3") &&
                ($colonneNoms != "Page 3 / 3"))
            {
                echo $colonneNoms."<br> ";
                $joueurs[$i] = $colonneNoms;
                array_splice($joueurs, 0);
            }
        }

        return $joueurs;
    }

    public function readCell($column, $row, $worksheetName = '')
    {
        // Read title row and rows 20 - 30
        if ($row > 0 && $row < 200) {
            return true;
        }

        return false;
    }

}
<?php

namespace App\Services;


use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class ExcelExtract implements IReadFilter
{

    /**
     * @param $excelFile
     * @return array
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public static function ExceltoPhp($excelFile)
    {
        $reader = new Xlsx();
        $reader->setReadFilter(new ExcelExtract()); //remplace ExcelExtract par le nom de ta classe
        $reader->setReadDataOnly(true);

        $spreadsheet = $reader->load($excelFile);
        $workSheet = $spreadsheet->getActiveSheet();

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



        return self::phpToJson($parties); //return json tab
    }


    /**
     * @param $file
     * @return array
     */
    public static function phpToJson($file)
    {
        /*$newFile = new Filesystem();
        $path = "../public/assets/doc/partie.json";
        $newFile->touch($path); //creation du fichier partie.json
        //creation du fichier json et ecriture des infos
        $filename = '../public/assets/doc/partie.json';
        $newJsonFile = new File($filename);
        $newJsonFile
            ->openFile('w+')
            ->fwrite(json_encode($file, JSON_UNESCAPED_UNICODE));*/
        $f = json_encode($file);
        return json_decode($f);
    }

    /**
     * @param string $column
     * @param int $row
     * @param string $worksheetName
     * @return bool
     */
    public function readCell($column, $row, $worksheetName = '')
    {
        return ($row > 9 && $row < 175) ? true : false;
    }
}

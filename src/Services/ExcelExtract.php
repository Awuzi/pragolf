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
    public function ExceltoPhp($excelFile): array
    {
        $reader = new Xlsx();
        $reader->setReadFilter(new self()); //remplace ExcelExtract par le nom de ta classe
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

                /** @var array $joueursRestant */
                if ((4 == $joueursRestant || 2 == $joueursRestant) && (count($joueursGroup3) == 2)) {
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

        /** @var array $parties */
        return $this->phpToJson($parties);
    }


    /**
     * @param $file
     * @return array
     */
    public function phpToJson($file): array
    {
        return json_decode(json_encode($file));
    }

    /**
     * @param string $column
     * @param int $row
     * @param string $worksheetName
     * @return bool
     */
    public function readCell($column, $row, $worksheetName = ''): bool
    {
        return ($row > 9 && $row < 175);
    }
}

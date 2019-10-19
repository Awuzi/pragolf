<?php

namespace App\Tests;

use App\Services\ExcelExtract;
use PHPUnit\Framework\TestCase;

class ExcelExtractTest extends TestCase
{

    public function testExceltoPhp()
    {
        $e = new ExcelExtract();
        $fichier = '../public/assets/doc/Fichier.xlsx';
        $attendu = '117 joueurs';
        try {
            $this->assertContains($attendu, $e::ExceltoPhp($fichier));
        } catch (\Exception $e) {
            $e->getMessage();
        }

    }

}

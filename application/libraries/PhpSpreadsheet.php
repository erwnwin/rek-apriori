<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Include all required classes for PhpSpreadsheet
require_once APPPATH . 'third_party/PhpSpreadsheet/src/PhpSpreadsheet/Spreadsheet.php';
require_once APPPATH . 'third_party/PhpSpreadsheet/src/PhpSpreadsheet/Writer/Xlsx.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PhpSpreadsheet
{
    public function createSpreadsheet()
    {
        return new Spreadsheet();
    }

    public function createWriter($spreadsheet, $format = 'Xlsx')
    {
        $writerClass = 'PhpOffice\\PhpSpreadsheet\\Writer\\' . $format;
        return new $writerClass($spreadsheet);
    }
}

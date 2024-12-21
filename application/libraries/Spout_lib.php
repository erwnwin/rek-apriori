<?php

require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class Spout_lib
{
    public function readExcel($filePath)
    {
        $reader = ReaderEntityFactory::createXLSXReader();
        $reader->open($filePath);

        $data = [];
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                $data[] = $row->toArray(); // Mengambil data sebagai array
            }
        }

        $reader->close();
        return $data;
    }

    public function writeExcel($filePath, $data)
    {
        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToFile($filePath);

        foreach ($data as $row) {
            $rowFromValues = WriterEntityFactory::createRowFromArray($row);
            $writer->addRow($rowFromValues);
        }

        $writer->close();
    }
}

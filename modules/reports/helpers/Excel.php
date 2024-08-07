<?php

namespace app\modules\reports\helpers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Excel
{
    public static function makeReportOrders($orders) {

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()
            ->setCreator('MT_GROUP')
            ->setLastModifiedBy('MT_GROUP')
            ->setTitle('Отчет по отправленным заказам')
            ->setSubject('Отчет по отправленным заказам')
            ->setDescription('Отчет по отправленным заказам.');

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Отчет по заказам');
        $sheet->getColumnDimension('A')->setWidth('15');
        $sheet->getColumnDimension('B')->setWidth('40');
        $sheet->getColumnDimension('C')->setWidth('40');
        $sheet->getColumnDimension('D')->setWidth('15');

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ]
        ];
        $styleAlligments = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ]
        ];

        $sheet->setCellValue('A1', 'Отчет по отправленным заказам')->getStyle('A3')->applyFromArray($styleArray);
        $sheet->setCellValue('A3', 'Номер заказа')->getStyle('A3')->applyFromArray($styleArray);
        $sheet->setCellValue('B3', 'Заказчик')->getStyle('B3')->applyFromArray($styleArray);
        $sheet->setCellValue('C3', 'Препарат')->getStyle('C3')->applyFromArray($styleArray);
        $sheet->setCellValue('D3', 'Количество')->getStyle('D3')->applyFromArray($styleArray);
        $sheet->mergeCells('A1:D1')->getStyle('A1')->applyFromArray($styleAlligments);

        $line = 4;
        foreach ($orders as $key => $order) {
            $count = count($order);
            $sheet->mergeCells('A' . $line . ':A' . ($line + $count - 1));
            $sheet->setCellValue ('A' . $line, $key)->getStyle('A' . $line)->applyFromArray($styleArray);
            $sheet->mergeCells('B' . $line . ':B' . ($line + $count - 1));
            $sheet->getStyle('A' . ($line + $count - 1))->applyFromArray($styleArray);
            $sheet->getStyle('B' . ($line + $count - 1))->applyFromArray($styleArray);
            $sheet->getStyle('B' . $line)->applyFromArray($styleArray);

            foreach ($order as $key_drug => $item) {
                $sheet->setCellValue ('B' . $line, $item->userSend->family . ' ' . $item->userSend->name . ' ' . $item->userSend->surname)
                    ->getStyle('A' . $line)->applyFromArray($styleArray);
                $sheet->setCellValueExplicit ('C' . $line + $key_drug,
                    $item->drug->trade_name, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING)
                    ->getStyle('C' . $line + $key_drug)->getAlignment()->setWrapText(true);
                $sheet->getStyle('C' . $line + $key_drug)->applyFromArray($styleArray);
                $sheet->setCellValue ('D' . $line + $key_drug, 1)
                    ->getStyle('D' . $line + $key_drug)->applyFromArray($styleArray); //todo группировку
            }
        }

        $oWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment;filename=\"filename.xlsx\"");
        header("Cache-Control: max-age=0");

        $oWriter->save('php://output');
    }
}
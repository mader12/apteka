<?php

namespace app\modules\reports\helpers;

class Word
{

    public static function makeReportCount($drugs_up) {

        $languageEnGb = new \PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::RU_RU);
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->getSettings()->setThemeFontLang($languageEnGb);

        $fontStyleName = 'rStyle';
        $phpWord->addFontStyle($fontStyleName, ['bold' => true, 'size' => 16, 'allCaps' => true, 'doubleStrikethrough' => true]);

        $paragraphStyleName = 'pStyle';
        $phpWord->addParagraphStyle($paragraphStyleName, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100]);
        $phpWord->addTitleStyle(1, ['bold' => true], ['spaceAfter' => 240]);
        // New portrait section
        $section = $phpWord->addSection();

        $cursor = 1;
        foreach ($drugs_up as $drug_up) {
            $section->addTitle($cursor . '. ' . current(current(current($drug_up)))->drug->trade_name, 1);
//            $section->addText('Hello World!');

            foreach ($drug_up as $form) {
                foreach ($form as $dosage) {
                    foreach ($dosage as $drug_sku) {
                        $section->addText('Аптека - ' . $drug_sku->pharma->name);
                        $section->addText('Остаток - ' . $drug_sku->count);
                        $section->addTextBreak(1);

                    }
                }
            }
            $cursor++;
        }

        $section->addTextBreak();

        $file = 'reportDrugsPharma.docx';
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $xmlWriter->save("php://output");

    }

    public static function makeReportCountParagraf($drugs_up) {

        $languageEnGb = new \PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::RU_RU);
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->getSettings()->setThemeFontLang($languageEnGb);

        $fontStyleName = 'rStyle';
        $phpWord->addFontStyle($fontStyleName, ['bold' => true, 'size' => 16, 'allCaps' => true, 'doubleStrikethrough' => true]);

        $paragraphStyleName = 'pStyle';
        $phpWord->addParagraphStyle($paragraphStyleName, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100]);
        $phpWord->addTitleStyle(1, ['bold' => true], ['spaceAfter' => 240]);
        // New portrait section
        $section = $phpWord->addSection();

        $cursor = 1;
        foreach ($drugs_up as $drug_up) {
            $current = current(current(current($drug_up)));
            $name = $current->drug->trade_name . ', ';
            $name .= $current->form->name . ', ';
            $name .= $current->dosage->count;
            $name .= $current->dosage->name . ', ';

            $section->addTitle($cursor . '. ' . $name, 1);

            foreach ($drug_up as $form) {
                foreach ($form as $dosage) {
                    foreach ($dosage as $drug_sku) {
                        $list_item = $drug_sku->pharma->name . ', ' . $drug_sku->pharma->city . ', '
                            . $drug_sku->pharma->street . ', д.' . $drug_sku->pharma->home . ' - ' . $drug_sku->count . 'шт.';
                        $section->addListItem($list_item, 0);
                        $section->addTextBreak(1);

                    }
                }
            }
            $cursor++;
        }

        $section->addTextBreak();

        $file = 'reportDrugsPharmaParagraf.docx';
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $xmlWriter->save("php://output");

    }

}
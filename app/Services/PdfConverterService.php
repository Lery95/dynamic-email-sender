<?php

namespace App\Services;

class PdfConverterService
{
    public function convert(string $pptxFile): string
    {
        $outputDir =
            storage_path(
                'app/certificates/pdf'
            );

        exec(
            '"C:\Program Files\LibreOffice\program\soffice.exe" --headless --convert-to pdf ' .
            escapeshellarg($pptxFile) .
            ' --outdir ' .
            escapeshellarg($outputDir)
        );

        $filename =
            pathinfo(
                $pptxFile,
                PATHINFO_FILENAME
            );

        return $outputDir . '/' . $filename . '.pdf';
    }
}
<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Queue\SerializesModels;
// use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

use App\Mail\CertificateMail;
use App\Services\ExcelReaderService;
use App\Services\CertificateGeneratorService;
use App\Services\PdfConverterService;

class ProcessCertificateJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    private string $bcc = 'lerryson@plixstar.com'; //set bcc email

    public function __construct(
        public string $excelFile,
        public string $pptxTemplate
    ) {
    }

    public function handle(
        ExcelReaderService $excel,
        CertificateGeneratorService $generator,
        PdfConverterService $pdf

    ) {
        $recipients = $excel->getRecipients($this->excelFile);

        logger()->info('Recipients loaded: ' . count($recipients));

        $pptxFile = Storage::disk('local')->path($this->pptxTemplate);

        foreach ($recipients as $recipient) {

            try {

                $pptx = $generator->generate(
                    $recipient->name,
                    $pptxFile
                );

                $pdfFile = $pdf->convert($pptx);

                if (!file_exists($pdfFile)) {
                    logger()->error("Missing PDF: $pdfFile");
                    continue;
                }

                Mail::to($recipient->email)
                    ->bcc($this->bcc)
                    ->send(
                        new CertificateMail(
                            $recipient->name,
                            $pdfFile
                        )
                    );

                logger()->info("Sent: {$recipient->email}");

            } catch (\Throwable $e) {
                logger()->error($e->getMessage());
            }
        }
    }
}
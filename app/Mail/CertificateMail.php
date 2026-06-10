<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class CertificateMail extends Mailable
{
    public function __construct(
        public string $name,
        public string $pdfFile
    ) {
    }

    public function build()
    {
        return $this->subject('Thank You & Certificate of Appreciation 🌟 – TAMSC Discovery Camp 2026')
            ->view('certificate')
            ->attach($this->pdfFile);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessCertificateJob;

class CertificateController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'excel' => 'required|file|mimes:xlsx',
            'pptx' => 'required|file|mimes:ppt,pptx',
        ]);

        $excelPath = $request->file('excel')
            ->store('uploads');

        // $pptxPath = $request->file('pptx')
        //     ->store('uploads');

        $pptxPath = $request->file('pptx')->store('uploads', 'local');

        // ProcessCertificateJob::dispatch(
        //     storage_path("app/$excelPath"),
        //     storage_path("app/$pptxPath")
        // );

        ProcessCertificateJob::dispatch($excelPath, $pptxPath);

        return back()->with(
            'success',
            'Processing started. Emails will be sent shortly.'
        );
    }
}
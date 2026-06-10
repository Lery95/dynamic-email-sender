<?php

namespace App\Services;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

class ExcelReaderService
{
    public function getRecipients($file)
    {
        $rows = Excel::toArray(null, $file)[0];

        $recipients = [];

        foreach (array_slice($rows, 1) as $row) {
            $recipients[] = (object)[
                'name' => $row[0],
                'email' => $row[1],
            ];
        }

        return $recipients;
    }
}
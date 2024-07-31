<?php

namespace App\Http\Controllers;

use App;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DownloadPdfController extends Controller
{
    public function incidentReport($id)
    {
        // $record = Pengajuan::find($id);
        // dd($record);
        $record = DB::table('pengajuans')
            ->join('divisis', 'pengajuans.divisi_id', '=', 'divisis.id')
            ->join('banks', 'pengajuans.bank_id', '=', 'banks.id')
            ->select('pengajuans.*', 'divisis.nama  as nama_divisi' , 'banks.nama_bank')
            ->where('pengajuans.id', $id)
            ->first();
        // dd($record);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.report_pdf', compact('record')); // Pass the variable $record to the blade file
        return $pdf->stream(); // renders the PDF in the browser
    }
}

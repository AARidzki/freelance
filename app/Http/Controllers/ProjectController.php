<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProjectController extends Controller
{
    // public function cetak()
    // {
    // 	$project = Project::all();
 
    // 	$pdf = app('dompdf.wrapper')->loadView('cetakproject', ['projects' => $project]);
    //     // return $pdf->stream('laporan-project-pdf');
    // 	return $pdf->download('laporan-project.pdf');
    // }
}

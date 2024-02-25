<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Svg\Converter;
use Spatie\Browsershot\Browsershot;
use setasign\Fpdi\Fpdi;
use Dompdf\Dompdf;
use Imagick;
use TCPDF;
use FPDF;
use View;
use DB;
use File;
use Auth;

class QrCodeController extends Controller
{
    public function index()
    {
      $qrCodeName = uniqid();
      $qrCodeSvgPath = public_path("uploads/certificate/{$qrCodeName}.png");
      QrCode::format('png')->size(50)->generate($qrCodeName, $qrCodeSvgPath);

      $existingPdfPath = public_path("uploads/certificate/CertificateFormat.pdf");

      $pdf = new Fpdi();
      $pageCount = $pdf->setSourceFile($existingPdfPath);

      for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
          $pdf->AddPage();

          $templateId = $pdf->importPage($pageNumber);
          $pdf->useTemplate($templateId);
     
          $pdf->SetFont('Arial', '', 12);
          $pdf->SetXY(10, 80); 
          $pdf->MultiCell(0, 10, ' This is to certify that the manuscript entitled ', 0, 'C');

          $pdf->SetFont('Arial', 'B', 12);
          $pdf->SetXY(10, 90); 
          $pdf->MultiCell(0, 10, ' "The Study on the Effectiveness of Coconut (Cocos nucifera) Shell
          Powder as a Full Substitute in Wood Component of Wood-Plastic
          Composite (WPC) Board"
          ', 0, 'C');

          $pdf->SetFont('Arial', '', 12);
          $pdf->SetXY(10, 130); 
          $pdf->MultiCell(0, 10, ' authored by ', 0, 'C');

          $pdf->SetFont('Arial', 'B', 12);
          $pdf->SetXY(10, 140); 
          $pdf->MultiCell(0, 10, ' Balbada, Joseph Andre B. ', 0, 'C');
          $pdf->SetXY(10, 145); 
          $pdf->MultiCell(0, 10, ' Dejan Ron Michael E. ', 0, 'C');
          $pdf->SetXY(10, 150); 
          $pdf->MultiCell(0, 10, ' Pedrozo, Aimer Jay G. ', 0, 'C');

          $pdf->SetFont('Arial', '', 12);
          $pdf->SetXY(10, 160); 
          $pdf->MultiCell(0, 5, ' has been subjected to similarity check on February 25, 2024
          using Turnitin with generated similarity index of 15% ', 0, 'C');
          $pdf->SetXY(10, 180); 
          $pdf->MultiCell(0, 10, ' Processed by: ', 0, 'C');

          $pdf->SetFont('Arial', 'B', 12);
          $pdf->SetXY(10, 190); 
          $pdf->MultiCell(0, 10, ' Rico S. Santos, DIT ', 0, 'C');

          $pdf->SetFont('Arial', 'I', 12);
          $pdf->SetXY(10, 195); 
          $pdf->MultiCell(0, 10, ' Head of Research & Development Services ', 0, 'C');

          $pdf->SetFont('Arial', '', 12);
          $pdf->SetXY(10, 210); 
          $pdf->MultiCell(0, 10, ' Certified Correct by: ', 0, 'C');

          $pdf->SetFont('Arial', 'B', 12);
          $pdf->SetXY(10, 220); 
          $pdf->MultiCell(0, 10, ' Laarnie D. Macapagal, DMS ', 0, 'C');

          $pdf->SetFont('Arial', 'I', 12);
          $pdf->SetXY(10, 225); 
          $pdf->MultiCell(0, 10, ' Assistant Director of Research & Extension Services ', 0, 'C');

          $pdf->Image($qrCodeSvgPath, 18, 53, 25, 0, 'PNG');
        
      }

      $pdf->Output('F', public_path("uploads/certificate/{$qrCodeName}.pdf"));

      return response()->json(['message' => 'PDF saved successfully']);
    }

}

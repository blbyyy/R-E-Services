<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Research;
use App\Models\RequestingForm;
use DB, File, Auth, View;

class PdfController extends Controller
{
    public function userCountTable()
    {
        $rolesCount = DB::table('users')
        ->select('role', DB::raw('count(*) as count'))
        ->groupBy('role')
        ->get();

        $users = DB::table('users')->orderBy('id')->get();

        $html = view('reports.userCount', compact('rolesCount','users'))->render();

        $pdf = PDF::loadHTML($html);

        $pdf->save(public_path('uploads/reports/userCountTable.pdf'));

        return response()->download(public_path('uploads/reports/userCountTable.pdf'));
    }

    public function applicationsCountTable()
    {
        $applicationsCount = DB::table('requestingform')
        ->select('status', DB::raw('count(*) as count'))
        ->groupBy('status')
        ->get();

        $applications = DB::table('requestingform')->orderBy('id')->get();

        $html = view('reports.applicationsCount', compact('applicationsCount','applications'))->render();

        $pdf = PDF::loadHTML($html);

        $pdf->save(public_path('uploads/reports/applicationsCountTable.pdf'));

        return response()->download(public_path('uploads/reports/applicationsCountTable.pdf'));
    }

}

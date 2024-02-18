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

    public function thesisTypeCountTable()
    {
        $thesisTypeCount = DB::table('requestingform')
        ->select('thesis_type', DB::raw('count(*) as count'))
        ->groupBy('thesis_type')
        ->get();

        $applications = DB::table('requestingform')->orderBy('id')->get();

        $html = view('reports.thesisTypeApplicationsCount', compact('thesisTypeCount','applications'))->render();

        $pdf = PDF::loadHTML($html);

        $pdf->save(public_path('uploads/reports/thesisTypeApplicationsCountTable.pdf'));

        return response()->download(public_path('uploads/reports/thesisTypeApplicationsCountTable.pdf'));
    }

    public function courseCountTable()
    {
        $courseCount = DB::table('requestingform')
        ->select('course', DB::raw('count(*) as count'))
        ->groupBy('course')
        ->get();

        $applications = DB::table('requestingform')->orderBy('id')->get();

        $html = view('reports.courseApplicationsCount', compact('courseCount','applications'))->render();

        $pdf = PDF::loadHTML($html);

        $pdf->save(public_path('uploads/reports/courseApplicationsCountTable.pdf'));

        return response()->download(public_path('uploads/reports/courseApplicationsCountTable.pdf'));
    }

    public function departmentCountTable()
    {
        $researchDepartmentCount = DB::table('research_list')
        ->select('department', DB::raw('count(*) as count'))
        ->groupBy('department')
        ->get();

        $research = DB::table('research_list')->orderBy('id')->get();

        $html = view('reports.researchesDepartmentApplicationsCount', compact('researchDepartmentCount','research'))->render();

        $pdf = PDF::loadHTML($html);

        $pdf->save(public_path('uploads/reports/researchesDepartmentApplicationsCountTable.pdf'));

        return response()->download(public_path('uploads/reports/researchesDepartmentApplicationsCountTable.pdf'));
    }

    public function researchesCourseCountTable()
    {
        $researchCourseCount = DB::table('research_list')
        ->select('course', DB::raw('count(*) as count'))
        ->groupBy('course')
        ->get();

        $research = DB::table('research_list')->orderBy('id')->get();

        $html = view('reports.researchesCourseApplicationsCount', compact('researchCourseCount','research'))->render();

        $pdf = PDF::loadHTML($html);

        $pdf->save(public_path('uploads/reports/researchesCourseApplicationsCountTable.pdf'));

        return response()->download(public_path('uploads/reports/researchesCourseApplicationsCountTable.pdf'));
    }
}

<?php

namespace App\Http\Controllers;

use Algolia\AlgoliaSearch\SearchClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Research;
use App\Models\RequestingForm;
use DB, File, Auth, View;

class PdfController extends Controller
{
    public function printableData()
    {
        $adminNotifCount = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->where('status', 'not read')
            ->count();

        $adminNotification = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->orderBy('date', 'desc')
            ->take(4)
            ->get();

        $admin = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

        return View::make('reports.printableData',compact('admin','adminNotification','adminNotifCount'));
    }

    public function userCountTable()
    {
        $rolesCount = DB::table('users')
        ->select('role', DB::raw('count(*) as count'))
        ->groupBy('role')
        ->get();

        $users = DB::table('users')->orderBy('id')->get();

        $html = view('reports.userCount', compact('rolesCount','users'))->render();

        $pdf = PDF::loadHTML($html);

        Storage::put('reports/userCountTable.pdf', $pdf->output());
        $pdfPath = Storage::path('reports/userCountTable.pdf');

        return response()->download($pdfPath);
    }

    public function studentCountTable()
    {
        $studentCount = DB::table('users')
            ->select(DB::raw('count(*) as count'))
            ->where('role', 'Student')
            ->first();

        $users = DB::table('users')
            ->where('role', 'Student')
            ->orderBy('id')
            ->get();

        $html = view('reports.studentCount', compact('studentCount','users'))->render();

        $pdf = PDF::loadHTML($html);

        Storage::put('reports/studentCountTable.pdf', $pdf->output());
        $pdfPath = Storage::path('reports/studentCountTable.pdf');

        return response()->download($pdfPath);
    }

    public function facultyCountTable()
    {
        $facultyCount = DB::table('users')
            ->select(DB::raw('count(*) as count'))
            ->where('role', 'Faculty')
            ->first();

        $users = DB::table('users')
            ->where('role', 'Faculty')
            ->orderBy('id')
            ->get();

        $html = view('reports.facultyCount', compact('facultyCount','users'))->render();

        $pdf = PDF::loadHTML($html);

        Storage::put('reports/facultyCountTable.pdf', $pdf->output());
        $pdfPath = Storage::path('reports/facultyCountTable.pdf');

        return response()->download($pdfPath);
    }

    public function researchCoordinatorCountTable()
    {
        $researchCoordinatorCount = DB::table('users')
            ->select(DB::raw('count(*) as count'))
            ->where('role', 'Research Coordinator')
            ->first();

        $users = DB::table('users')
            ->where('role', 'Research Coordinator')
            ->orderBy('id')
            ->get();

        $html = view('reports.researchCoordinatorCount', compact('researchCoordinatorCount','users'))->render();

        $pdf = PDF::loadHTML($html);

        Storage::put('reports/researchCoordinatorCount.pdf', $pdf->output());
        $pdfPath = Storage::path('reports/researchCoordinatorCount.pdf');

        return response()->download($pdfPath);
    }

    public function staffAdminCountTable()
    {
        $staffAdminCount = DB::table('users')
            ->select('role', DB::raw('count(*) as count'))
            ->whereIn('role', ['Staff', 'Admin'])
            ->groupBy('role')
            ->get();

        $users = DB::table('users')
            ->whereIn('role', ['Staff', 'Admin'])
            ->get();

        $html = view('reports.staffAdminCount', compact('staffAdminCount','users'))->render();

        $pdf = PDF::loadHTML($html);

        Storage::put('reports/staffAdminCount.pdf', $pdf->output());
        $pdfPath = Storage::path('reports/staffAdminCount.pdf');

        return response()->download($pdfPath);
    }

    public function applicationsCountTable()
    {
        $applicationsCount = DB::table('requestingform')
        ->select('status', DB::raw('count(*) as count'))
        ->groupBy('status')
        ->get();

        $applications = DB::table('requestingform')
        ->join('files', 'files.id','requestingform.research_id')
        ->orderBy('requestingform.id')
        ->get();

        $html = view('reports.applicationsCount', compact('applicationsCount','applications'))->render();

        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape');

        Storage::put('reports/applicationsCountTable.pdf', $pdf->output());
        $pdfPath = Storage::path('reports/applicationsCountTable.pdf');

        return response()->download($pdfPath);
    }

    public function thesisTypeCountTable(Request $request)
    {
        $applications = DB::table('requestingform')
        ->join('files', 'files.id', '=', 'requestingform.research_id')
        ->select('requestingform.*', 'files.*')
        ->where('requestingform.thesis_type', 'like', '%' . $request->thesis_type . '%')
        ->orderBy('requestingform.id')
        ->get();

        $html = view('reports.thesisTypeApplicationsCount', compact('applications'))->render();

        $pdf = PDF::loadHTML($html);

        Storage::put('reports/thesisTypeApplicationsCountTable.pdf', $pdf->output());
        $pdfPath = Storage::path('reports/thesisTypeApplicationsCountTable.pdf');

        return response()->download($pdfPath);
    }

    public function requestorTypeCountTable(Request $request)
    {
        $applications = DB::table('requestingform')
        ->join('files', 'files.id', '=', 'requestingform.research_id')
        ->select('requestingform.*', 'files.*')
        ->where('requestingform.requestor_type', 'like', '%' . $request->requestor_type . '%')
        ->orderBy('requestingform.id')
        ->get();

        $html = view('reports.requestorTypeApplicationsCount', compact('applications'))->render();

        $pdf = PDF::loadHTML($html);

        Storage::put('reports/requestorTypeApplicationsCountTable.pdf', $pdf->output());
        $pdfPath = Storage::path('reports/requestorTypeApplicationsCountTable.pdf');

        return response()->download($pdfPath);
    }

    public function statusTypeCountTable(Request $request)
    {
        $applications = DB::table('requestingform')
        ->join('files', 'files.id', '=', 'requestingform.research_id')
        ->select('requestingform.*', 'files.*')
        ->where('requestingform.status', 'like', '%' . $request->status . '%')
        ->orderBy('requestingform.id')
        ->get();

        $html = view('reports.statusTypeApplicationsCount', compact('applications'))->render();

        $pdf = PDF::loadHTML($html);

        Storage::put('reports/statusTypeApplicationsCountTable.pdf', $pdf->output());
        $pdfPath = Storage::path('reports/statusTypeApplicationsCountTable.pdf');

        return response()->download($pdfPath);
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

        Storage::put('reports/courseApplicationsCountTable.pdf', $pdf->output());
        $pdfPath = Storage::path('reports/courseApplicationsCountTable.pdf');

        return response()->download($pdfPath);
    }

    public function researchesCountTable()
    {
        $researches = DB::table('research_list')->orderBy('id')->get();

        $html = view('reports.researchesCount', compact('researches'))->render();

        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape');

        Storage::put('reports/researchesCountTable.pdf', $pdf->output());
        $pdfPath = Storage::path('reports/researchesCountTable.pdf');

        return response()->download($pdfPath);
    }

    public function departmentCountTable()
    {
        $researchDepartmentCount = DB::table('research_list')
        ->select('department', DB::raw('count(*) as count'))
        ->groupBy('department')
        ->get();

        $research = DB::table('research_list')->orderBy('id')->get();

        $html = view('reports.researchesDepartmentApplicationsCount', compact('researchDepartmentCount','research'))->render();

        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape');

        Storage::put('reports/researchesDepartmentApplicationsCountTable.pdf', $pdf->output());
        $pdfPath = Storage::path('reports/researchesDepartmentApplicationsCountTable.pdf');

        return response()->download($pdfPath);
    }

    public function researchesCourseCountTable()
    {
        $researchCourseCount = DB::table('research_list')
        ->select('course', DB::raw('count(*) as count'))
        ->groupBy('course')
        ->get();

        $research = DB::table('research_list')->orderBy('id')->get();

        $html = view('reports.researchesCourseApplicationsCount', compact('researchCourseCount','research'))->render();

        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape');

        Storage::put('reports/researchesCourseApplicationsCountTable.pdf', $pdf->output());
        $pdfPath = Storage::path('reports/researchesCourseApplicationsCountTable.pdf');

        return response()->download($pdfPath);
    }

    public function researchListByDepartmentAndYear(Request $request)
    {
        $research = DB::table('research_list')
            ->where('department', 'like', '%' . $request->department . '%')
            ->where('date_completion', 'like', '%' . $request->year . '%')
            ->get();

        $html = view('reports.researchListByYear', compact('research'))->render();

        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape');

        Storage::put('reports/researchListByYear.pdf', $pdf->output());
        $pdfPath = Storage::path('reports/researchListByYear.pdf');

        return response()->download($pdfPath);
    }

    public function researchListByInputText(Request $request)
    {
        $query = $request->input('query');
        $research = Research::search($query)->get();

        $html = view('reports.researchListByInputText', compact('research'))->render();

        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape');

        Storage::put('reports/researchListByInputText.pdf', $pdf->output());
        $pdfPath = Storage::path('reports/researchListByInputText.pdf');

        return response()->download($pdfPath);
    }
}

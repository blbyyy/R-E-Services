<?php

namespace App\Http\Controllers;

use Algolia\AlgoliaSearch\SearchClient;
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

        $pdf->save(public_path('uploads/reports/userCountTable.pdf'));

        return response()->download(public_path('uploads/reports/userCountTable.pdf'));
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

        $pdf->save(public_path('uploads/reports/studentCountTable.pdf'));

        return response()->download(public_path('uploads/reports/studentCountTable.pdf'));
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

        $pdf->save(public_path('uploads/reports/facultyCountTable.pdf'));

        return response()->download(public_path('uploads/reports/facultyCountTable.pdf'));
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

        $pdf->save(public_path('uploads/reports/researchCoordinatorCount.pdf'));

        return response()->download(public_path('uploads/reports/researchCoordinatorCount.pdf'));
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

        $pdf->save(public_path('uploads/reports/staffAdminCount.pdf'));

        return response()->download(public_path('uploads/reports/staffAdminCount.pdf'));
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

        $pdf->save(public_path('uploads/reports/applicationsCountTable.pdf'));

        return response()->download(public_path('uploads/reports/applicationsCountTable.pdf'));
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

        $pdf->save(public_path('uploads/reports/thesisTypeApplicationsCountTable.pdf'));

        return response()->download(public_path('uploads/reports/thesisTypeApplicationsCountTable.pdf'));
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

        $pdf->save(public_path('uploads/reports/requestorTypeApplicationsCountTable.pdf'));

        return response()->download(public_path('uploads/reports/requestorTypeApplicationsCountTable.pdf'));
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

        $pdf->save(public_path('uploads/reports/statusTypeApplicationsCountTable.pdf'));

        return response()->download(public_path('uploads/reports/statusTypeApplicationsCountTable.pdf'));
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

    public function researchesCountTable()
    {
        $researches = DB::table('research_list')->orderBy('id')->get();

        $html = view('reports.researchesCount', compact('researches'))->render();

        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape');

        $pdf->save(public_path('uploads/reports/researchesCountTable.pdf'));

        return response()->download(public_path('uploads/reports/researchesCountTable.pdf'));
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

        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape');

        $pdf->save(public_path('uploads/reports/researchesCourseApplicationsCountTable.pdf'));

        return response()->download(public_path('uploads/reports/researchesCourseApplicationsCountTable.pdf'));
    }

    public function researchListByDepartmentAndYear(Request $request)
    {
        $research = DB::table('research_list')
            ->where('department', 'like', '%' . $request->department . '%')
            ->where('date_completion', 'like', '%' . $request->year . '%')
            ->get();

        $html = view('reports.researchListByYear', compact('research'))->render();

        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape');

        $pdf->save(public_path('uploads/reports/researchListByYear.pdf'));

        return response()->download(public_path('uploads/reports/researchListByYear.pdf'));
    }

    public function researchListByInputText(Request $request)
    {
        $query = $request->input('query');
        $research = Research::search($query)->get();

        $html = view('reports.researchListByInputText', compact('research'))->render();

        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape');

        $pdf->save(public_path('uploads/reports/researchListByInputText.pdf'));

        return response()->download(public_path('uploads/reports/researchListByInputText.pdf'));
    }
}

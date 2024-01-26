<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use RealRashid\SweetAlert\Facades\Alert;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Department;
use View;
use DB;
use File;
use Auth;

class DepartmentController extends Controller
{
    public function index()
    {
        $admin = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

        $departmentlists = Department::orderBy('id')->get();

        return View::make('department.index',compact('admin','departmentlists'));
    }

    public function add_department(Request $request)
    { 
        $department = new Department;
        $department->department_name = $request->department_name;
        $department->department_code = $request->department_code;
        $department->save();

        return redirect()->to('/admin/departmentlist')->with('success', 'Department successfully created.');

    }

    public function edit_department($id)
    {
        $department = Department::find($id);
        return response()->json($department);
    }

    public function update_department(Request $request, $id)
    {
        $department = Department::find($id);
        $department->department_name = $request->dept_name;
        $department->department_code = $request->dept_code;
        $department->save();

        return response()->json(["department" => $department],201);
    }

    public function delete_department(string $id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        $data = array('success' =>'deleted','code'=>'200');
        return response()->json($data);
    }

    //MOBILE START
    public function mobileindex()
    {
        $admin = DB::table('staff')
        ->join('users', 'users.id', 'staff.user_id')
        ->select('staff.*', 'users.*')
        ->where('user_id', Auth::id())
        ->first();

        $departmentlists = Department::orderBy('id')->get();

        // Prepare data to be returned as JSON
        $data = [
            'admin' => $admin,
            'departmentlists' => $departmentlists,
        ];

        // Return JSON response
        return response()->json($data);
    }

    public function mobileadd_department(Request $request)
    { 
        $department = new Department;
        $department->department_name = $request->department_name;
        $department->department_code = $request->department_code;
        $department->save();

        return response()->json(['message' => 'Department successfully created.']);
    }

    public function mobileedit_department($id)
    {
        $department = Department::find($id);
        return response()->json($department);
    }

    public function mobileupdate_department(Request $request, $id)
    {
        $department = Department::find($id);
        $department->department_name = $request->dept_name;
        $department->department_code = $request->dept_code;
        $department->save();

        return response()->json(["department" => $department], 201);
    }

    public function mobiledelete_department($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        
        return response()->json(['message' => 'Department successfully deleted']);
    }
    //MOBILE END

}

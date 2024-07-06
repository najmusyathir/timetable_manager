<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\User;

class UserController extends Controller
{
    // Teacher/Student Related Details

    public function index()
    {
        if (auth()->user()->user_type == "admin") {
            $users = User::all();

            return view("admin.user", compact("users"));
        } else {
            return view('welcome');
        }
    }

    public function listTeachers()
    {
        $users = User::where('user_type', 'teacher')->get();
        return view("admin.user", compact("users"));

    }
    public function listStudents()
    {
        $users = User::where('user_type', 'student')->get();
        return view("admin.user", compact("users"));

    }

    public function adminDetail($id)
    {
        $user = User::findOrFail($id);
        $courses = Course::all();
        $batches = Batch::all();
        return view('admin.userDetails', compact("user", "courses", "batches"));
    }

    public function userAddPage()
    {
        $courses = Course::all();
        $batches = Batch::all();
        return view('admin.userAdd', compact("courses", "batches"));
    }

    public function userAdd(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->user_type = $request->input('user_type');
        $user->phone_no = $request->input('phone_no');
        $user->batch_id = $request->input('batch_id');
        $user->matric_no = $request->input('matric_no');
        $user->course_id = $request->input('course_id');
        $user->save();

        $courses = Course::all();
        $batches = Batch::all();
        $users = User::all();


        return redirect()->route('admin.index');
    }


    public function userUpdate(Request $request, $id)
    {

        if (!User::findOrFail($id)) {
            return view("dashboard");
        } 

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->user_type = $request->input('user_type');
        $user->phone_no = $request->input('phone_no');
        $user->batch_id = $request->input('batch_id');
        $user->matric_no = $request->input('matric_no');
        $user->course_id = $request->input('course_id');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        $courses = Course::all();
        $batches = Batch::all();
        $users = User::all();


        return redirect()->route('admin.userDetails', ['id' => $user, 'users' => $users, 'courses' => $courses, 'batches' => $batches]);
    }

    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $users = User::all();
        return view('admin.user', compact('users'));

    }


    //User Hadnling

    public function userDetail($id)
    {
        $user = User::findOrFail($id);
        $courses = Course::all();
        $batches = Batch::all();
        return view('user.userDetails', compact("user", "courses", "batches"));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /** @var \App\Models\User */
        $user = Auth::user();

        $teacher = Teacher::all();
        $student = Student::all();

        // dd($user->roles()->first()->name);
        if ($user->hasRole('admin')) {
            return view('admin.home', compact('teacher', 'student'));
        } elseif ($user->hasRole(['walas', 'guru'])) {
            return view('teacher.home', compact('teacher'));
        }
    }
}

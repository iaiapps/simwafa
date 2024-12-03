<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Cluster;
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
        $grade = Grade::all();
        $cluster = Cluster::all();

        if ($user->hasRole('admin')) {
            return view('admin.home', compact('teacher', 'student', 'grade', 'cluster'));
        } elseif ($user->hasRole('guru')) {
            return view('teacher.home', compact('teacher'));
        }
    }

    // cek walas
    public function walas()
    {
        $user_id = Auth::user()->id;
        $teacher = Teacher::where('user_id', $user_id)->where('grade_id', '!=', NULL)->first();
        return $teacher;
    }

    // akses walas
    public function changeAccess()
    {
        $teacher = $this->walas();
        // dd(session('akses'));
        if (isset($teacher)) {
            if (session('akses') == 'Guru') {
                session()->put([
                    'akses' => 'Wali Kelas',
                ]);
                return redirect()->route('home')->with('msg', 'Berhasil Akses sebagai Wali Kelas');
            } elseif (session('akses') == 'Wali Kelas') {
                session()->put([
                    'akses' => 'Guru',
                ]);
                return redirect()->route('home')->with('msg', 'Berhasil akses sebagai Guru');
            }
        } else {
            return redirect()->route('home')->with('msg', 'Anda tidak punya akses Wali Kelas');
        }
    }
}

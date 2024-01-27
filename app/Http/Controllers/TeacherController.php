<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Grade;
use App\Models\Cluster;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $bagian = $request->bagian;

        $users = User::all();
        $grades = Grade::all();
        $clusters = Cluster::all();
        $teachers = Teacher::where('grade_id', '=', null)->orWhere('cluster_id', '=', null)->get();
        return view('admin.teacher.create', compact('users', 'grades', 'teachers', 'clusters', 'bagian'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $teacher_id = $request->teacher_id;
        $grade_id = $request->grade_id;
        $cluster_id = $request->cluster_id;

        // foreach ($teacher_id as $tid) {
        //     Teacher::where('id', '=', $tid)->update([
        //         'grade_id' => $grade_id[$tid],
        //         'cluster_id' => $cluster_id[$tid]
        //     ]);
        // }
        // dd($request->all());
        foreach ($teacher_id as $tid) {
            if (isset($grade_id[$tid])) {
                Teacher::where('id', '=', $tid)->update([
                    'grade_id' => $grade_id[$tid]
                ]);
            } elseif (isset($cluster_id[$tid])) {
                Teacher::where('id', '=', $tid)->update([
                    'cluster_id' => $cluster_id[$tid]
                ]);
            }
        }
        return redirect()->route('teacher.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $grades = Grade::all();
        $clusters = Cluster::all();
        return view('admin.teacher.edit', compact('teacher', 'grades', 'clusters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $teacher->update($request->all());
        return redirect()->route('teacher.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
    }

    // --- handle from guru page --- //
    public function studentCluster()
    {
        $user_id = Auth::user()->id;
        $teacher = Teacher::where('user_id', $user_id)->first();
        // dd($teacher->cluster->id);
        if (isset($teacher->cluster->id)) {
            $cluster_id = $teacher->cluster->id;
            $students = Student::where('cluster_id', $cluster_id)->get();
        } else {
            $students = null;
        }
        return view('teacher.guru.cluster', compact('students'));
    }

    // --- handle from walas page --- //
    public function studentGrade()
    {
        $user_id = Auth::user()->id;
        $teacher = Teacher::where('user_id', $user_id)->first();

        if (isset($teacher->grade->id)) {
            $grade_id = $teacher->grade->id;
            $students = Student::where('grade_id', $grade_id)->get();
        } else {
            $students = null;
        }
        return view('teacher.walas.grade', compact('students', 'teacher'));
    }
}

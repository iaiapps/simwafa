<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Year;
use App\Models\Grade;
use App\Models\Stage;
use App\Models\Cluster;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Komponen;
use App\Models\Evaluation;
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
        $komponens = Komponen::all();

        if (isset($teacher->cluster->id)) {
            $cluster_id = $teacher->cluster->id;
            $students = Student::where('cluster_id', $cluster_id)->get();
        } else {
            $students = null;
        }

        // dd($students);
        return view('teacher.guru.cluster', compact('students', 'teacher', 'komponens'));
    }

    // --- handle from walas page --- //
    public function studentGrade(Request $request)
    {
        $user_id = Auth::user()->id;
        $teacher = Teacher::where('user_id', $user_id)->first();
        $komponens = Komponen::all();
        $years = Year::all();
        if (isset($teacher->grade->id)) {
            $grade_id = $teacher->grade->id;
            $students = Student::where('grade_id', $grade_id)->get();
            $year_id = $request->year_id;
        } else {
            $students = null;
            $year_id = null;
        }

        return view('teacher.walas.grade', compact('students', 'teacher', 'komponens', 'years', 'year_id'));
    }

    // assign cluster dari page teacher
    public function assignCluster()
    {
        $user_id = Auth::user()->id;
        $teacher = Teacher::where('user_id', $user_id)->first();
        $students = Student::where('cluster_id', null)->orWhere('stage_id', null)->get();
        $stages = Stage::all();
        return view('teacher.assignCluster.assignCluster', compact('students', 'stages', 'teacher'));
    }

    public function storeAssignCluster(Request $request)
    {
        $cluster_id = $request->cluster_id;
        $datas = $request->input;
        $stage_id = $request->stage_id;

        foreach ($datas as $data) {
            $id = $data['id'];

            if (isset($data['check'])  == 'on') {
                Student::where('id', $id)->update([
                    'cluster_id' => $cluster_id,
                    'stage_id' => $stage_id
                ]);
            }
        }
        return redirect()->route('student.cluster');
    }

    public function deleteclusterstudent($id)
    {
        Student::where('id', $id)->update([
            'cluster_id' => NULL,

        ]);
        return redirect()->back();
    }
}

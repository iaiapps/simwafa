<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Stage;
use App\Models\Cluster;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $grade_id = $request->grade_id;
        $cluster_id = $request->cluster_id;

        $grades = Grade::all();
        $clusters = Cluster::all();


        if (isset($grade_id) && isset($cluster_id)) {
            $students = Student::where('grade_id', '=', $grade_id)->where('cluster_id', '=', $cluster_id)->get();
        } elseif (isset($grade_id)) {
            $students = Student::where('grade_id', '=', $grade_id)->get();
        } elseif (isset($cluster_id)) {
            $students = Student::where('cluster_id', '=', $cluster_id)->get();
        } else {
            $students = Student::all();
        }
        return view('admin.student.index', compact('students', 'grades', 'clusters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = Grade::all();
        $clusters = Cluster::all();
        $stages = Stage::all();

        return view('admin.student.create', compact('grades', 'clusters', 'stages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Student::create($request->all());
        return redirect()->route('student.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $grades = Grade::all();
        $clusters = Cluster::all();
        $stages = Stage::all();
        return view('admin.student.edit', compact('student', 'grades', 'clusters', 'stages'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        // dd($request->all());
        $student->update($request->all());
        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('student.index');
    }

    // --- assign student cluster --- //
    public function assignCluster()
    {
        $students = Student::where('cluster_id', null)->get();
        $clusters = Cluster::all();
        return view('admin.student.assignCluster.assignCluster', compact('students', 'clusters'));
    }

    public function storeAssignCluster(Request $request)
    {
        // dd($request->all());
        $cluster_id = $request->input('cluster_id');
        $datas = $request->input('input');
        foreach ($datas as $data) {
            $id = $data['id'];
            if (isset($data['check'])  == 'on') {
                Student::where('id', $id)->update([
                    'cluster_id' => $cluster_id,
                ]);
            }
        }
        return redirect()->route('student.index');
    }

    // --- assign student grade --- //
    public function assignGrade()
    {
        $students = Student::where('grade_id', null)->get();
        $grades = Grade::all();
        return view('admin.student.assignGrade.assignGrade', compact('students', 'grades'));
    }

    public function storeAssignGrade(Request $request)
    {
        $grade_id = $request->input('grade_id');
        $datas = $request->input('input');
        foreach ($datas as $data) {
            $id = $data['id'];
            if (isset($data['check']) == 'on') {
                Student::where('id', $id)->update([
                    'grade_id' => $grade_id,
                ]);
            }
        }
        return redirect()->route('student.index');
    }

    // --- assign student stage --- //
    public function assignStage()
    {
        $students = Student::where('stage_id', null)->get();
        $stages = Stage::all();
        return view('admin.student.assignStage.assignStage', compact('students', 'stages'));
    }

    public function storeAssignStage(Request $request)
    {
        $stage_id = $request->input('stage_id');
        $datas = $request->input('input');
        foreach ($datas as $data) {
            $id = $data['id'];
            if (isset($data['check']) == 'on') {
                Student::where('id', $id)->update([
                    'stage_id' => $stage_id,
                ]);
            }
        }
        return redirect()->route('student.index');
    }
}

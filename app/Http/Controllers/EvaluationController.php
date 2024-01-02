<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Cluster;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Komponen;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $grades = Grade::all();
        $komponen_id = Komponen::get('id');
        $data_komponen = Evaluation::whereIn('komponen_id', $komponen_id)->select('komponen_id')->groupBy('komponen_id')->get();

        $students_id = Student::get('id');
        foreach ($students_id as $student) {
            $evaluation = Evaluation::where('student_id', $student->id)->get();
            // dd($evaluation->avg('nilai'));
        }
        if ($request->grade_id == 0 || $request->grade_id == null) {
            $students = Student::all();
        } else {
            $students = Student::where('grade_id', $request->grade_id)->get();
        }

        return view('admin.evaluation.index', compact('grades', 'students', 'data_komponen', 'evaluation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $komponens = Komponen::all();
        $komponen_id = Komponen::where('id', $request->komponen_id)->get()->first();
        $grades = Grade::all();
        $students = Student::where('grade_id', $request->grade_id)->get();
        return view('admin.evaluation.create', compact('grades', 'komponens', 'students', 'komponen_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student_id = $request->student_id;
        $komponen_id = $request->komponen_id;
        $nilai = $request->nilai;

        foreach ($student_id as $sid) {
            $data = [
                'student_id' => $student_id[$sid],
                'komponen_id' => $komponen_id,
                'nilai' => $nilai[$sid]
            ];
            Evaluation::create($data);
        }
        return redirect()->route('evaluation.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $evaluations = Evaluation::where('student_id', $id)->orderBy('student_id')->get();
        return view('admin.evaluation.show', compact('evaluations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }

    // --------------- handle from role:guru ---------------//
    public function evalIndex(Request $request)
    {
        $user_id = Auth::user()->id;
        $teacher = Teacher::where('user_id', $user_id)->first();
        $cluster_id = $teacher->cluster->id;

        $komponen_id = Komponen::get('id');
        $data_komponen = Evaluation::whereIn('komponen_id', $komponen_id)->select('komponen_id')->groupBy('komponen_id')->get();
        $students = Student::where('cluster_id', $cluster_id)->get();

        return view('teacher.evaluation.evalindex', compact('students', 'data_komponen', 'teacher'));
    }

    public function evalStudent(Request $request)
    {
        $user_id = Auth::user()->id;
        $teacher = Teacher::where('user_id', $user_id)->first();
        $cluster_id = $teacher->cluster->id;
        $komponens = Komponen::all();
        $komponen_id = Komponen::where('id', $request->komponen_id)->get()->first();
        $students = Student::where('cluster_id', $cluster_id)->get();
        return view('teacher.evaluation.evalcreate', compact('komponens', 'students', 'komponen_id'));
    }

    public function evalStudentStore(Request $request)
    {
        $student_id = $request->student_id;
        $komponen_id = $request->komponen_id;
        $nilai = $request->nilai;

        foreach ($student_id as $sid) {
            $data = Evaluation::where('student_id', $sid)
                ->where('komponen_id', $komponen_id)->first();

            if (!$data) {
                $data = [
                    'student_id' => $student_id[$sid],
                    'komponen_id' => $komponen_id,
                    'nilai' => $nilai[$sid]
                ];
                Evaluation::create($data);
            } else {
                return redirect()->route('student.evaluation')->with('message', 'nilai sudah ada');
            }
        }

        return redirect()->route('student.evaluation')->with('message', 'nilai berhasil ditambahkan');
    }

    public function evalStudentShow($id)
    {
        // dd($id);
        $evaluations = Evaluation::where('student_id', $id)->orderBy('student_id')->get();
        return view('teacher.evaluation.evalshow', compact('evaluations'));
    }
}

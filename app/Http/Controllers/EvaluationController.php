<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Grade;
use App\Models\Cluster;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Komponen;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Mockery\Generator\Parameter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Collection;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $grades = Grade::all();
        $years = Year::all();
        $komponen_id = Komponen::get('id');
        $data_komponen = Evaluation::whereIn('komponen_id', $komponen_id)->select('komponen_id')->groupBy('komponen_id')->get();
        $komponens = Komponen::all();

        if ($request->grade_id == null && $request->year_id == null) {
            $students = null;
            $grade_name = null;
            $year_name = null;
        } elseif ($request->grade_id == 'all') {
            $students = Student::all();
            $grade_name = null;
            $year_name = Year::where('id', $request->year_id)->first();
        } else {
            $students = Student::where('grade_id', $request->grade_id)->get();
            $grade_name = Grade::where('id', $request->grade_id)->first();
            $year_name = Year::where('id', $request->year_id)->first();
        }

        return view('admin.evaluation.index', compact('grades', 'students', 'data_komponen', 'grade_name', 'komponens', 'years', 'year_name'));
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
    public function destroy($del, Request $request)
    {
        // dd($request->all());
        $del = Evaluation::where('student_id', $del);
        $del->delete();
        return redirect()->route('evaluation.index', ['grade_id' => $request->grade_id]);
    }


    // ------------- jika guru belum ditentukan -------------//
    public function teacherId()
    {
        $user_id = Auth::user()->id;
        $teacher = Teacher::where('user_id', $user_id)->first();
        $cluster_id = $teacher->cluster_id;

        // ini cara return lebih dari 1 parameter
        return [$teacher, $cluster_id];
    }

    // --------------- handle from role:guru ---------------//
    public function evalIndex(Request $request)
    {
        // ini cara mengambil parameter dari function lain
        // yang memiliki lebih dari 1 Parameter
        list($teacher, $cluster_id) = $this->teacherId();
        $komponens = Komponen::all();
        $years = Year::all();


        if (isset($cluster_id)) {
            $students = Student::where('cluster_id', $cluster_id)->get();
            $year_id = $request->year_id;
        } else {
            $students = null;
            $year_id = null;
        }

        $komponen_id = Komponen::get('id');
        $data_komponen = Evaluation::whereIn('komponen_id', $komponen_id)->select('komponen_id')->groupBy('komponen_id')->get();

        return view('teacher.evaluation.evalindex', compact('students', 'komponens', 'teacher', 'years', 'year_id'));
    }

    public function evalStudent(Request $request)
    {
        list($teacher, $cluster_id) = $this->teacherId();

        if (isset($cluster_id)) {
            $students = Student::where('cluster_id', $cluster_id)->get();
        } else {
            $students = null;
        }

        $komponens = Komponen::all();
        $komponen_id = Komponen::where('id', $request->komponen_id)->get()->first();
        $years = Year::all();
        return view('teacher.evaluation.evalcreate', compact('komponens', 'students', 'komponen_id', 'years'));
    }

    public function evalStudentStore(Request $request)
    {
        $student_id = $request->student_id;
        $komponen_id = $request->komponen_id;
        $nilai = $request->nilai;

        foreach ($student_id as $sid) {
            $data = Evaluation::where('student_id', $sid)
                ->where('komponen_id', $komponen_id)->first();
            // dd($data);
            if (!$data) {
                $data = [
                    'student_id' => $student_id[$sid],
                    'komponen_id' => $komponen_id,
                    'nilai' => $nilai[$sid]
                ];
                Evaluation::create($data);
            } else {
                $ini = Evaluation::where('student_id', $sid)->where('komponen_id', $komponen_id)->first();
                $ini->update(
                    ['nilai' => $nilai[$sid]]
                );
            }
        }

        return redirect()->route('student.evaluation')->with('message', 'nilai berhasil ditambah dan diupdate');

        // foreach ($student_id as $sid) {
        //     $data = Evaluation::where('student_id', $sid)
        //         ->where('komponen_id', $komponen_id)->first();
        //     if (!$data) {
        //         return redirect()->route('student.evaluation')->with('message', 'nilai berhasil ditambahkan');
        //     } else {
        //         return redirect()->route('student.evaluation')->with('message', 'nilai berhasil diupdate');
        //     }
        // }
    }

    public function evalStudentShow($id)
    {
        $evaluations = Evaluation::where('student_id', $id)->orderBy('student_id')->get();
        return view('teacher.evaluation.evalshow', compact('evaluations'));
    }
}

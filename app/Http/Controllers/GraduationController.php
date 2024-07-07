<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Graduation;
use Illuminate\Http\Request;

class GraduationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $graduations = Graduation::all();
        return view('admin.graduation.index', compact('graduations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $grades = Grade::all();
        // dd($request->all());
        $students = [];
        return view('admin.graduation.create', compact('grades', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Graduation $graduation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Graduation $graduation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Graduation $graduation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Graduation $graduation)
    {
        //
    }

    // grade_class
    public function grade_class(Request $request)
    {
        $grade_id = $request->grade_id;
        $grades = Grade::all();
        $students = Student::where('grade_id', '=', $grade_id)->get();
        $years = Year::all();
        // dd($grade_id);
        return view('admin.graduation.create', compact('grades', 'students', 'years'));
    }

    public function move(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        $year_id = $request->year_id;
        $data = Student::find($id)->replicate()->toArray();
        $data['year_id'] = $year_id;
        Graduation::create($data);
        Student::find($id)->delete();
        return redirect()->route('graduation.index');
    }
}

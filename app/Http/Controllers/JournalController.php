<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{


    // admin
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.journal.index', compact('teachers'));
    }

    public function showJournal(Request $request)
    {
        $teacher_id = $request->id;
        $journals = Journal::where('teacher_id', $teacher_id)->get();
        return view('admin.journal.show', compact('journals'));
    }


    // handle user
    /**
     * Show the form for creating a new resource.
     */
    public function create($teacher_id)
    {
        return view('teacher.journal.create', compact('teacher_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Journal::create($request->all());
        return redirect()->route('teacher.journal');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $teacher = Auth::user()->teacher;
        $teacher_id = $teacher->id;
        $journals = Journal::where('teacher_id', $teacher_id)->get();
        return view('teacher.journal.show', compact('journals', 'teacher_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Journal $journal)
    {
        return view('teacher.journal.edit', compact('journal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Journal $journal)
    {
        // dd($journal);
        $journal->update($request->all());
        return redirect()->route('teacher.journal');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Journal $journal)
    {
        //
    }
}

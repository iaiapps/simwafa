<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use App\Http\Controllers\EvaluationController;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $years = Year::all();
        return view('admin.year.index', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Year::create($request->all());
        return redirect()->route('year.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Year $year)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Year $year)
    {
        return view('admin.year.edit', compact('year'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Year $year)
    {
        $year->update($request->all());
        return redirect()->route('year.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Year $year)
    {
        $year->delete();
        return redirect()->route('year.index');
    }
}

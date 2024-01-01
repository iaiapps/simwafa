<?php

namespace App\Http\Controllers;

use App\Models\Komponen;
use Illuminate\Http\Request;

class KomponenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $komponens = Komponen::all();
        return view('admin.komponen.index', compact('komponens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.komponen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Komponen::create($request->all());
        return redirect()->route('komponen.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(komponen $komponen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(komponen $komponen)
    {
        return view('admin.komponen.edit', compact('komponen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, komponen $komponen)
    {
        $komponen->update($request->all());
        return redirect()->route('komponen.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(komponen $komponen)
    {
        $komponen->delete();
        return redirect()->route('komponen.index');
    }
}

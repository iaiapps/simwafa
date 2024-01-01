<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clusters = Cluster::all();
        return view('admin.cluster.index', compact('clusters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cluster.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Cluster::create($request->all());
        return redirect()->route('cluster.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cluster $cluster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cluster $cluster)
    {
        return view('admin.cluster.edit', compact('cluster'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cluster $cluster)
    {
        $cluster->update($request->all());
        return redirect()->route('cluster.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cluster $cluster)
    {
        $cluster->delete();
        return redirect()->route('cluster.index');
    }

    // ----------------- handle dari user ----------------- //

    public function clusterstudent()
    {
        $id = Auth::user();
        $students = Student::where('id', $id);
    }
}

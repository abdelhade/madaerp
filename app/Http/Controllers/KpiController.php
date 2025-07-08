<?php

namespace App\Http\Controllers;

use App\Models\Kpi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class KpiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('hr-management.kpis.manage-kpi');
    }

    public function employeeEvaluation()
    {
        return view('hr-management.kpis.manage-employee-evaluation');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Kpi $kpi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kpi $kpi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kpi $kpi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kpi $kpi)
    {
        //
    }
}

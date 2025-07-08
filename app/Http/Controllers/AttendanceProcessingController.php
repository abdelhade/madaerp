<?php

namespace App\Http\Controllers;

use App\Models\AttendanceProcessing;
use Illuminate\Http\Request;

class AttendanceProcessingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('hr-management.attendances.processing.manage-processing');
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
    public function show(AttendanceProcessing $AttendanceProcessing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AttendanceProcessing $AttendanceProcessing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AttendanceProcessing $AttendanceProcessing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttendanceProcessing $AttendanceProcessing)
    {
        //
    }
}

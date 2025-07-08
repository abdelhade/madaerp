<?php
namespace App\Http\Controllers;

use App\Models\CostCenter;
use Illuminate\Http\Request;

class CostCenterController extends Controller
{
    public function index()
    {
        $centers = CostCenter::where('deleted', 0)->get();
        return view('cost_centers.index', compact('centers'));
    }

    public function create()
    {
        $parents = CostCenter::where('deleted', 0)->get();
        return view('cost_centers.create', compact('parents'));
    }

    public function store(Request $request)
    {
        CostCenter::create($request->all());
        return redirect()->route('cost_centers.index');
    }

    public function edit($id)
    {
        $center = CostCenter::findOrFail($id);
        $parents = CostCenter::where('id', '!=', $id)->where('deleted', 0)->get();
        return view('cost_centers.edit', compact('center', 'parents'));
    }

    public function update(Request $request, $id)
    {
        $center = CostCenter::findOrFail($id);
        $center->update($request->all());
        return redirect()->route('cost_centers.index');
    }

    public function destroy($id)
    {
        $center = CostCenter::findOrFail($id);
        $center->update(['deleted' => 1]);
        return redirect()->route('cost_centers.index');
    }

    public function show($id)
    {
        $center = CostCenter::findOrFail($id);
        return view('cost_centers.show', compact('center'));
    }
}

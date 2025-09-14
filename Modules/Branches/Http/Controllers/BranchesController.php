<?php

namespace Modules\Branches\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Branches\Models\Branch;
use RealRashid\SweetAlert\Facades\Alert;
use Modules\Branches\Http\Requests\BranchesRequest;

class BranchesController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('can:عرض الفروع')->only(['index']);
    //     $this->middleware('can:إضافة فرع')->only(['create', 'store']);
    //     $this->middleware('can:تعديل فرع')->only(['edit', 'update']);
    //     $this->middleware('can:حذف فرع')->only(['destroy']);
    // }

    public function index()
    {
        $branches = Branch::all();
        return view('branches::branches.index', compact('branches'));
    }

    public function create()
    {
        return view('branches::branches.create');
    }

    public function store(BranchesRequest $request)
    {
        try {
            Branch::create($request->validated());
            Alert::toast('تم الانشاء بنجاح', 'success');
            return redirect()->route('branches.index');
        } catch (\Exception) {
            Alert::toast('حدث خطأ', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branches::branches.edit', compact('branch'));
    }

    public function update(BranchesRequest $request, $id)
    {
        try {
            $branch = Branch::findOrFail($id);
            $branch->update($request->validated());
            Alert::toast('تم التعديل بنجاح', 'success');
            return redirect()->route('branches.index');
        } catch (\Exception) {
            Alert::toast('حدث خطأ', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {

            $branch = Branch::findOrFail($id);
            $branch->delete();
            Alert::toast('تم حذف الفرع بنجاح', 'success');
            return redirect()->route('branches.index');
        } catch (\Exception) {
            Alert::toast('حدث خطأ', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function toggleStatus(Request $request)
    {
        $branch = Branch::findOrFail($request->id);
        $branch->is_active = $request->is_active;
        $branch->save();

        return response()->json(['success' => true]);
    }
}

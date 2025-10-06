<?php

namespace Modules\Inquiries\Http\Controllers;

use Illuminate\Routing\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Modules\Inquiries\Models\ProjectDocument;
use Modules\Inquiries\Http\Requests\ProjectDocumentRequest;

class InquiryDocumentController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('can:عرض المستندات')->only(['index']);
    //     $this->middleware('can:إضافة المستندات')->only(['create', 'store']);
    //     $this->middleware('can:تعديل المستندات')->only(['edit', 'update']);
    //     $this->middleware('can:حذف المستندات')->only(['destroy']);
    // }

    public function index()
    {
        $documents = ProjectDocument::latest()->get();
        return view('inquiries::project-documents.index', compact('documents'));
    }

    public function create()
    {
        return view('inquiries::project-documents.create');
    }

    public function store(ProjectDocumentRequest $request)
    {
        ProjectDocument::create($request->validated());
        Alert::toast('تم إنشاء المستند بنجاح', 'success');
        return redirect()->route('inquiry.documents.index');
    }

    public function edit($id)
    {
        $document = ProjectDocument::findOrFail($id);
        return view('inquiries::project-documents.edit', compact('document'));
    }

    public function update(ProjectDocumentRequest $request, $id)
    {
        $document = ProjectDocument::findOrFail($id);
        $document->update($request->validated());
        Alert::toast('تم تحديث المستند بنجاح', 'success');
        return redirect()->route('inquiry.documents.index');
    }

    public function destroy($id)
    {
        $document = ProjectDocument::findOrFail($id);
        $document->delete();
        Alert::toast('تم حذف المستند بنجاح', 'success');
        return redirect()->route('inquiry.documents.index');
    }
}

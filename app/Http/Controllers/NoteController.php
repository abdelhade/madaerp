<?php

namespace App\Http\Controllers;


class NoteController extends Controller
{
    public function index()
    {
        return view('item-management.notes.manage-notes');
    }
    public function noteDetails($noteId)
    {
        return view('item-management.notes.note-details', compact('noteId'));
    }
}

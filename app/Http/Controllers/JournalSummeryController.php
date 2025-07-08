<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JournalHead;
use App\Models\JournalDetail;

 
class JournalSummeryController extends Controller

{
    public function index()
    {
        $journalHeads = JournalHead::with('dets')->get();
      
        

        return view('journals.journal-summery', compact('journalHeads'));
    }
    

}

<?php

namespace App\Http\Controllers;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = History::orderBy('Time', 'desc')->get();
        return view('lichsu.index', compact('histories'));
    }

}
<?php

namespace App\Http\Controllers;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = History::orderBy('Time', 'desc')->get();
        // dd($histories);
        return view('lichsu.index', compact('histories'));
    }

    public function search(Request $request)
    {
        $histories = DB::table('history')->where('description', 'LIKE', '%' . $request->search . '%')->orderBy('Time', 'desc')->get();
        //$histories->appends($request->all());
        return response()->json([
            'histories' => $histories,
        ]); 
    }
}
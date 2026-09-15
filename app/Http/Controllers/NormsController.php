<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NormsController extends Controller
{
    public function lookup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'raw_score' => 'required|integer',
            'letter' => 'required|string',
        ]);

        $name = $request->input('name');
        $rawScore = $request->input('raw_score');
        $letter = $request->input('letter');

        // Query the database
        $norm = DB::table('norms')
            ->where('raw_score', $rawScore)
            ->first();

        if ($norm) {
            $letterValue = $norm->$letter;
            $result = [
                'name' => $name,
                'letter' => $letter,
                'raw_score' => $rawScore,
            ];

            // Store results in session
            $results = session('results', []);
            $results[] = $result;
            session(['results' => $results]);

            return redirect()->back()->with('result', 'Lookup successful!');
        } else {
            return redirect()->back()->with('result', 'No norms found for the given raw score.');
        }
    }
}

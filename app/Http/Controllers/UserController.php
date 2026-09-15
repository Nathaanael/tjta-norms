<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Name;
use App\Models\Result;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
        ]);

        $user = Name::create($request->all());

        // Simpan informasi pengguna yang baru dibuat ke dalam sesi
        session(['user' => $user]);

        return redirect()->route('users.choose')->with('success', 'User created successfully.');
    }

    public function chooseName()
    {
        $names = Name::all();
        return view('users.choose', compact('names'));
    }

    public function showForm($id)
    {
        $user = Name::find($id);

        if (!$user) {
            return redirect()->route('users.choose')->withErrors(['user' => 'User not found.']);
        }

        // Simpan user ke dalam sesi
        session(['user' => $user]);

        return view('input.input', compact('user'));
    }

    public function performLookup(Request $request)
    {
        $request->validate([
            'raw_score' => 'required|integer',
            'letter' => 'required|string',
        ]);

        $rawScore = $request->input('raw_score');
        $letter = $request->input('letter');

        // Get the user from the session
        $user = session('user');

        if (!$user) {
            return redirect()->back()->withErrors(['user' => 'No user selected.']);
        }

        $gender = $user->gender;

        // Select database table based on gender
        $table = $gender === 'male' ? 'male_tjta_scores' : 'female_tjta_scores';

        // Query the database
        $norm = DB::table($table)
            ->where('raw_score', $rawScore)
            ->first();

        if ($norm) {
            $letterValue = $norm->$letter;

            // Save the result to the `results` table
            Result::create([
                'user_id' => $user->id, // This references the `id` from the `names` table
                'letter' => $letter,
                'raw_score' => $rawScore,
                'value' => $letterValue,
            ]);

            return redirect()->back()->with('success', 'Lookup successful!');
        } else {
            return redirect()->back()->withErrors(['result' => 'No norms found for the given raw score.']);
        }
    }
}

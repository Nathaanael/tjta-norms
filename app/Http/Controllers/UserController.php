<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Name;
use App\Models\Result;

class UserController extends Controller
{
    private const SCALES = [
        'nervous' => ['code' => 'A', 'label' => 'Nervous'],
        'depressive' => ['code' => 'B', 'label' => 'Depressive'],
        'active_social' => ['code' => 'C', 'label' => 'Active Social'],
        'expressive_responsive' => ['code' => 'D', 'label' => 'Expressive–Responsive'],
        'sympathetic' => ['code' => 'E', 'label' => 'Sympathetic'],
        'subjective' => ['code' => 'F', 'label' => 'Subjective'],
        'dominant' => ['code' => 'G', 'label' => 'Dominant'],
        'hostile' => ['code' => 'H', 'label' => 'Hostile'],
        'self_disciplined' => ['code' => 'I', 'label' => 'Self-disciplined'],
    ];

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

        $user = Name::create([
            'name' => trim($request->input('name')),
            'gender' => $request->input('gender'),
        ]);

        // Simpan informasi pengguna yang baru dibuat ke dalam sesi
        session(['user' => $user]);

        return redirect()->route('input.input', $user->id)->with('success', 'Peserta berhasil ditambahkan. Silakan mulai memasukkan skor.');
    }

    public function chooseName(Request $request)
    {
        $search = trim((string) $request->query('search'));
        $sort = $request->query('sort') === 'desc' ? 'desc' : 'asc';

        $names = Name::query()
            ->withCount('results')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name', $sort)
            ->paginate(10)
            ->withQueryString();

        return view('users.choose', compact('names', 'search', 'sort'));
    }

    public function edit($id)
    {
        $user = Name::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
        ]);

        $user = Name::with('results')->findOrFail($id);
        $genderChanged = $user->gender !== $validated['gender'];

        DB::transaction(function () use ($user, $validated, $genderChanged) {
            $user->update([
                'name' => trim($validated['name']),
                'gender' => $validated['gender'],
            ]);

            if ($genderChanged) {
                $table = $validated['gender'] === 'male' ? 'male_tjta_scores' : 'female_tjta_scores';

                foreach ($user->results as $result) {
                    $norm = DB::table($table)->where('raw_score', $result->raw_score)->first();

                    if ($norm && array_key_exists($result->letter, self::SCALES)) {
                        $result->update(['value' => $norm->{$result->letter}]);
                    }
                }
            }
        });

        session(['user' => $user->fresh()]);

        return redirect()->route('input.input', $user->id)
            ->with('success', $genderChanged
                ? 'Data peserta diperbarui dan seluruh persentil dihitung ulang.'
                : 'Data peserta berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = Name::findOrFail($id);
        $name = $user->name;
        $sessionUser = session('user');

        $user->delete();

        if ($sessionUser && (int) $sessionUser->id === (int) $id) {
            session()->forget('user');
        }

        return redirect()->route('users.choose')
            ->with('success', "Peserta {$name} beserta riwayat hasilnya berhasil dihapus.");
    }

    public function showForm($id)
    {
        $user = Name::with(['results' => function ($query) {
            $query->latest();
        }])->find($id);

        if (!$user) {
            return redirect()->route('users.choose')->withErrors(['user' => 'User not found.']);
        }

        // Simpan user ke dalam sesi
        session(['user' => $user]);

        $scales = self::SCALES;
        $completedScales = $user->results->pluck('letter')->unique()->count();

        return view('input.input', compact('user', 'scales', 'completedScales'));
    }

    public function performLookup(Request $request)
    {
        $request->validate([
            'raw_score' => 'required|integer|min:0|max:40',
            'letter' => 'required|in:' . implode(',', array_keys(self::SCALES)),
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

            return redirect()->back()->with('success', 'Skor berhasil dikonversi dan disimpan.');
        } else {
            return redirect()->back()->withInput()->withErrors(['result' => 'Norma untuk skor mentah tersebut tidak ditemukan.']);
        }
    }

    public function editResult($id)
    {
        $result = Result::with('user')->findOrFail($id);
        $scales = self::SCALES;

        return view('input.edit-result', compact('result', 'scales'));
    }

    public function updateResult(Request $request, $id)
    {
        $validated = $request->validate([
            'raw_score' => 'required|integer|min:0|max:40',
            'letter' => ['required', Rule::in(array_keys(self::SCALES))],
        ]);

        $result = Result::with('user')->findOrFail($id);
        $table = $result->user->gender === 'male' ? 'male_tjta_scores' : 'female_tjta_scores';
        $norm = DB::table($table)->where('raw_score', $validated['raw_score'])->first();

        if (!$norm) {
            return redirect()->back()->withInput()
                ->withErrors(['raw_score' => 'Norma untuk skor mentah tersebut tidak ditemukan.']);
        }

        $result->update([
            'letter' => $validated['letter'],
            'raw_score' => $validated['raw_score'],
            'value' => $norm->{$validated['letter']},
        ]);

        return redirect()->route('input.input', $result->user_id)
            ->with('success', 'Hasil berhasil diperbarui dan persentil telah dihitung ulang.');
    }

    public function destroyResult($id)
    {
        $result = Result::findOrFail($id);
        $userId = $result->user_id;
        $result->delete();

        return redirect()->route('input.input', $userId)
            ->with('success', 'Hasil berhasil dihapus dari riwayat peserta.');
    }

}

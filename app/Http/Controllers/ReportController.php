<?php

namespace App\Http\Controllers;

use App\Models\Name;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    private const SCALES = [
        'nervous' => ['code' => 'A', 'label' => 'Nervous'],
        'depressive' => ['code' => 'B', 'label' => 'Depressive'],
        'active_social' => ['code' => 'C', 'label' => 'Active Social'],
        'expressive_responsive' => ['code' => 'D', 'label' => 'Expressive-Responsive'],
        'sympathetic' => ['code' => 'E', 'label' => 'Sympathetic'],
        'subjective' => ['code' => 'F', 'label' => 'Subjective'],
        'dominant' => ['code' => 'G', 'label' => 'Dominant'],
        'hostile' => ['code' => 'H', 'label' => 'Hostile'],
        'self_disciplined' => ['code' => 'I', 'label' => 'Self-disciplined'],
    ];

    public function download($id)
    {
        $participant = Name::with(['results' => function ($query) {
            $query->latest('id');
        }])->findOrFail($id);

        $latestResults = $participant->results->unique('letter')->keyBy('letter');
        $reportRows = collect(self::SCALES)->map(function ($scale, $key) use ($latestResults) {
            $result = $latestResults->get($key);

            return array_merge($scale, [
                'raw_score' => $result?->raw_score,
                'percentile' => $result?->value,
                'recorded_at' => $result?->created_at,
            ]);
        });

        $pdf = $this->buildPdf($participant, $reportRows, false);
        $filename = 'laporan-tjta-' . Str::slug($participant->name) . '.pdf';

        return $pdf->download($filename);
    }

    public function sample()
    {
        $participant = (object) [
            'name' => 'Contoh Peserta',
            'gender' => 'female',
            'id' => 'DUMMY-001',
            'created_at' => now()->subDays(3),
        ];

        $values = [
            'nervous' => [18, 78],
            'depressive' => [12, 72],
            'active_social' => [27, 38],
            'expressive_responsive' => [30, 29],
            'sympathetic' => [24, 4],
            'subjective' => [16, 74],
            'dominant' => [22, 49],
            'hostile' => [9, 59],
            'self_disciplined' => [28, 56],
        ];

        $reportRows = collect(self::SCALES)->map(function ($scale, $key) use ($values) {
            return array_merge($scale, [
                'raw_score' => $values[$key][0],
                'percentile' => $values[$key][1],
                'recorded_at' => now()->subDays(2),
            ]);
        });

        return $this->buildPdf($participant, $reportRows, true)
            ->download('contoh-laporan-tjta.pdf');
    }

    private function buildPdf(object $participant, $reportRows, bool $isSample)
    {
        $completedCount = $reportRows->whereNotNull('percentile')->count();

        return Pdf::loadView('reports.tjta', [
            'participant' => $participant,
            'reportRows' => $reportRows,
            'completedCount' => $completedCount,
            'isSample' => $isSample,
            'generatedAt' => now('Asia/Jakarta'),
        ])->setPaper('a4', 'portrait');
    }
}

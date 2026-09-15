<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NormsTableSeeder extends Seeder
{
    public function run()
    {
        $norms = [
            ['raw_score' => 40, 'nervous' => 99, 'depressive' => 99, 'active_social' => 99, 'expressive_responsive' => 99, 'sympathetic' => 99, 'subjective' => 99, 'dominant' => 99, 'hostile' => 99, 'self_disciplined' => 99],
            ['raw_score' => 39, 'nervous' => 99, 'depressive' => 99, 'active_social' => 97, 'expressive_responsive' => 95, 'sympathetic' => 98, 'subjective' => 99, 'dominant' => 99, 'hostile' => 99, 'self_disciplined' => 98],
            ['raw_score' => 38, 'nervous' => 99, 'depressive' => 99, 'active_social' => 96, 'expressive_responsive' => 93, 'sympathetic' => 97, 'subjective' => 99, 'dominant' => 99, 'hostile' => 99, 'self_disciplined' => 98],
            ['raw_score' => 37, 'nervous' => 99, 'depressive' => 99, 'active_social' => 92, 'expressive_responsive' => 84, 'sympathetic' => 93, 'subjective' => 99, 'dominant' => 98, 'hostile' => 99, 'self_disciplined' => 95],
            ['raw_score' => 36, 'nervous' => 99, 'depressive' => 99, 'active_social' => 90, 'expressive_responsive' => 81, 'sympathetic' => 90, 'subjective' => 99, 'dominant' => 97, 'hostile' => 99, 'self_disciplined' => 94],
            ['raw_score' => 35, 'nervous' => 99, 'depressive' => 99, 'active_social' => 84, 'expressive_responsive' => 71, 'sympathetic' => 81, 'subjective' => 99, 'dominant' => 95, 'hostile' => 99, 'self_disciplined' => 89],
            ['raw_score' => 34, 'nervous' => 99, 'depressive' => 99, 'active_social' => 81, 'expressive_responsive' => 68, 'sympathetic' => 76, 'subjective' => 99, 'dominant' => 94, 'hostile' => 99, 'self_disciplined' => 87],
            ['raw_score' => 33, 'nervous' => 99, 'depressive' => 99, 'active_social' => 44, 'expressive_responsive' => 55, 'sympathetic' => 99, 'subjective' => 88, 'dominant' => 99, 'hostile' => 99, 'self_disciplined' => 81],
            ['raw_score' => 32, 'nervous' => 99, 'depressive' => 97, 'active_social' => 51, 'expressive_responsive' => 46, 'sympathetic' => 99, 'subjective' => 88, 'dominant' => 92, 'hostile' => 99, 'self_disciplined' => 73],
            ['raw_score' => 31, 'nervous' => 99, 'depressive' => 96, 'active_social' => 46, 'expressive_responsive' => 51, 'sympathetic' => 99, 'subjective' => 82, 'dominant' => 89, 'hostile' => 99, 'self_disciplined' => 60],
            ['raw_score' => 30, 'nervous' => 98, 'depressive' => 97, 'active_social' => 44, 'expressive_responsive' => 46, 'sympathetic' => 99, 'subjective' => 79, 'dominant' => 79, 'hostile' => 98, 'self_disciplined' => 70],
            ['raw_score' => 29, 'nervous' => 98, 'depressive' => 95, 'active_social' => 37, 'expressive_responsive' => 34, 'sympathetic' => 99, 'subjective' => 68, 'dominant' => 97, 'hostile' => 60, 'self_disciplined' => 28],
            ['raw_score' => 28, 'nervous' => 98, 'depressive' => 91, 'active_social' => 35, 'expressive_responsive' => 34, 'sympathetic' => 99, 'subjective' => 68, 'dominant' => 97, 'hostile' => 60, 'self_disciplined' => 54],
            ['raw_score' => 27, 'nervous' => 97, 'depressive' => 90, 'active_social' => 28, 'expressive_responsive' => 26, 'sympathetic' => 99, 'subjective' => 55, 'dominant' => 96, 'hostile' => 55, 'self_disciplined' => 27],
            ['raw_score' => 26, 'nervous' => 97, 'depressive' => 86, 'active_social' => 26, 'expressive_responsive' => 24, 'sympathetic' => 98, 'subjective' => 48, 'dominant' => 95, 'hostile' => 44, 'self_disciplined' => 26],
            ['raw_score' => 25, 'nervous' => 96, 'depressive' => 83, 'active_social' => 20, 'expressive_responsive' => 17, 'sympathetic' => 97, 'subjective' => 47, 'dominant' => 95, 'hostile' => 48, 'self_disciplined' => 44],
            ['raw_score' => 24, 'nervous' => 96, 'depressive' => 78, 'active_social' => 16, 'expressive_responsive' => 13, 'sympathetic' => 96, 'subjective' => 37, 'dominant' => 92, 'hostile' => 35, 'self_disciplined' => 33],
            ['raw_score' => 23, 'nervous' => 94, 'depressive' => 74, 'active_social' => 14, 'expressive_responsive' => 11, 'sympathetic' => 94, 'subjective' => 28, 'dominant' => 89, 'hostile' => 23, 'self_disciplined' => 28],
            ['raw_score' => 22, 'nervous' => 93, 'depressive' => 67, 'active_social' => 12, 'expressive_responsive' => 8, 'sympathetic' => 94, 'subjective' => 24, 'dominant' => 88, 'hostile' => 28, 'self_disciplined' => 25],
            ['raw_score' => 21, 'nervous' => 91, 'depressive' => 63, 'active_social' => 11, 'expressive_responsive' => 8, 'sympathetic' => 94, 'subjective' => 24, 'dominant' => 86, 'hostile' => 28, 'self_disciplined' => 23],
            ['raw_score' => 20, 'nervous' => 87, 'depressive' => 59, 'active_social' => 10, 'expressive_responsive' => 7, 'sympathetic' => 90, 'subjective' => 20, 'dominant' => 86, 'hostile' => 21, 'self_disciplined' => 19],
            ['raw_score' => 19, 'nervous' => 86, 'depressive' => 50, 'active_social' => 9, 'expressive_responsive' => 4, 'sympathetic' => 89, 'subjective' => 18, 'dominant' => 81, 'hostile' => 19, 'self_disciplined' => 15],
            ['raw_score' => 18, 'nervous' => 82, 'depressive' => 41, 'active_social' => 7, 'expressive_responsive' => 4, 'sympathetic' => 86, 'subjective' => 13, 'dominant' => 80, 'hostile' => 15, 'self_disciplined' => 17],
            ['raw_score' => 17, 'nervous' => 80, 'depressive' => 34, 'active_social' => 7, 'expressive_responsive' => 3, 'sympathetic' => 85, 'subjective' => 13, 'dominant' => 76, 'hostile' => 14, 'self_disciplined' => 17],
            ['raw_score' => 16, 'nervous' => 75, 'depressive' => 29, 'active_social' => 5, 'expressive_responsive' => 2, 'sympathetic' => 79, 'subjective' => 8, 'dominant' => 74, 'hostile' => 10, 'self_disciplined' => 14],
            ['raw_score' => 15, 'nervous' => 67, 'depressive' => 21, 'active_social' => 4, 'expressive_responsive' => 1, 'sympathetic' => 73, 'subjective' => 5, 'dominant' => 67, 'hostile' => 6, 'self_disciplined' => 12],
            ['raw_score' => 14, 'nervous' => 64, 'depressive' => 18, 'active_social' => 4, 'expressive_responsive' => 1, 'sympathetic' => 71, 'subjective' => 1, 'dominant' => 61, 'hostile' => 4, 'self_disciplined' => 10],
            ['raw_score' => 13, 'nervous' => 57, 'depressive' => 15, 'active_social' => 2, 'expressive_responsive' => 1, 'sympathetic' => 65, 'subjective' => 4, 'dominant' => 61, 'hostile' => 3, 'self_disciplined' => 8],
            ['raw_score' => 12, 'nervous' => 54, 'depressive' => 12, 'active_social' => 2, 'expressive_responsive' => 1, 'sympathetic' => 62, 'subjective' => 3, 'dominant' => 58, 'hostile' => 4, 'self_disciplined' => 7],
            ['raw_score' => 11, 'nervous' => 47, 'depressive' => 11, 'active_social' => 1, 'expressive_responsive' => 1, 'sympathetic' => 53, 'subjective' => 2, 'dominant' => 51, 'hostile' => 3, 'self_disciplined' => 3],
            ['raw_score' => 10, 'nervous' => 44, 'depressive' => 7, 'active_social' => 1, 'expressive_responsive' => 1, 'sympathetic' => 51, 'subjective' => 1, 'dominant' => 48, 'hostile' => 2, 'self_disciplined' => 3],
            ['raw_score' => 9, 'nervous' => 38, 'depressive' => 7, 'active_social' => 1, 'expressive_responsive' => 1, 'sympathetic' => 48, 'subjective' => 1, 'dominant' => 40, 'hostile' => 1, 'self_disciplined' => 1],
            ['raw_score' => 8, 'nervous' => 32, 'depressive' => 6, 'active_social' => 1, 'expressive_responsive' => 1, 'sympathetic' => 40, 'subjective' => 1, 'dominant' => 37, 'hostile' => 1, 'self_disciplined' => 1],
            ['raw_score' => 7, 'nervous' => 24, 'depressive' => 5, 'active_social' => 1, 'expressive_responsive' => 1, 'sympathetic' => 37, 'subjective' => 1, 'dominant' => 29, 'hostile' => 1, 'self_disciplined' => 1],
            ['raw_score' => 6, 'nervous' => 32, 'depressive' => 60, 'active_social' => 1, 'expressive_responsive' => 1, 'sympathetic' => 1, 'subjective' => 27, 'dominant' => 1, 'hostile' => 29, 'self_disciplined' => 1],
            ['raw_score' => 5, 'nervous' => 24, 'depressive' => 50, 'active_social' => 1, 'expressive_responsive' => 1, 'sympathetic' => 1, 'subjective' => 24, 'dominant' => 1, 'hostile' => 25, 'self_disciplined' => 1],
            ['raw_score' => 4, 'nervous' => 13, 'depressive' => 34, 'active_social' => 1, 'expressive_responsive' => 1, 'sympathetic' => 1, 'subjective' => 14, 'dominant' => 1, 'hostile' => 14, 'self_disciplined' => 1],
            ['raw_score' => 3, 'nervous' => 11, 'depressive' => 30, 'active_social' => 1, 'expressive_responsive' => 1, 'sympathetic' => 1, 'subjective' => 11, 'dominant' => 1, 'hostile' => 13, 'self_disciplined' => 1],
            ['raw_score' => 2, 'nervous' => 4, 'depressive' => 12, 'active_social' => 1, 'expressive_responsive' => 1, 'sympathetic' => 1, 'subjective' => 3, 'dominant' => 1, 'hostile' => 1, 'self_disciplined' => 1],
            ['raw_score' => 1, 'nervous' => 4, 'depressive' => 4, 'active_social' => 1, 'expressive_responsive' => 1, 'sympathetic' => 1, 'subjective' => 1, 'dominant' => 1, 'hostile' => 1, 'self_disciplined' => 1],
            ['raw_score' => 0, 'nervous' => 4, 'depressive' => 4, 'active_social' => 1, 'expressive_responsive' => 1, 'sympathetic' => 1, 'subjective' => 1, 'dominant' => 1, 'hostile' => 1, 'self_disciplined' => 1],
        ];

        DB::table('norms')->insert($norms);
    }
}

<?php

// app/Models/Norm.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Norm extends Model
{
    use HasFactory;

    protected $table = 'norms';
    protected $fillable = [
        'raw_score',
        'nervous',
        'depressive',
        'active_social',
        'expressive_responsive',
        'sympathetic',
        'subjective',
        'dominant',
        'hostile',
        'self_disciplined',
    ];
}

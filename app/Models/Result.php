<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'letter',
        'raw_score',
        'value',
    ];

    public function user()
    {
        return $this->belongsTo(Name::class); // atau User::class jika menggunakan User
    }
}



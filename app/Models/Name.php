<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
    ];

    public function results()
    {
        return $this->hasMany(Result::class, 'user_id');
    }
}

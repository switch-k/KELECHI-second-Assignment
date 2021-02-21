<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $fillable = [
        //'user_id',
        'option',
        'c_option',
        'quiz_id'
        
    ];
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}

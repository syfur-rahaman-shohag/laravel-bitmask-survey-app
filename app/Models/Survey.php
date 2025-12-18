<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'app_survey';

    protected $fillable = [
        'name',
        'description',
        'age',
        'setA'
    ];

    public function scopeMale($query)
    {
        return $query->whereRaw('(setA & ?) > 0', [1]); // 1 is the bit value for male
    }

    public function scopeFemale($query)
    {
        return $query->whereRaw('(setA & ?) > 0', [2]); // 2 is the bit value for female
    }
}

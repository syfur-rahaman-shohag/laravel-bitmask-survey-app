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
        'setA'
    ];
}

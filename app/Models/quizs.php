<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quizs extends Model
{
    use HasFactory;
    protected $table = 'quiz';
    protected $guarded = [];
}

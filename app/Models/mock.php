<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mock extends Model
{
    use HasFactory;
    protected $table = 'mock';
    protected $guarded = [];
}

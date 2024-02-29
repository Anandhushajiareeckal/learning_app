<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class scholarship_result extends Model
{
    use HasFactory;
    protected $table = 'scholarship_results';
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }
    
}

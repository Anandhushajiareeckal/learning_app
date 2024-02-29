<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class scholarship_attend extends Model
{
    use HasFactory;
    protected $table = 'scholarship_attends';
    protected $guarded = []; 
    

    public function user()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }  

}
